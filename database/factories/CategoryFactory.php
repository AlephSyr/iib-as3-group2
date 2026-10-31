<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        static $counter = 0;
        $counter++;

        $name = collect([
            'Laravel', 'PHP', 'Tutorials', 'Design', 'Career', 'Opinion',
            'Architecture', 'DevOps', 'Testing', 'Security',
        ])->random().' '.$counter;

        $colors = ['#0f1026', '#06b6d4', '#3b82f6', '#8b5cf6', '#ec4899', '#ef4444', '#f59e0b', '#10b981', '#6366f1', '#14b8a6'];

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'color' => $colors[array_rand($colors)],
            'description' => $this->faker->sentence(),
            'is_active' => true,
        ];
    }
}
