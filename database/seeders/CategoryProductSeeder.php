<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    public function run(): void
    {
        $electronics = Category::create([
            'title' => 'Electronics',
            'keywords' => 'electronics, gadgets, devices',
            'description' => 'Electronic devices and gadgets',
            'status' => 1,
        ]);

        $phones = Category::create([
            'parent_id' => $electronics->id,
            'title' => 'Phones',
            'keywords' => 'phones, smartphones, mobile',
            'description' => 'Mobile phones and accessories',
            'status' => 1,
        ]);

        $laptops = Category::create([
            'parent_id' => $electronics->id,
            'title' => 'Laptops',
            'keywords' => 'laptops, notebooks, computers',
            'description' => 'Laptop computers',
            'status' => 1,
        ]);

        $clothing = Category::create([
            'title' => 'Clothing',
            'keywords' => 'clothing, apparel, fashion',
            'description' => 'Fashion and apparel',
            'status' => 1,
        ]);

        $home = Category::create([
            'title' => 'Home & Living',
            'keywords' => 'home, living, decor',
            'description' => 'Home and living products',
            'status' => 1,
        ]);

        $products = [
            ['category_id' => $phones->id, 'title' => 'iPhone 15 Pro', 'slug' => 'iphone-15-pro', 'description' => 'Apple iPhone 15 Pro with A17 Pro chip, 48MP camera system, and titanium design.', 'price' => 999.99, 'quantity' => 25, 'keywords' => 'apple, iphone, smartphone', 'status' => 1],
            ['category_id' => $phones->id, 'title' => 'Samsung Galaxy S24', 'slug' => 'samsung-galaxy-s24', 'description' => 'Samsung Galaxy S24 with AI features, dynamic AMOLED display.', 'price' => 899.99, 'quantity' => 30, 'keywords' => 'samsung, galaxy, smartphone', 'status' => 1],
            ['category_id' => $phones->id, 'title' => 'Google Pixel 8', 'slug' => 'google-pixel-8', 'description' => 'Google Pixel 8 with Tensor G3 chip and advanced AI camera.', 'price' => 799.99, 'quantity' => 20, 'keywords' => 'google, pixel, smartphone', 'status' => 1],
            ['category_id' => $laptops->id, 'title' => 'MacBook Air M3', 'slug' => 'macbook-air-m3', 'description' => 'Apple MacBook Air with M3 chip, 15-inch display.', 'price' => 1299.99, 'quantity' => 15, 'keywords' => 'apple, macbook, laptop', 'status' => 1],
            ['category_id' => $laptops->id, 'title' => 'Dell XPS 15', 'slug' => 'dell-xps-15', 'description' => 'Dell XPS 15 with Intel Core i9, 32GB RAM, OLED display.', 'price' => 1799.99, 'quantity' => 10, 'keywords' => 'dell, xps, laptop', 'status' => 1],
            ['category_id' => $electronics->id, 'title' => 'Sony WH-1000XM5', 'slug' => 'sony-wh-1000xm5', 'description' => 'Sony wireless noise-cancelling headphones with premium sound.', 'price' => 349.99, 'quantity' => 40, 'keywords' => 'sony, headphones, audio', 'status' => 1],
            ['category_id' => $electronics->id, 'title' => 'Apple Watch Series 9', 'slug' => 'apple-watch-series-9', 'description' => 'Apple Watch Series 9 with S9 chip and health monitoring.', 'price' => 399.99, 'quantity' => 35, 'keywords' => 'apple, watch, wearable', 'status' => 1],
            ['category_id' => $electronics->id, 'title' => 'iPad Air', 'slug' => 'ipad-air', 'description' => 'Apple iPad Air with M1 chip and 10.9-inch Liquid Retina display.', 'price' => 599.99, 'quantity' => 22, 'keywords' => 'apple, ipad, tablet', 'status' => 1],
            ['category_id' => $clothing->id, 'title' => 'Classic Denim Jacket', 'slug' => 'classic-denim-jacket', 'description' => 'Timeless denim jacket with a modern fit.', 'price' => 89.99, 'quantity' => 50, 'keywords' => 'denim, jacket, clothing', 'status' => 1],
            ['category_id' => $clothing->id, 'title' => 'Cotton T-Shirt Pack', 'slug' => 'cotton-tshirt-pack', 'description' => 'Pack of 3 premium cotton t-shirts in neutral colors.', 'price' => 39.99, 'quantity' => 100, 'keywords' => 'cotton, tshirt, pack', 'status' => 1],
            ['category_id' => $clothing->id, 'title' => 'Wool Blend Sweater', 'slug' => 'wool-blend-sweater', 'description' => 'Warm wool blend sweater perfect for cold weather.', 'price' => 69.99, 'quantity' => 35, 'keywords' => 'wool, sweater, winter', 'status' => 1],
            ['category_id' => $home->id, 'title' => 'Scented Candle Set', 'slug' => 'scented-candle-set', 'description' => 'Set of 3 hand-poured soy wax candles in various scents.', 'price' => 34.99, 'quantity' => 60, 'keywords' => 'candle, home, decor', 'status' => 1],
            ['category_id' => $home->id, 'title' => 'Minimalist Desk Lamp', 'slug' => 'minimalist-desk-lamp', 'description' => 'LED desk lamp with adjustable brightness and color temperature.', 'price' => 49.99, 'quantity' => 45, 'keywords' => 'lamp, desk, lighting', 'status' => 1],
            ['category_id' => $home->id, 'title' => 'Ceramic Plant Pot', 'slug' => 'ceramic-plant-pot', 'description' => 'Matte ceramic plant pot with drainage hole, 6-inch.', 'price' => 24.99, 'quantity' => 80, 'keywords' => 'ceramic, plant, pot', 'status' => 1],
            ['category_id' => $home->id, 'title' => 'Throw Blanket', 'slug' => 'throw-blanket', 'description' => 'Soft and cozy throw blanket for your couch.', 'price' => 44.99, 'quantity' => 55, 'keywords' => 'blanket, throw, cozy', 'status' => 1],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('Categories and products seeded successfully!');
    }
}
