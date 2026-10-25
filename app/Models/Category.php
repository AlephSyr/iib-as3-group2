<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable(['name', 'slug', 'color', 'description', 'is_active'])]
#[SoftDeletes]
class Category extends Model
{
    use HasFactory;

    /**
     * Get the posts associated with this category via the foreign key.
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }

    /**
     * Get the route URL for this category's archive page.
     */
    public function url(): string
    {
        return route('blog.index', ['category' => $this->slug]);
    }

    /**
     * Derive the slug from the name when one is not supplied.
     */
    protected static function booted(): void
    {
        static::saving(function (Category $category): void {
            if (blank($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Get only active categories that have at least one published post,
     * annotated with their published post count.
     */
    public static function activeWithPosts(): Builder
    {
        return static::query()
            ->where('is_active', true)
            ->whereNull('deleted_at')
            ->whereHas('posts', function ($query) {
                $query->published();
            })
            ->withCount(['posts as post_count' => function ($query) {
                $query->published();
            }])
            ->orderBy('name');
    }
}
