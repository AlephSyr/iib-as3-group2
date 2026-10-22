<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function home(): View
    {
        $featured = Post::published()->first();
        $latest = Post::published()->when($featured, fn ($query) => $query->where('id', '!=', $featured->id))->limit(6)->get();
        $categories = Post::query()
            ->published()
            ->reorder()
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('welcome', compact('featured', 'latest', 'categories'));
    }

    public function index(Request $request): View
    {
        $categories = Post::query()
            ->published()
            ->reorder()
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $posts = Post::published()
            ->when($request->filled('category'), fn ($query) => $query->where('category', $request->string('category')->toString()))
            ->paginate(9)
            ->withQueryString();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(Post $post): View
    {
        if (! $post->isPublished()) {
            abort(404);
        }

        $previous = Post::published()
            ->where('id', '<', $post->id)
            ->reorder('id', 'desc')
            ->first();

        $next = Post::published()
            ->where('id', '>', $post->id)
            ->reorder('id')
            ->first();

        return view('blog.show', compact('post', 'previous', 'next'));
    }
}
