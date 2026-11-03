<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Tech & Innovation', 'slug' => 'tech-innovation', 'color' => '#0ea5e9', 'description' => 'Technology, innovation, and the future of digital.', 'is_active' => true],
            ['name' => 'Food & Lifestyle', 'slug' => 'food-lifestyle', 'color' => '#10b981', 'description' => 'Food, lifestyle, and everyday living.', 'is_active' => true],
            ['name' => 'Education', 'slug' => 'education', 'color' => '#8b5cf6', 'description' => 'Learning, teaching, and academic growth.', 'is_active' => true],
            ['name' => 'Travel & Culture', 'slug' => 'travel-culture', 'color' => '#f59e0b', 'description' => 'Travel experiences and cultural insights.', 'is_active' => true],
            ['name' => 'Growth & Success', 'slug' => 'growth-success', 'color' => '#ef4444', 'description' => 'Personal growth, career, and success.', 'is_active' => true],
            ['name' => 'Life & Inspiration', 'slug' => 'life-inspiration', 'color' => '#ec4899', 'description' => 'Inspiring stories and life lessons.', 'is_active' => true],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
