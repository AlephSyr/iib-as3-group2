<?php

use App\Models\Category;
use App\Models\Post;

it('lists published posts on the blog index', function () {
    Post::factory()->create(['title' => 'Published Post']);
    Post::factory()->unpublished()->create(['title' => 'Draft Post']);
    Post::factory()->scheduled()->create(['title' => 'Scheduled Post']);

    $this->get(route('blog.index'))
        ->assertOk()
        ->assertSee('Published Post')
        ->assertDontSee('Draft Post')
        ->assertDontSee('Scheduled Post');
});

it('shows a published post', function () {
    $post = Post::factory()->create(['title' => 'A Readable Post']);

    $this->get(route('blog.show', $post->slug))
        ->assertOk()
        ->assertSee('A Readable Post')
        ->assertSee($post->excerpt, escape: false);
});

it('returns 404 for an unpublished post', function () {
    $post = Post::factory()->unpublished()->create();

    $this->get(route('blog.show', $post->slug))->assertNotFound();
});

it('returns 404 for a scheduled post', function () {
    $post = Post::factory()->scheduled()->create();

    $this->get(route('blog.show', $post->slug))->assertNotFound();
});

it('returns 404 for a missing post', function () {
    $this->get('/blog/does-not-exist')->assertNotFound();
});

it('paginates the blog index', function () {
    Post::factory()->count(12)->create();

    $this->get(route('blog.index'))
        ->assertOk()
        ->assertSee('page=2', escape: false);
});

it('filters the blog index by category', function () {
    $laravel = Category::factory()->create(['name' => 'Laravel', 'slug' => 'laravel']);
    $design = Category::factory()->create(['name' => 'Design', 'slug' => 'design']);

    Post::factory()->create(['title' => 'Laravel Deep Dive', 'category_id' => $laravel->id]);
    Post::factory()->create(['title' => 'CSS Grid Guide', 'category_id' => $design->id]);

    $this->get(route('blog.index', ['category' => $laravel->slug]))
        ->assertOk()
        ->assertSee('Laravel Deep Dive')
        ->assertDontSee('CSS Grid Guide');
});

it('lists only active categories with published posts as filters', function () {
    $laravel = Category::factory()->create(['name' => 'Laravel', 'slug' => 'laravel']);
    $opinion = Category::factory()->create(['name' => 'Opinion', 'slug' => 'opinion']);

    Post::factory()->create(['category_id' => $laravel->id]);
    Post::factory()->unpublished()->create(['category_id' => $opinion->id]);

    $this->get(route('blog.index'))
        ->assertOk()
        ->assertSee($laravel->name)
        ->assertDontSee($opinion->name);
});

it('only shows categories that have at least one published post', function () {
    Category::factory()->create(['name' => 'Empty Category', 'slug' => 'empty-category']);

    $this->get(route('blog.index'))
        ->assertOk()
        ->assertDontSee('Empty Category');
});
