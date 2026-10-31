<?php

namespace App\Models;

use App\Services\CategoryExtractor;
use Illuminate\Database\Eloquent\Attributes\Boot;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\RouteKey;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable(['title', 'slug', 'category_id', 'author_name', 'excerpt', 'content', 'featured_image', 'status', 'published_at', 'scheduled_at', 'like'])]
#[RouteKey('slug')]
#[SoftDeletes]
class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'scheduled_at' => 'datetime',
            'status' => 'string',
        ];
    }

    /**
     * Get the category relationship.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the categories relationship (many-to-many via category_post).
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post')->withTimestamps();
    }

    /**
     * Get the post's public URL.
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn (): string => route('blog.show', $this->slug),
        );
    }

    /**
     * Get the category name for display (falls back to relationship).
     */
    protected function categoryName(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->category?->name ?? 'Uncategorized',
        );
    }

    /**
     * Scope a query to only include published posts.
     */
    #[Scope]
    protected function published(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at');
    }

    /**
     * Scope a query to only include draft posts.
     */
    #[Scope]
    protected function drafts(Builder $query): Builder
    {
        return $query->where('status', 'draft')->latest('created_at');
    }

    /**
     * Scope a query to only include scheduled posts.
     */
    #[Scope]
    protected function scheduled(Builder $query): Builder
    {
        return $query->where('status', 'scheduled')
            ->whereNotNull('scheduled_at')
            ->where('scheduled_at', '>', now())
            ->oldest('scheduled_at');
    }

    public function isPublished(): bool
    {
        return $this->status === 'published'
            && $this->published_at !== null
            && $this->published_at->lte(now());
    }

    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function isScheduled(): bool
    {
        return $this->status === 'scheduled'
            && $this->scheduled_at !== null
            && $this->scheduled_at->gt(now());
    }

    /**
     * Derive the slug from the title when one is not supplied.
     */
    #[Boot]
    protected static function generateSlug(): void
    {
        static::saving(function (Post $post): void {
            if (blank($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    /**
     * Automatically extract and assign category from post content.
     */
    #[Boot]
    protected static function autoAssignCategory(): void
    {
        static::saving(function (Post $post): void {
            if (blank($post->category_id)) {
                $extractor = app(CategoryExtractor::class);
                $category = $extractor->extract($post->title, $post->content);

                if ($category) {
                    $post->category_id = $category->id;
                }
            }
        });
    }
}
