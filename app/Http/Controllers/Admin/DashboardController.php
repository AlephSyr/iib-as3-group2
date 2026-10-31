<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'total_posts' => Post::count(),
            'published_posts' => Post::published()->count(),
            'draft_posts' => Post::drafts()->count(),
            'scheduled_posts' => Post::scheduled()->count(),
            'total_categories' => Category::whereNull('deleted_at')->count(),
            'active_categories' => Category::activeWithPosts()->count(),
        ];

        $recentPosts = Post::latest('created_at')->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPosts'));
    }
}
