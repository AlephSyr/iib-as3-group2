<?php

use App\Models\Category;
use App\Models\User;

it('redirects to login when not authenticated', function () {
    $this->get(route('admin.categories.index'))->assertRedirect(route('admin.login'));
});

it('lists categories on admin index', function () {
    $user = User::factory()->create(['email' => 'admin@iib.test', 'password' => bcrypt('password')]);
    Category::factory()->count(3)->create();

    $this->withSession(['admin_user_id' => $user->id])
        ->get(route('admin.categories.index'))
        ->assertOk();
});

it('shows category creation form', function () {
    $user = User::factory()->create(['email' => 'admin@iib.test', 'password' => bcrypt('password')]);

    $this->withSession(['admin_user_id' => $user->id])
        ->get(route('admin.categories.create'))
        ->assertOk();
});

it('creates a new category', function () {
    $user = User::factory()->create(['email' => 'admin@iib.test', 'password' => bcrypt('password')]);

    $this->withSession(['admin_user_id' => $user->id])
        ->post(route('admin.categories.store'), [
            'name' => 'New Category',
            'slug' => 'new-category',
            'color' => '#ff0000',
            'description' => 'A test category.',
            'is_active' => true,
        ])
        ->assertRedirect(route('admin.categories.index'));

    expect(Category::where('slug', 'new-category')->exists())->toBeTrue();
});

it('shows category edit form', function () {
    $user = User::factory()->create(['email' => 'admin@iib.test', 'password' => bcrypt('password')]);
    $category = Category::factory()->create();

    $this->withSession(['admin_user_id' => $user->id])
        ->get(route('admin.categories.edit', $category))
        ->assertOk();
});

it('updates a category', function () {
    $user = User::factory()->create(['email' => 'admin@iib.test', 'password' => bcrypt('password')]);
    $category = Category::factory()->create();

    $this->withSession(['admin_user_id' => $user->id])
        ->put(route('admin.categories.update', $category), [
            'name' => 'Updated Category',
            'slug' => 'updated-category',
            'color' => '#00ff00',
            'description' => 'Updated description.',
            'is_active' => true,
        ])
        ->assertRedirect(route('admin.categories.index'));

    expect(Category::where('slug', 'updated-category')->value('name'))->toBe('Updated Category');
});

it('deletes a category', function () {
    $user = User::factory()->create(['email' => 'admin@iib.test', 'password' => bcrypt('password')]);
    $category = Category::factory()->create();

    $this->withSession(['admin_user_id' => $user->id])
        ->delete(route('admin.categories.destroy', $category))
        ->assertRedirect(route('admin.categories.index'));

    expect(Category::where('id', $category->id)->exists())->toBeFalse();
});
