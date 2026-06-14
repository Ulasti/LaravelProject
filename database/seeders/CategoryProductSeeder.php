<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CategoryProductSeeder extends Seeder
{
    private static array $pexelsCache = [];

    private function fetchPexelsImages(string $query, int $count = 5): array
    {
        $key = strtolower(trim($query));

        if (isset(self::$pexelsCache[$key])) {
            return self::$pexelsCache[$key];
        }

        $apiKey = env('PEXELS_API_KEY');

        if (!$apiKey) {
            self::$pexelsCache[$key] = [];
            return [];
        }

        $response = Http::withHeaders(['Authorization' => $apiKey])
            ->get('https://api.pexels.com/v1/search', [
                'query' => $query,
                'per_page' => max($count, 5),
                'orientation' => 'square',
            ]);

        if ($response->failed()) {
            self::$pexelsCache[$key] = [];
            return [];
        }

        $photos = $response->json('photos', []);
        $urls = array_map(fn($p) => $p['src']['large'] ?? $p['src']['original'], $photos);
        $urls = array_values(array_filter($urls));

        self::$pexelsCache[$key] = $urls;
        return $urls;
    }

    private function pexelsImage(string $query, int $index = 0): ?string
    {
        $urls = $this->fetchPexelsImages($query);
        return $urls[$index] ?? null;
    }

    private function picsum(string $seed): string
    {
        return 'https://picsum.photos/seed/' . $seed . '/600/600';
    }

    private function storeImage(string $url, string $slug, string $suffix = ''): string
    {
        $filename = $slug . ($suffix ? "-{$suffix}" : '') . '.jpg';
        $path = 'products/' . $filename;

        if (Storage::disk('public')->exists($path)) {
            return $path;
        }

        try {
            $response = Http::timeout(10)->get($url);
            if ($response->successful()) {
                Storage::disk('public')->put($path, $response->body());
                return $path;
            }
        } catch (\Exception $e) {}

        return $url;
    }

    public function run(): void
    {
        $electronics = $this->makeCategory('Electronics', 'electronics, gadgets, devices', 'Electronic devices and gadgets');
        $clothing    = $this->makeCategory('Clothing', 'clothing, apparel, fashion', 'Fashion and apparel for everyone');
        $home        = $this->makeCategory('Home & Living', 'home, living, decor', 'Home decor and lifestyle products');
        $sports      = $this->makeCategory('Sports & Outdoors', 'sports, outdoors, fitness', 'Sports equipment and outdoor gear');
        $books       = $this->makeCategory('Books & Media', 'books, media, reading', 'Books and media collection');
        $beauty      = $this->makeCategory('Beauty & Health', 'beauty, health, skincare', 'Beauty and health products');
        $toys        = $this->makeCategory('Toys & Games', 'toys, games, fun', 'Toys and games for all ages');
        $automotive  = $this->makeCategory('Automotive', 'automotive, car, accessories', 'Automotive parts and accessories');
        $food        = $this->makeCategory('Food & Drinks', 'food, drinks, groceries', 'Food and beverage products');
        $pets        = $this->makeCategory('Pet Supplies', 'pets, supplies, animals', 'Pet supplies and accessories');

        $catPhones   = $this->makeCategory('Phones', 'phones, smartphones', 'Mobile phones and accessories', $electronics->id);
        $catLaptops  = $this->makeCategory('Laptops', 'laptops, notebooks', 'Laptop computers', $electronics->id);
        $catAudio    = $this->makeCategory('Audio', 'audio, headphones, speakers', 'Audio equipment', $electronics->id);
        $catMen      = $this->makeCategory("Men's", "men's clothing, fashion", "Men's fashion", $clothing->id);
        $catWomen    = $this->makeCategory("Women's", "women's clothing, fashion", "Women's fashion", $clothing->id);
        $catDecor    = $this->makeCategory('Decor', 'decor, decoration', 'Home decoration', $home->id);
        $catKitchen  = $this->makeCategory('Kitchen', 'kitchen, cooking, utensils', 'Kitchen and dining', $home->id);
        $catFitness  = $this->makeCategory('Fitness', 'fitness, exercise, gym', 'Fitness equipment', $sports->id);
        $catCamping  = $this->makeCategory('Camping', 'camping, tent, outdoor', 'Camping gear', $sports->id);
        $catFiction  = $this->makeCategory('Fiction', 'fiction, novels, stories', 'Fiction books', $books->id);
        $catNonfic   = $this->makeCategory('Non-Fiction', 'non-fiction, educational', 'Non-fiction books', $books->id);
        $catSkincare = $this->makeCategory('Skincare', 'skincare, face, body', 'Skincare products', $beauty->id);
        $catMakeup   = $this->makeCategory('Makeup', 'makeup, cosmetics', 'Makeup and cosmetics', $beauty->id);
        $catBoard    = $this->makeCategory('Board Games', 'board games, tabletop', 'Board games', $toys->id);
        $catCarCare  = $this->makeCategory('Car Care', 'car care, cleaning', 'Car care products', $automotive->id);
        $catSnacks   = $this->makeCategory('Snacks', 'snacks, food', 'Snacks and treats', $food->id);
        $catDogs     = $this->makeCategory('Dogs', 'dogs, canine', 'Dog supplies', $pets->id);

        $products = [
            // Electronics > Phones
            ['category_id' => $catPhones->id, 'title' => 'iPhone 16 Pro', 'slug' => 'iphone-16-pro', 'price' => 1199.99, 'quantity' => 20, 'keywords' => 'apple, iphone, smartphone'],
            ['category_id' => $catPhones->id, 'title' => 'Samsung Galaxy S25', 'slug' => 'samsung-galaxy-s25', 'price' => 1099.99, 'quantity' => 25, 'keywords' => 'samsung, galaxy, smartphone'],
            ['category_id' => $catPhones->id, 'title' => 'Google Pixel 10', 'slug' => 'google-pixel-10', 'price' => 899.99, 'quantity' => 18, 'keywords' => 'google, pixel, smartphone'],
            ['category_id' => $catPhones->id, 'title' => 'OnePlus 13', 'slug' => 'oneplus-13', 'price' => 849.99, 'quantity' => 22, 'keywords' => 'oneplus, smartphone'],
            ['category_id' => $catPhones->id, 'title' => 'Nothing Phone 3', 'slug' => 'nothing-phone-3', 'price' => 749.99, 'quantity' => 15, 'keywords' => 'nothing, phone, smartphone'],
            // Electronics > Laptops
            ['category_id' => $catLaptops->id, 'title' => 'MacBook Pro 16 M4', 'slug' => 'macbook-pro-16-m4', 'price' => 2499.99, 'quantity' => 12, 'keywords' => 'apple, macbook, pro, laptop'],
            ['category_id' => $catLaptops->id, 'title' => 'Dell XPS 16', 'slug' => 'dell-xps-16', 'price' => 1899.99, 'quantity' => 14, 'keywords' => 'dell, xps, laptop'],
            ['category_id' => $catLaptops->id, 'title' => 'ThinkPad X1 Carbon Gen 13', 'slug' => 'thinkpad-x1-carbon-gen-13', 'price' => 2099.99, 'quantity' => 10, 'keywords' => 'lenovo, thinkpad, laptop'],
            // Electronics > Audio
            ['category_id' => $catAudio->id, 'title' => 'Sony WH-1000XM6', 'slug' => 'sony-wh-1000xm6', 'price' => 379.99, 'quantity' => 35, 'keywords' => 'sony, headphones, noise cancelling'],
            ['category_id' => $catAudio->id, 'title' => 'AirPods Pro 3', 'slug' => 'airpods-pro-3', 'price' => 249.99, 'quantity' => 40, 'keywords' => 'apple, airpods, earbuds'],
            ['category_id' => $catAudio->id, 'title' => 'Bose QuietComfort Ultra', 'slug' => 'bose-qc-ultra', 'price' => 429.99, 'quantity' => 20, 'keywords' => 'bose, headphones, comfort'],
            // Clothing > Men's
            ['category_id' => $catMen->id, 'title' => 'Slim Fit Chinos', 'slug' => 'slim-fit-chinos', 'price' => 59.99, 'quantity' => 45, 'keywords' => 'chinos, pants, men'],
            ['category_id' => $catMen->id, 'title' => 'Oxford Button-Down Shirt', 'slug' => 'oxford-button-down-shirt', 'price' => 69.99, 'quantity' => 50, 'keywords' => 'oxford, shirt, men'],
            ['category_id' => $catMen->id, 'title' => 'Bomber Jacket', 'slug' => 'bomber-jacket', 'price' => 129.99, 'quantity' => 30, 'keywords' => 'bomber, jacket, men'],
            // Clothing > Women's
            ['category_id' => $catWomen->id, 'title' => 'Floral Midi Dress', 'slug' => 'floral-midi-dress', 'price' => 89.99, 'quantity' => 35, 'keywords' => 'dress, floral, women'],
            ['category_id' => $catWomen->id, 'title' => 'Cashmere Cardigan', 'slug' => 'cashmere-cardigan', 'price' => 149.99, 'quantity' => 25, 'keywords' => 'cashmere, cardigan, women'],
            ['category_id' => $catWomen->id, 'title' => 'High-Waist Jeans', 'slug' => 'high-waist-jeans', 'price' => 79.99, 'quantity' => 40, 'keywords' => 'jeans, high-waist, women'],
            // Home > Decor
            ['category_id' => $catDecor->id, 'title' => 'Scented Soy Candle Trio', 'slug' => 'scented-soy-candle-trio', 'price' => 36.99, 'quantity' => 55, 'keywords' => 'candle, soy, scented'],
            ['category_id' => $catDecor->id, 'title' => 'Framed Canvas Wall Art', 'slug' => 'framed-canvas-wall-art', 'price' => 44.99, 'quantity' => 30, 'keywords' => 'canvas, wall art, framed'],
            ['category_id' => $catDecor->id, 'title' => 'Ceramic Vase Set', 'slug' => 'ceramic-vase-set', 'price' => 34.99, 'quantity' => 40, 'keywords' => 'vase, ceramic, set'],
            // Home > Kitchen
            ['category_id' => $catKitchen->id, 'title' => 'Cast Iron Skillet 12"', 'slug' => 'cast-iron-skillet', 'price' => 49.99, 'quantity' => 35, 'keywords' => 'cast iron, skillet, pan'],
            ['category_id' => $catKitchen->id, 'title' => 'Bamboo Cutting Board Set', 'slug' => 'bamboo-cutting-board-set', 'price' => 29.99, 'quantity' => 50, 'keywords' => 'bamboo, cutting board'],
            ['category_id' => $catKitchen->id, 'title' => 'French Press Coffee Maker', 'slug' => 'french-press-coffee-maker', 'price' => 39.99, 'quantity' => 45, 'keywords' => 'french press, coffee, maker'],
            // Sports > Fitness
            ['category_id' => $catFitness->id, 'title' => 'Premium Yoga Mat', 'slug' => 'premium-yoga-mat', 'price' => 44.99, 'quantity' => 60, 'keywords' => 'yoga, mat, fitness'],
            ['category_id' => $catFitness->id, 'title' => 'Adjustable Dumbbell Set', 'slug' => 'adjustable-dumbbell-set', 'price' => 299.99, 'quantity' => 15, 'keywords' => 'dumbbell, adjustable, weights'],
            ['category_id' => $catFitness->id, 'title' => 'Resistance Bands Set', 'slug' => 'resistance-bands-set', 'price' => 19.99, 'quantity' => 80, 'keywords' => 'resistance, bands, exercise'],
            // Sports > Camping
            ['category_id' => $catCamping->id, 'title' => '4-Person Dome Tent', 'slug' => '4-person-dome-tent', 'price' => 159.99, 'quantity' => 20, 'keywords' => 'tent, camping, dome'],
            ['category_id' => $catCamping->id, 'title' => 'Sleeping Bag -20°F', 'slug' => 'sleeping-bag-20f', 'price' => 89.99, 'quantity' => 30, 'keywords' => 'sleeping bag, camping, warm'],
            // Books > Fiction
            ['category_id' => $catFiction->id, 'title' => 'The Silent Patient', 'slug' => 'the-silent-patient', 'price' => 14.99, 'quantity' => 100, 'keywords' => 'thriller, mystery, book'],
            ['category_id' => $catFiction->id, 'title' => 'Project Hail Mary', 'slug' => 'project-hail-mary', 'price' => 16.99, 'quantity' => 90, 'keywords' => 'sci-fi, space, book'],
            // Books > Non-Fiction
            ['category_id' => $catNonfic->id, 'title' => 'Atomic Habits', 'slug' => 'atomic-habits', 'price' => 12.99, 'quantity' => 120, 'keywords' => 'habits, self-help, book'],
            ['category_id' => $catNonfic->id, 'title' => 'Sapiens: A Brief History', 'slug' => 'sapiens-a-brief-history', 'price' => 15.99, 'quantity' => 85, 'keywords' => 'history, humanity, book'],
            // Beauty > Skincare
            ['category_id' => $catSkincare->id, 'title' => 'Vitamin C Brightening Serum', 'slug' => 'vitamin-c-serum', 'price' => 28.99, 'quantity' => 50, 'keywords' => 'vitamin c, serum, skincare'],
            ['category_id' => $catSkincare->id, 'title' => 'Retinol Night Cream', 'slug' => 'retinol-night-cream', 'price' => 34.99, 'quantity' => 40, 'keywords' => 'retinol, night cream, skincare'],
            ['category_id' => $catSkincare->id, 'title' => 'SPF 50 Sunscreen', 'slug' => 'spf-50-sunscreen', 'price' => 19.99, 'quantity' => 65, 'keywords' => 'sunscreen, spf, sun protection'],
            // Beauty > Makeup
            ['category_id' => $catMakeup->id, 'title' => 'Luminous Foundation', 'slug' => 'luminous-foundation', 'price' => 42.99, 'quantity' => 35, 'keywords' => 'foundation, makeup, luminous'],
            ['category_id' => $catMakeup->id, 'title' => 'Eyeshadow Palette 36-Shade', 'slug' => 'eyeshadow-palette', 'price' => 49.99, 'quantity' => 30, 'keywords' => 'eyeshadow, palette, makeup'],
            // Toys > Board Games
            ['category_id' => $catBoard->id, 'title' => 'Catan Board Game', 'slug' => 'catan-board-game', 'price' => 44.99, 'quantity' => 40, 'keywords' => 'catan, board game, strategy'],
            ['category_id' => $catBoard->id, 'title' => 'Ticket to Ride', 'slug' => 'ticket-to-ride', 'price' => 49.99, 'quantity' => 35, 'keywords' => 'ticket to ride, board game'],
            ['category_id' => $catBoard->id, 'title' => 'Azul', 'slug' => 'azul', 'price' => 34.99, 'quantity' => 45, 'keywords' => 'azul, board game, tiles'],
            // Automotive > Car Care
            ['category_id' => $catCarCare->id, 'title' => 'Microfiber Cloth Set 12-Pack', 'slug' => 'microfiber-cloth-set', 'price' => 14.99, 'quantity' => 100, 'keywords' => 'microfiber, cloth, car cleaning'],
            ['category_id' => $catCarCare->id, 'title' => 'Premium Car Shampoo', 'slug' => 'premium-car-shampoo', 'price' => 19.99, 'quantity' => 60, 'keywords' => 'car shampoo, wash, cleaning'],
            ['category_id' => $catCarCare->id, 'title' => 'Tire Shine Spray', 'slug' => 'tire-shine-spray', 'price' => 9.99, 'quantity' => 75, 'keywords' => 'tire shine, spray, car care'],
            // Food > Snacks
            ['category_id' => $catSnacks->id, 'title' => 'Premium Nut Mix', 'slug' => 'premium-nut-mix', 'price' => 12.99, 'quantity' => 80, 'keywords' => 'nuts, mix, snack'],
            ['category_id' => $catSnacks->id, 'title' => 'Dark Chocolate Box 12-Piece', 'slug' => 'dark-chocolate-box', 'price' => 24.99, 'quantity' => 60, 'keywords' => 'chocolate, dark, gift'],
            ['category_id' => $catSnacks->id, 'title' => 'Organic Trail Mix', 'slug' => 'organic-trail-mix', 'price' => 8.99, 'quantity' => 90, 'keywords' => 'trail mix, organic, snack'],
            // Pets > Dogs
            ['category_id' => $catDogs->id, 'title' => 'Memory Foam Dog Bed', 'slug' => 'memory-foam-dog-bed', 'price' => 69.99, 'quantity' => 30, 'keywords' => 'dog bed, memory foam, pet'],
            ['category_id' => $catDogs->id, 'title' => 'Reflective Dog Leash 6ft', 'slug' => 'reflective-dog-leash', 'price' => 18.99, 'quantity' => 55, 'keywords' => 'dog leash, reflective, walking'],
            ['category_id' => $catDogs->id, 'title' => 'Stainless Steel Food Bowls Set', 'slug' => 'stainless-steel-dog-bowls', 'price' => 22.99, 'quantity' => 65, 'keywords' => 'dog bowls, stainless, feeding'],
        ];

        foreach ($products as $data) {
            $desc = match ($data['slug']) {
                'iphone-16-pro'       => 'Apple iPhone 16 Pro with A18 Pro chip, 48MP camera system with 5x optical zoom, and titanium design. Features the new Camera Control button and Apple Intelligence.',
                'samsung-galaxy-s25'  => 'Samsung Galaxy S25 with Galaxy AI, Dynamic AMOLED 2X display, 200MP camera, and all-day battery life. Powered by the Snapdragon 8 Gen 4 processor.',
                'google-pixel-10'     => 'Google Pixel 10 with Tensor G5 chip, advanced AI photography features, and seven years of OS updates. The smartest Pixel yet.',
                'oneplus-13'          => 'OnePlus 13 with Snapdragon 8 Gen 4, 120Hz ProXDR display, 100W fast charging, and Hasselblad-tuned cameras.',
                'nothing-phone-3'     => 'Nothing Phone 3 with Glyph Interface 2.0, transparent design, 50MP dual camera, and clean Android experience.',
                'macbook-pro-16-m4'   => 'Apple MacBook Pro 16-inch with M4 Pro chip, 36GB unified memory, Liquid Retina XDR display, and up to 22 hours of battery life.',
                'dell-xps-16'         => 'Dell XPS 16 with Intel Core Ultra 9, 32GB RAM, 4K OLED InfinityEdge display, and premium aluminum chassis.',
                'thinkpad-x1-carbon-gen-13' => 'Lenovo ThinkPad X1 Carbon Gen 13 with Intel Core Ultra 7, 16GB RAM, 14-inch 2.8K OLED display, and MIL-STD-810H durability.',
                'sony-wh-1000xm6'     => 'Sony WH-1000XM6 wireless noise-cancelling headphones with industry-leading ANC, 40-hour battery, and Hi-Res Audio support.',
                'airpods-pro-3'       => 'Apple AirPods Pro 3 with H3 chip, adaptive audio, USB-C MagSafe charging case with Find My and built-in speaker.',
                'bose-qc-ultra'       => 'Bose QuietComfort Ultra headphones with CustomTune technology, Immersive Audio, and world-class noise cancellation.',
                'slim-fit-chinos'      => 'Classic slim fit chinos in stretch cotton twill. Features a modern tapered leg and comfortable mid-rise waist.',
                'oxford-button-down-shirt' => 'Premium Oxford button-down shirt in 100% cotton. Features a button-down collar, chest pocket, and adjustable cuffs.',
                'bomber-jacket'       => 'Classic bomber jacket with ribbed cuffs and hem, two-way zipper, and quilted lining. Made from water-resistant nylon.',
                'floral-midi-dress'   => 'Elegant floral midi dress with a flattering A-line silhouette, V-neckline, and hidden side pockets.',
                'cashmere-cardigan'   => 'Luxurious cashmere cardigan with pearl buttons, ribbed trim, and a relaxed fit. Perfect for layering.',
                'high-waist-jeans'    => 'High-waist jeans in premium stretch denim. Features a straight leg cut, five-pocket styling, and a comfortable fit.',
                'scented-soy-candle-trio' => 'Set of three hand-poured soy wax candles in lavender, vanilla, and eucalyptus scents. 8oz each in amber glass jars.',
                'framed-canvas-wall-art' => 'Ready-to-hang framed canvas wall art. Giclee print on quality canvas with a solid wood frame. 16x20 inches.',
                'ceramic-vase-set'    => 'Set of three matte ceramic vases in varying heights. Modern organic shapes in neutral earth tones.',
                'cast-iron-skillet'   => 'Pre-seasoned 12-inch cast iron skillet with sturdy handle and pour spouts. Oven safe to 500°F.',
                'bamboo-cutting-board-set' => 'Set of three organic bamboo cutting boards in graduated sizes. Knife-friendly with juice grooves.',
                'french-press-coffee-maker' => '34oz French press coffee maker with borosilicate glass carafe, stainless steel plunger, and 4-level filtration.',
                'premium-yoga-mat'    => 'Extra-thick 6mm premium yoga mat with alignment marks. Non-slip surface, eco-friendly TPE material.',
                'adjustable-dumbbell-set' => 'Space-saving adjustable dumbbell set ranging from 5 to 52.5 lbs. Quick-change weight selection system.',
                'resistance-bands-set' => 'Set of 5 resistance bands with varying tension levels. Includes door anchor, handles, and ankle straps.',
                '4-person-dome-tent'  => 'Spacious 4-person dome tent with weatherproof flysheet, mesh ventilation, and easy setup in under 5 minutes.',
                'sleeping-bag-20f'    => 'Warm mummy-style sleeping bag rated to -20°F. Features synthetic insulation, draft collar, and compression sack.',
                'the-silent-patient'  => 'A shocking psychological thriller about a famous painter who shoots her husband and then never speaks another word.',
                'project-hail-mary'   => 'An epic sci-fi adventure about an astronaut who wakes up alone on a spacecraft with no memory of how he got there.',
                'atomic-habits'       => 'A practical guide to building good habits and breaking bad ones through small incremental changes.',
                'sapiens-a-brief-history' => 'A groundbreaking narrative of humanity\'s creation and evolution that explores how we became the dominant species.',
                'vitamin-c-serum'     => 'Brightening vitamin C serum with hyaluronic acid and vitamin E. Reduces dark spots and evens skin tone.',
                'retinol-night-cream' => 'Anti-aging retinol night cream with peptides and ceramides. Improves skin texture and reduces fine lines.',
                'spf-50-sunscreen'    => 'Lightweight broad-spectrum SPF 50 sunscreen with zinc oxide. Water-resistant and non-greasy formula.',
                'luminous-foundation' => 'Buildable luminous foundation with medium coverage. Infused with hyaluronic acid for a natural glow.',
                'eyeshadow-palette'   => 'Professional 36-shade eyeshadow palette with matte, shimmer, and glitter finishes. Highly pigmented and blendable.',
                'catan-board-game'    => 'The classic strategy game of trading and building. Settle the island of Catan and build your civilization.',
                'ticket-to-ride'      => 'A cross-country train adventure board game. Connect cities and build your railway across North America.',
                'azul'               => 'A beautiful tile-placement game where players decorate the walls of the Royal Palace of Evora.',
                'microfiber-cloth-set' => 'Ultra-soft microfiber cleaning cloths. Lint-free, scratch-free, and washable. Perfect for auto detailing.',
                'premium-car-shampoo' => 'pH-balanced car shampoo with high-foaming formula. Safe on wax and ceramic coatings.',
                'tire-shine-spray'    => 'Long-lasting tire shine spray with UV protection. Provides a deep wet-look finish.',
                'premium-nut-mix'     => 'Hand-selected premium nut mix with almonds, cashews, pecans, and walnuts. Lightly salted.',
                'dark-chocolate-box'  => 'Artisan dark chocolate assortment with 12 handcrafted pieces. Single-origin cocoa from Ecuador.',
                'organic-trail-mix'   => 'Organic trail mix with dried fruits, nuts, seeds, and dark chocolate chunks. No added sugar.',
                'memory-foam-dog-bed' => 'Orthopedic memory foam dog bed with removable, machine-washable cover. Supports joints and pressure points.',
                'reflective-dog-leash' => 'Durable 6-foot dog leash with reflective stitching for nighttime visibility. Padded handle for comfort.',
                'stainless-steel-dog-bowls' => 'Set of two stainless steel dog bowls with non-skid silicone base. 2-cup and 4-cup capacities.',
            };

            $imageUrl = $this->pexelsImage($data['title'], 0) ?? $this->picsum($data['slug']);
            $image = $this->storeImage($imageUrl, $data['slug']);

            $product = Product::create([
                'category_id'  => $data['category_id'],
                'title'        => $data['title'],
                'slug'         => $data['slug'],
                'description'  => $desc,
                'price'        => $data['price'],
                'quantity'     => $data['quantity'],
                'min_quantity' => 1,
                'keywords'     => $data['keywords'],
                'image'        => $image,
                'status'       => 1,
            ]);

            foreach (['front', 'side', 'detail', 'box'] as $i => $view) {
                $galleryUrl = $this->pexelsImage($data['title'], $i + 1)
                    ?? $this->picsum($data['slug'] . '-' . $view);
                $galleryImage = $this->storeImage($galleryUrl, $data['slug'], $view);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $galleryImage,
                ]);
            }
        }

        $this->command->info('Categories and products seeded successfully!');
    }

    private function makeCategory(string $title, string $keywords, string $description, ?int $parentId = null): Category
    {
        $imageUrl = $this->pexelsImage($title, 0) ?? $this->picsum(str($title)->slug());
        $image = $this->storeImage($imageUrl, str($title)->slug());

        return Category::create([
            'parent_id'   => $parentId,
            'title'       => $title,
            'keywords'    => $keywords,
            'description' => $description,
            'image'       => $image,
            'status'      => 1,
        ]);
    }
}
