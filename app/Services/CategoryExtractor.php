<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryExtractor
{
    /**
     * Keywords mapped to category names for content-based extraction.
     *
     * @var array<string, list<string>>
     */
    protected array $keywordMap = [
        'Laravel' => ['laravel', 'eloquent', 'blade', 'artisan', 'migration', 'middleware', 'service provider', 'facade', 'tinker'],
        'PHP' => ['php', 'symfony', 'composer', 'packagist', 'psr', 'opcache', 'xdebug', 'phpunit'],
        'Tutorials' => ['tutorial', 'guide', 'how to', 'step by step', 'walkthrough', 'beginner', 'learn', 'course'],
        'Design' => ['design', 'ui', 'ux', 'css', 'tailwind', 'layout', 'typography', 'color', 'grid', 'figma'],
        'Career' => ['career', 'job', 'interview', 'resume', 'salary', 'promotion', 'hiring', 'freelance', 'remote work'],
        'Opinion' => ['opinion', 'thoughts', 'rant', 'review', 'perspective', 'take', 'viewpoint', 'editorial'],
    ];

    /**
     * Extract a category from post title and content.
     *
     * Automatically creates the category if it does not exist.
     */
    public function extract(string $title, string $content): ?Category
    {
        $text = Str::lower($title.' '.$content);

        // First, check for explicit category markers in content
        $explicit = $this->extractExplicitCategory($text);
        if ($explicit) {
            return $this->getOrCreateCategory($explicit);
        }

        // Then, score categories by keyword matches
        $scores = [];
        foreach ($this->keywordMap as $categoryName => $keywords) {
            $score = 0;
            foreach ($keywords as $keyword) {
                if (Str::contains($text, $keyword)) {
                    $score++;
                }
            }
            if ($score > 0) {
                $scores[$categoryName] = $score;
            }
        }

        if (empty($scores)) {
            return null;
        }

        arsort($scores);
        $bestCategory = array_key_first($scores);

        return $this->getOrCreateCategory($bestCategory);
    }

    /**
     * Look for explicit category markers like [Category: Laravel] or Category: Laravel.
     */
    protected function extractExplicitCategory(string $text): ?string
    {
        $patterns = [
            '/\[category:\s*([^\]]+)\]/i',
            '/category:\s*([^\n,;.]+)/i',
            '/\[cat:\s*([^\]]+)\]/i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $text, $matches)) {
                return trim($matches[1]);
            }
        }

        return null;
    }

    /**
     * Get an existing category or create a new one.
     */
    protected function getOrCreateCategory(string $name): ?Category
    {
        $category = Category::whereRaw('LOWER(name) = ?', [strtolower($name)])->first();

        if (! $category) {
            $category = Category::create([
                'name' => ucwords(strtolower(trim($name))),
                'color' => $this->generateColor($name),
                'is_active' => true,
            ]);
        }

        return $category;
    }

    /**
     * Generate a deterministic color for a category based on its name.
     */
    protected function generateColor(string $name): string
    {
        $colors = [
            '#0f1026', '#06b6d4', '#3b82f6', '#8b5cf6', '#ec4899',
            '#ef4444', '#f59e0b', '#10b981', '#6366f1', '#14b8a6',
        ];

        $index = crc32($name) % count($colors);

        return $colors[$index];
    }

    /**
     * Register additional keyword mappings for a category.
     */
    public function registerKeywords(string $categoryName, array $keywords): void
    {
        $this->keywordMap[$categoryName] = array_unique(array_merge(
            $this->keywordMap[$categoryName] ?? [],
            $keywords
        ));
    }
}
