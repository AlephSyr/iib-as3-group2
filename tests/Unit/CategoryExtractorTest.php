<?php

use App\Models\Category;
use App\Services\CategoryExtractor;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('extracts category from explicit [Category: X] marker', function () {
    $extractor = new CategoryExtractor;
    $category = $extractor->extract('My Post', '<p>[Category: Laravel] This is about Laravel.</p>');

    expect($category->name)->toBe('Laravel');
    expect(Category::where('slug', 'laravel')->exists())->toBeTrue();
});

it('extracts category from keyword matches in content', function () {
    $extractor = new CategoryExtractor;
    $category = $extractor->extract('My Post', '<p>This is a guide about Laravel Eloquent and Blade templates.</p>');

    expect($category->name)->toBe('Laravel');
});

it('returns null when no category keywords match', function () {
    $extractor = new CategoryExtractor;
    $category = $extractor->extract('Hello World', '<p>Just some random text without any keywords.</p>');

    expect($category)->toBeNull();
});

it('creates new category when one does not exist', function () {
    $extractor = new CategoryExtractor;
    $category = $extractor->extract('My Post', '<p>[Category: DevOps] Deploying to production.</p>');

    expect($category->name)->toBe('Devops');
    expect(Category::where('slug', 'devops')->exists())->toBeTrue();
});

it('reuses existing category instead of duplicating', function () {
    Category::factory()->create(['name' => 'PHP', 'slug' => 'php']);

    $extractor = new CategoryExtractor;
    $category = $extractor->extract('My Post', '<p>PHP is great for web development.</p>');

    expect($category->id)->toBe(Category::where('slug', 'php')->first()->id);
    expect(Category::count())->toBe(1);
});
