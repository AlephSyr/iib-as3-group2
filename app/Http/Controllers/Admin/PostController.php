<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Services\CategoryExtractor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('category');

        if ($request->filled('status')) {
            $query->where('status', $request->string('status')->toString());
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->string('category')->toString());
        }

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->latest('created_at')->paginate(15)->withQueryString();
        $categories = Category::whereNull('deleted_at')->orderBy('name')->get();
        $statuses = ['draft', 'published', 'scheduled'];

        return view('admin.posts.index', compact('posts', 'categories', 'statuses'));
    }

    public function create()
    {
        $categories = Category::whereNull('deleted_at')->orderBy('name')->get();

        return view('admin.posts.form', compact('categories'));
    }

    public function store(Request $request, CategoryExtractor $extractor)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts',
            'category_id' => 'nullable|exists:categories,id',
            'author_name' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|url',
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|date',
            'scheduled_at' => 'nullable|date|after:now',
        ]);

        $post = Post::create($validated);

        // Auto-assign category from content if none selected
        if (blank($post->category_id)) {
            $category = $extractor->extract($post->title, $post->content);
            if ($category) {
                $post->category_id = $category->id;
                $post->save();
            }
        }

        return redirect()->route('admin.posts.show', $post->slug)
            ->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        $post->load('category');

        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::whereNull('deleted_at')->orderBy('name')->get();
        $post->load('category');

        return view('admin.posts.form', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post, CategoryExtractor $extractor)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,'.$post->id,
            'category_id' => 'nullable|exists:categories,id',
            'author_name' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|url',
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|date',
            'scheduled_at' => 'nullable|date|after:now',
        ]);

        // Parse date strings to Carbon instances for reliable persistence
        if (isset($validated['published_at']) && filled($validated['published_at'])) {
            $validated['published_at'] = Carbon::parse($validated['published_at']);
        }

        if (isset($validated['scheduled_at']) && filled($validated['scheduled_at'])) {
            $validated['scheduled_at'] = Carbon::parse($validated['scheduled_at']);
        }

        // Null out dates that don't match the current status
        if ($validated['status'] !== 'published') {
            $validated['published_at'] = null;
        }

        if ($validated['status'] !== 'scheduled') {
            $validated['scheduled_at'] = null;
        }

        $post->update($validated);

        // Re-extract category if none set
        if (blank($post->category_id)) {
            $category = $extractor->extract($post->title, $post->content);
            if ($category) {
                $post->category_id = $category->id;
                $post->save();
            }
        }

        return redirect()->route('admin.posts.show', $post->slug)
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
