<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Classic', 'slug' => 'classic'],
            ['name' => 'Spicy', 'slug' => 'spicy'],
            ['name' => 'Gourmet', 'slug' => 'gourmet'],
            ['name' => 'Healthy', 'slug' => 'healthy'],
            ['name' => 'Sweet', 'slug' => 'sweet'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
        User::create([
            'name' => 'ankur jha',
            'email' => 'a@gmail.com',
            'password' => Hash::make('111111')
        ]);
    }
}
