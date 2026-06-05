<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductRating;
use App\Models\SupportMessage;
use App\Models\User;
use App\Notifications\SupportReplied;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $totalRevenue = Order::where('status', '!=', 'pending')->sum('total_price');
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts', 'totalOrders', 'totalUsers', 'totalRevenue', 'recentOrders'
        ));
    }

    public function products()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_percent' => 'nullable|integer|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'price', 'discount_percent', 'stock', 'category_id']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products')->with('success', 'Product created.');
    }

    public function editProduct(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_percent' => 'nullable|integer|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'price', 'discount_percent', 'stock', 'category_id']);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products')->with('success', 'Product updated.');
    }

    public function destroyProduct(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted.');
    }

    public function orders()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function showOrder(Order $order)
    {
        $order->load('items.product', 'user');
        return view('admin.orders.show', compact('order'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,shipped,completed,refunded',
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated.');
    }

    public function categories()
    {
        $categories = Category::withCount('products')->latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        Category::create($request->only(['name', 'description']));

        return redirect()->route('admin.categories')->with('success', 'Category created.');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($request->only(['name', 'description']));

        return redirect()->route('admin.categories')->with('success', 'Category updated.');
    }

    public function destroyCategory(Category $category)
    {
        if ($category->products()->count() > 0) {
            return back()->with('error', 'Cannot delete category with existing products.');
        }
        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Category deleted.');
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'regex:/^(0|\+255)\d{9}$/'],
            'role' => ['required', 'in:user,admin'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $data = $request->only(['first_name', 'last_name', 'email', 'phone', 'role']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted.');
    }

    public function ratings()
    {
        $ratings = ProductRating::with(['user', 'product'])->latest()->paginate(20);
        return view('admin.ratings', compact('ratings'));
    }

    // ─── Payment Management ─────────────────────────────────

    public function payments()
    {
        $payments = Payment::with(['user', 'order'])->latest()->paginate(15);
        return view('admin.payments.index', compact('payments'));
    }

    public function showPayment(Payment $payment)
    {
        $payment->load(['user', 'order.items.product']);
        return view('admin.payments.show', compact('payment'));
    }

    public function verifyPayment(Payment $payment)
    {
        if ($payment->status !== 'pending') {
            return back()->with('error', 'Payment is already ' . $payment->status . '.');
        }

        $payment->update(['status' => 'completed']);

        if ($payment->order) {
            $payment->order->update(['status' => 'confirmed']);
        }

        return back()->with('success', 'Payment #' . $payment->id . ' verified successfully.');
    }

    public function refundPayment(Request $request, Payment $payment)
    {
        if (!in_array($payment->status, ['completed', 'pending'])) {
            return back()->with('error', 'Payment cannot be refunded in its current state.');
        }

        if ($payment->order && $payment->order->status === 'completed') {
            return back()->with('error', 'Cannot refund a payment for a completed order.');
        }

        $payment->update(['status' => 'refunded']);

        return back()->with('success', 'Payment #' . $payment->id . ' refunded successfully.');
    }

    // ─── Analytics & Reports ─────────────────────────────────

    public function reports()
    {
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');
        $totalOrders = Order::count();
        $confirmedOrders = Order::where('status', 'confirmed')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $refundedOrders = Order::where('status', 'refunded')->count();

        $monthlyRevenue = Payment::where('status', 'completed')
            ->where('created_at', '>=', now()->subMonths(6))
            ->selectRaw("strftime('%Y-%m', created_at) as month, SUM(amount) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $bestSellers = OrderItem::selectRaw('product_id, SUM(quantity) as total_qty, SUM(price * quantity) as total_revenue')
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->take(10)
            ->get();

        $customerActivity = User::withCount(['orders', 'orders as total_spent' => function ($q) {
            $q->select(DB::raw('COALESCE(SUM(total_price), 0)'));
        }])->orderByDesc('orders_count')->take(10)->get();

        $recentActivity = \App\Models\ActivityLog::with('user')->latest()->take(20)->get();

        return view('admin.reports', compact(
            'totalRevenue', 'totalOrders', 'confirmedOrders', 'shippedOrders',
            'completedOrders', 'refundedOrders', 'monthlyRevenue',
            'bestSellers', 'customerActivity', 'recentActivity'
        ));
    }

    // ─── Customer Support ────────────────────────────────────

    public function supportMessages()
    {
        $messages = SupportMessage::with('user')->latest()->paginate(20);
        return view('admin.support.index', compact('messages'));
    }

    public function showSupportMessage(SupportMessage $message)
    {
        $message->load('user');
        return view('admin.support.show', compact('message'));
    }

    public function replySupport(Request $request, SupportMessage $message)
    {
        $request->validate([
            'admin_reply' => 'required|string',
        ]);

        $message->update([
            'admin_reply' => $request->admin_reply,
            'status' => 'replied',
            'replied_at' => now(),
        ]);

        if ($message->user_id && $message->user) {
            $message->user->notify(new SupportReplied($message));
        }

        return redirect()->route('admin.support.messages')->with('success', 'Reply sent to ' . $message->email);
    }

    public function closeSupport(SupportMessage $message)
    {
        $message->update(['status' => 'closed']);
        return back()->with('success', 'Support ticket #' . $message->id . ' closed.');
    }
}
