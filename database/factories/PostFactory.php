<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * @return list<string>
     */
    public function definition(): array
    {
        $title = rtrim($this->faker->sentence(6), '.');
        $slug = Str::slug($title);
        $category = Category::inRandomOrder()->first() ?? Category::factory()->create();

        return [
            'title' => $title,
            'slug' => $slug,
            'category_id' => $category->id,
            'author_name' => $this->faker->name(),
            'excerpt' => $this->faker->sentence(20),
            'content' => $this->content($category->name),
            'featured_image' => "https://picsum.photos/seed/{$slug}/1200/630",
            'status' => 'published',
            'published_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'scheduled_at' => null,
        ];
    }

    public function unpublished(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
            'published_at' => null,
        ]);
    }

    public function scheduled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'scheduled',
            'published_at' => null,
            'scheduled_at' => $this->faker->dateTimeBetween('+1 day', '+2 months'),
        ]);
    }

    protected function content(string $categoryName): string
    {
        $categoryHint = $this->faker->boolean(30)
            ? "\n\n<p>This is a post about {$categoryName}.</p>\n\n"
            : '';

        $paragraphs = collect(range(1, 4))
            ->map(fn (): string => '<p>'.$this->faker->paragraph(5).'</p>')
            ->implode("\n\n");

        $list = collect(range(1, 4))
            ->map(fn (): string => '<li>'.$this->faker->sentence(8).'</li>')
            ->implode('');

        return implode("\n\n", [
            $categoryHint,
            $paragraphs,
            '<h2>'.$this->faker->sentence(4).'</h2>',
            '<p>'.$this->faker->paragraph(6).'</p>',
            '<ul>'.$list.'</ul>',
            '<blockquote><p>'.$this->faker->sentence(14).'</p></blockquote>',
            '<p>'.$this->faker->paragraph(5).'</p>',
        ]);
    }
}
