<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = \App\Models\Category::all();

        $products = [
            [
                'name' => 'Premium Phool Makhana',
                'slug' => 'premium-phool-makhana',
                'price' => 299,
                'description' => 'Large size, handpicked premium fox nuts. perfect for snacking.',
                'image' => 'https://images.unsplash.com/photo-1620912189865-1e8a33da4c5e?q=80&w=800&auto=format&fit=crop',
                'weight' => '250g',
                'category' => 'Classic'
            ],
            [
                'name' => 'Roasted Peri Peri Makhana',
                'slug' => 'roasted-peri-peri-makhana',
                'price' => 349,
                'description' => 'Spicy and tangy roasted makhana with authentic Peri Peri spices.',
                'image' => 'https://images.unsplash.com/photo-1599490659223-ef37651c0bb5?q=80&w=800&auto=format&fit=crop',
                'weight' => '150g',
                'category' => 'Spicy'
            ],
            [
                'name' => 'Cheese & Herbs Makhana',
                'slug' => 'cheese-herbs-makhana',
                'price' => 349,
                'description' => 'Creamy cheese flavor with aromatic herbs for a gourmet experience.',
                'image' => 'https://images.unsplash.com/photo-1614735241165-6756e1df61ab?q=80&w=800&auto=format&fit=crop',
                'weight' => '150g',
                'category' => 'Gourmet'
            ],
            [
                'name' => 'Himalayan Salted Makhana',
                'slug' => 'himalayan-salted-makhana',
                'price' => 319,
                'description' => 'Lightly roasted with pure Himalayan pink salt for a healthy crunch.',
                'image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=800&auto=format&fit=crop',
                'weight' => '200g',
                'category' => 'Healthy'
            ],
            [
                'name' => 'Caramel Crunch Makhana',
                'slug' => 'caramel-crunch-makhana',
                'price' => 399,
                'description' => 'Sweet and crunchy makhana coated with rich buttery caramel.',
                'image' => 'https://images.unsplash.com/photo-1585184394271-4c0a47dc59c9?q=80&w=800&auto=format&fit=crop',
                'weight' => '150g',
                'category' => 'Sweet'
            ],
        ];

        foreach ($products as $pData) {
            $cat = $categories->where('name', $pData['category'])->first();
            $product = \App\Models\Product::create([
                'category_id' => $cat->id,
                'name' => $pData['name'],
                'slug' => $pData['slug'],
                'price' => $pData['price'],
                'description' => $pData['description'],
                'weight' => $pData['weight'],
            ]);

            // Main Image
            \App\Models\ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $pData['image'],
                'is_main' => true,
            ]);

            // Additional Images (Dummy Gallery)
            $galleryImages = [
                'https://images.unsplash.com/photo-1620912189865-1e8a33da4c5e?q=80&w=800&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1599490659223-ef37651c0bb5?q=80&w=800&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1614735241165-6756e1df61ab?q=80&w=800&auto=format&fit=crop'
            ];

            foreach (array_slice($galleryImages, 0, 2) as $gImg) {
                \App\Models\ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $gImg,
                    'is_main' => false,
                ]);
            }
        }
    }
}
