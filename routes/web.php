<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BiometricController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::post('/contact', [App\Http\Controllers\SupportController::class, 'store'])->name('contact.store');
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/refund', 'pages.refund')->name('refund');
Route::view('/return', 'pages.return')->name('return');
Route::view('/shipping', 'pages.shipping')->name('shipping');
Route::view('/payment-policy', 'pages.payment')->name('payment');
Route::view('/faq', 'pages.faq')->name('faq');
Route::view('/trust', 'pages.trust')->name('trust');

Route::post('/biometric/register/options', [BiometricController::class, 'registerOptions'])->name('biometric.register.options');
Route::post('/biometric/register', [BiometricController::class, 'register'])->name('biometric.register');
Route::post('/biometric/authenticate/options', [BiometricController::class, 'authenticateOptions'])->name('biometric.authenticate.options');
Route::post('/biometric/authenticate', [BiometricController::class, 'authenticate'])->name('biometric.authenticate');
Route::get('/biometric/check', [BiometricController::class, 'checkDeviceSupport'])->name('biometric.check');
Route::get('/biometric/setup/{token}', [BiometricController::class, 'setupForm'])->name('biometric.setup');
Route::post('/biometric/setup/{token}/register', [BiometricController::class, 'setupRegister'])->name('biometric.setup.register');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{wishlist}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    Route::get('/orders/{order}/receipt', [ReceiptController::class, 'show'])->name('receipt.show');
    Route::get('/orders/{order}/receipt/download', [ReceiptController::class, 'download'])->name('receipt.download');

    Route::get('/checkout', [PaymentController::class, 'showGateways'])->name('checkout.gateways');
    Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout.process');
    Route::get('/payment/mock/confirm/{reference}', [PaymentController::class, 'mockConfirm'])->name('payment.mock.confirm');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

    Route::get('/history', [ActivityLogController::class, 'index'])->name('history.index');

    Route::get('/biometric/credentials', [BiometricController::class, 'credentials'])->name('biometric.credentials');
    Route::delete('/biometric/credentials/{credential}', [BiometricController::class, 'destroyCredential'])->name('biometric.credentials.destroy');
    Route::post('/biometric/token', [BiometricController::class, 'generateSetupToken'])->name('biometric.token');

    Route::post('/otp/send', [App\Http\Controllers\OtpController::class, 'send'])->name('otp.send');
    Route::post('/otp/verify', [App\Http\Controllers\OtpController::class, 'verify'])->name('otp.verify');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unreadCount');
    Route::get('/notifications/recent', [NotificationController::class, 'recent'])->name('notifications.recent');

    Route::post('/products/{product}/rating', [RatingController::class, 'store'])->name('products.rating.store');

    Route::get('/support/ticket/{message}', [App\Http\Controllers\SupportController::class, 'show'])->name('support.ticket');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
    Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}', [AdminController::class, 'destroyProduct'])->name('products.destroy');

    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [AdminController::class, 'showOrder'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.status');

    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{category}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');

    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/history', [ActivityLogController::class, 'adminIndex'])->name('history');
    Route::get('/ratings', [AdminController::class, 'ratings'])->name('ratings');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

    // Payment Management
    Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
    Route::get('/payments/{payment}', [AdminController::class, 'showPayment'])->name('payments.show');
    Route::post('/payments/{payment}/verify', [AdminController::class, 'verifyPayment'])->name('payments.verify');
    Route::post('/payments/{payment}/refund', [AdminController::class, 'refundPayment'])->name('payments.refund');

    // Analytics & Reports
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');

    // Customer Support
    Route::get('/support/messages', [AdminController::class, 'supportMessages'])->name('support.messages');
    Route::get('/support/messages/{message}', [AdminController::class, 'showSupportMessage'])->name('support.messages.show');
    Route::post('/support/messages/{message}/reply', [AdminController::class, 'replySupport'])->name('support.messages.reply');
    Route::post('/support/messages/{message}/close', [AdminController::class, 'closeSupport'])->name('support.messages.close');
});

require __DIR__.'/auth.php';
