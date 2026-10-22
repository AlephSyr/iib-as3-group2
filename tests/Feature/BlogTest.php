<?php

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
    Post::factory()->create(['title' => 'Laravel Deep Dive', 'category' => 'Laravel']);
    Post::factory()->create(['title' => 'CSS Grid Guide', 'category' => 'Design']);

    $this->get(route('blog.index', ['category' => 'Laravel']))
        ->assertOk()
        ->assertSee('Laravel Deep Dive')
        ->assertDontSee('CSS Grid Guide');
});

it('lists the available categories as filters', function () {
    Post::factory()->create(['category' => 'Opinion']);
    Post::factory()->create(['category' => 'Career']);

    $this->get(route('blog.index'))
        ->assertOk()
        ->assertSee('Opinion')
        ->assertSee('Career');
});
