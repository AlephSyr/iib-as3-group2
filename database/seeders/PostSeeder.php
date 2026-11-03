<?php

namespace Database\Seeders;

use App\Models\Post;
// @phpstan-ignore-next-line
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $food = \App\Models\Category::where('slug', 'food-lifestyle')->first();

        Post::factory()->count(6)->create(['category_id' => $food?->id]);
        Post::factory()->count(14)->create();
    }
}
