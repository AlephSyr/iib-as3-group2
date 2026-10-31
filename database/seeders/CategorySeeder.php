<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'color' => '#ff2d20',
                'description' => 'Laravel framework tutorials, tips, and best practices.',
                'is_active' => true,
            ],
            [
                'name' => 'PHP',
                'slug' => 'php',
                'color' => '#777bb4',
                'description' => 'PHP language features, patterns, and ecosystem.',
                'is_active' => true,
            ],
            [
                'name' => 'Tutorials',
                'slug' => 'tutorials',
                'color' => '#06b6d4',
                'description' => 'Step-by-step guides and walkthroughs for developers.',
                'is_active' => true,
            ],
            [
                'name' => 'Design',
                'slug' => 'design',
                'color' => '#8b5cf6',
                'description' => 'UI/UX design, CSS, and visual design principles.',
                'is_active' => true,
            ],
            [
                'name' => 'Career',
                'slug' => 'career',
                'color' => '#10b981',
                'description' => 'Developer career advice, interviews, and growth.',
                'is_active' => true,
            ],
            [
                'name' => 'Opinion',
                'slug' => 'opinion',
                'color' => '#f59e0b',
                'description' => 'Editorials, takes, and perspectives on tech.',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
