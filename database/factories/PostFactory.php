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
    private static int $index = 0;

    public function definition(): array
    {
        $titles = [
            'The Future of Technology: What Every Professional Should Know',
            'How to Build Habits That Actually Last',
            'Education in the Digital Age: Opportunities and Challenges',
            'Travel Smarter: A Guide to Meaningful Journeys',
            'The Mindset Shift That Drives Real Success',
            'Finding Inspiration in Everyday Moments',
            'Innovation at Work: Turning Ideas into Impact',
            'The Art of Living Well in a Busy World',
            'Lifelong Learning: Your Competitive Advantage',
            'Cultural Bridges: How Travel Changes Perspective',
            'From Goals to Growth: A Practical Framework',
            'Stories That Inspire: Lessons from Ordinary People',
            'Technology Trends Reshaping Our Future',
            'Designing a Life You Love',
            'The Power of Continuous Education',
            'Exploring the World, One City at a Time',
            'Success Habits of High Performers',
            'Inspiration Found in Nature and Art',
            'Digital Transformation for Modern Teams',
            'Living with Purpose and Intention',
        ];

        $i = self::$index % count($titles);
        self::$index++;

        $title = $titles[$i];
        $slug = Str::slug($title);
        $category = Category::inRandomOrder()->first() ?? Category::factory()->create();

        return [
            'title' => $title,
            'slug' => $slug,
            'category_id' => $category->id,
            'author_name' => $this->faker->name(),
            'excerpt' => 'A professional, in-depth look at ideas that matter today.',
            'content' => $this->content($category->name, $title),
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

    protected function content(string $categoryName, string $title): string
    {
        if (str_contains($categoryName, 'Food')) {
            return implode("\n\n", [
                '<p>Food is more than nourishment—it is culture, connection, and creativity. In this article, we explore how thoughtful choices in what we eat can transform everyday life.</p>',
                '<h2>The Joy of Cooking</h2>',
                '<p>From simple home meals to gourmet experiences, cooking brings people together and sparks joy. Discover techniques that make preparation both efficient and enjoyable.</p>',
                '<ul><li>Plan balanced meals with seasonal ingredients.</li><li>Master a few versatile recipes.</li><li>Share meals to build community.</li></ul>',
                '<blockquote><p>“Good food is the foundation of genuine happiness.”</p></blockquote>',
                '<p>Embrace a lifestyle where food and well-being go hand in hand.</p>',
            ]);
        }

        return implode("\n\n", [
            '<p>'.fake()->paragraph(6).'</p>',
            '<h2>Why This Matters</h2>',
            '<p>'.fake()->paragraph(7).'</p>',
            '<ul><li>'.fake()->sentence(10).'</li><li>'.fake()->sentence(10).'</li><li>'.fake()->sentence(10).'</li></ul>',
            '<blockquote><p>'.fake()->sentence(16).'</p></blockquote>',
            '<p>'.fake()->paragraph(5).'</p>',
        ]);
    }
}
