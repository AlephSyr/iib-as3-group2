<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

it('redirects to login when not authenticated', function () {
    $this->get(route('admin.dashboard'))->assertRedirect(route('admin.login'));
});

it('shows login page', function () {
    $this->get(route('admin.login'))->assertOk();
});

it('authenticates and accesses dashboard', function () {
    $user = User::factory()->create(['email' => 'admin@iib.test', 'password' => bcrypt('password')]);

    $this->post(route('admin.login.store'), [
        'email' => 'admin@iib.test',
        'password' => 'password',
    ]);

    $this->get(route('admin.dashboard'))->assertOk();
});

it('rejects invalid credentials', function () {
    $this->post(route('admin.login.store'), [
        'email' => 'wrong@example.com',
        'password' => 'wrong',
    ])->assertSessionHasErrors('email');
});

it('lists posts on admin index', function () {
    $user = User::factory()->create(['email' => 'admin@iib.test', 'password' => bcrypt('password')]);
    Post::factory()->count(3)->create();

    $this->withSession(['admin_user_id' => $user->id])
        ->get(route('admin.posts.index'))
        ->assertOk();
});

it('shows post creation form', function () {
    $user = User::factory()->create(['email' => 'admin@iib.test', 'password' => bcrypt('password')]);
    Category::factory()->create();

    $this->withSession(['admin_user_id' => $user->id])
        ->get(route('admin.posts.create'))
        ->assertOk();
});

it('creates a new post', function () {
    $user = User::factory()->create(['email' => 'admin@iib.test', 'password' => bcrypt('password')]);
    $category = Category::factory()->create();

    $this->withSession(['admin_user_id' => $user->id])
        ->post(route('admin.posts.store'), [
            'title' => 'New Admin Post',
            'slug' => 'new-admin-post',
            'category_id' => $category->id,
            'author_name' => 'Admin User',
            'excerpt' => 'A test excerpt.',
            'content' => '<p>This is about Laravel and PHP.</p>',
            'status' => 'published',
            'published_at' => now(),
        ])
        ->assertRedirect(route('admin.posts.show', 'new-admin-post'));

    expect(Post::where('slug', 'new-admin-post')->exists())->toBeTrue();
});

it('shows a single post', function () {
    $user = User::factory()->create(['email' => 'admin@iib.test', 'password' => bcrypt('password')]);
    $post = Post::factory()->create();

    $this->withSession(['admin_user_id' => $user->id])
        ->get(route('admin.posts.show', $post->slug))
        ->assertOk()
        ->assertSee($post->title);
});

it('shows post edit form', function () {
    $user = User::factory()->create(['email' => 'admin@iib.test', 'password' => bcrypt('password')]);
    $post = Post::factory()->create();

    $this->withSession(['admin_user_id' => $user->id])
        ->get(route('admin.posts.edit', $post->slug))
        ->assertOk();
});

it('updates a post', function () {
    $user = User::factory()->create(['email' => 'admin@iib.test', 'password' => bcrypt('password')]);
    $post = Post::factory()->create();

    $this->withSession(['admin_user_id' => $user->id])
        ->put(route('admin.posts.update', $post->slug), [
            'title' => 'Updated Title',
            'slug' => $post->slug,
            'category_id' => $post->category_id,
            'author_name' => $post->author_name,
            'excerpt' => $post->excerpt,
            'content' => $post->content,
            'status' => 'published',
            'published_at' => now(),
        ])
        ->assertRedirect(route('admin.posts.show', $post->slug));

    expect(Post::where('slug', $post->slug)->value('title'))->toBe('Updated Title');
});

it('deletes a post', function () {
    $user = User::factory()->create(['email' => 'admin@iib.test', 'password' => bcrypt('password')]);
    $post = Post::factory()->create();

    $this->withSession(['admin_user_id' => $user->id])
        ->delete(route('admin.posts.destroy', $post->slug))
        ->assertRedirect(route('admin.posts.index'));

    expect(Post::where('id', $post->id)->exists())->toBeFalse();
});
