<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@hesmb.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'first_name' => 'Francis',
            'last_name' => 'Bamugileki',
            'email' => 'francis@hesmb.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        User::create([
            'first_name' => 'Jane',
            'last_name' => 'Mwangi',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        User::create([
            'first_name' => 'Peter',
            'last_name' => 'Kiprop',
            'email' => 'peter@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $electronics = Category::create(['name' => 'Electronics', 'description' => 'Electronic devices and accessories']);
        $clothing = Category::create(['name' => 'Clothing', 'description' => 'Fashion and apparel']);
        $home = Category::create(['name' => 'Home & Kitchen', 'description' => 'Home appliances and kitchenware']);
        $phones = Category::create(['name' => 'Phones & Tablets', 'description' => 'Mobile phones and tablet computers']);
        $health = Category::create(['name' => 'Health & Beauty', 'description' => 'Health and beauty products']);

        Product::create([
            'category_id' => $phones->id,
            'name' => 'Samsung Galaxy S24 Ultra',
            'description' => 'Latest Samsung flagship smartphone with 256GB storage, 12GB RAM, S Pen support, and 200MP camera. Features a stunning 6.8-inch Dynamic AMOLED display.',
            'price' => 3500000,
            'discount_percent' => 10,
            'stock' => 25,
            'image' => null,
        ]);

        Product::create([
            'category_id' => $phones->id,
            'name' => 'iPhone 15 Pro Max',
            'description' => 'Apple iPhone 15 Pro Max with A17 Pro chip, 256GB storage, titanium design, and 48MP pro camera system with 5x optical zoom.',
            'price' => 4200000,
            'discount_percent' => 5,
            'stock' => 18,
            'image' => null,
        ]);

        Product::create([
            'category_id' => $electronics->id,
            'name' => 'Sony WH-1000XM5 Headphones',
            'description' => 'Industry-leading noise canceling wireless headphones with 30-hour battery life, crystal-clear hands-free calling, and Auto NC Optimizer.',
            'price' => 650000,
            'discount_percent' => 15,
            'stock' => 40,
            'image' => null,
        ]);

        Product::create([
            'category_id' => $electronics->id,
            'name' => 'MacBook Air M3',
            'description' => 'Apple MacBook Air with M3 chip, 15.3-inch Liquid Retina display, 8GB unified memory, 256GB SSD, and up to 18 hours of battery life.',
            'price' => 2800000,
            'discount_percent' => 0,
            'stock' => 12,
            'image' => null,
        ]);

        Product::create([
            'category_id' => $clothing->id,
            'name' => 'Premium Cotton T-Shirt',
            'description' => 'Comfortable 100% organic cotton t-shirt available in multiple colors. Breathable fabric with a modern fit for everyday wear.',
            'price' => 35000,
            'discount_percent' => 0,
            'stock' => 200,
            'image' => null,
        ]);

        Product::create([
            'category_id' => $clothing->id,
            'name' => 'Classic Denim Jacket',
            'description' => 'Timeless denim jacket made from premium quality denim. Features button closure, chest pockets, and adjustable waist tabs.',
            'price' => 120000,
            'discount_percent' => 20,
            'stock' => 55,
            'image' => null,
        ]);

        Product::create([
            'category_id' => $home->id,
            'name' => 'Smart LED TV 55 inch',
            'description' => 'Ultra HD 4K Smart LED TV with HDR support, built-in WiFi, and voice control. Stream your favorite content with built-in apps.',
            'price' => 1800000,
            'discount_percent' => 12,
            'stock' => 8,
            'image' => null,
        ]);

        Product::create([
            'category_id' => $home->id,
            'name' => 'Stainless Steel Cookware Set',
            'description' => '10-piece stainless steel cookware set with tempered glass lids, stay-cool handles, and even heat distribution for perfect cooking.',
            'price' => 250000,
            'discount_percent' => 0,
            'stock' => 30,
            'image' => null,
        ]);

        Product::create([
            'category_id' => $health->id,
            'name' => 'Professional Hair Dryer',
            'description' => '2000W professional ionic hair dryer with 3 heat settings, 2 speed settings, concentrator nozzle, and diffuser for salon-quality results.',
            'price' => 85000,
            'discount_percent' => 8,
            'stock' => 75,
            'image' => null,
        ]);

        Product::create([
            'category_id' => $health->id,
            'name' => 'Organic Vitamin C Serum',
            'description' => 'Powerful antioxidant vitamin C serum with hyaluronic acid. Brightens skin, reduces fine lines, and evens skin tone. 100% organic ingredients.',
            'price' => 45000,
            'discount_percent' => 0,
            'stock' => 150,
            'image' => null,
        ]);

        ProductRating::create([
            'user_id' => 2,
            'product_id' => 1,
            'rating' => 5,
            'review' => 'Excellent phone! The camera quality is outstanding and battery life is amazing.',
        ]);

        ProductRating::create([
            'user_id' => 3,
            'product_id' => 1,
            'rating' => 4,
            'review' => 'Great phone overall. A bit expensive but worth every penny.',
        ]);

        ProductRating::create([
            'user_id' => 4,
            'product_id' => 3,
            'rating' => 5,
            'review' => 'Best noise canceling headphones I have ever used. Very comfortable for long sessions.',
        ]);

        ProductRating::create([
            'user_id' => 2,
            'product_id' => 6,
            'rating' => 4,
            'review' => 'Nice denim jacket, good quality material. Fits perfectly.',
        ]);
    }
}
