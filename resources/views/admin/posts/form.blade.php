<x-admin-layout title="{{ isset($post) ? 'Edit Post' : 'New Post' }}">
    <div class="max-w-3xl">
        <form method="POST" action="{{ isset($post) ? route('admin.posts.update', $post->slug) : route('admin.posts.store') }}">
            @csrf
            @if (isset($post))
                @method('PUT')
            @endif

            <div class="mb-6 flex items-center justify-between">
                <h1 class="font-display text-2xl font-bold tracking-tight dark:text-cyan-100">{{ isset($post) ? 'Edit Post' : 'New Post' }}</h1>
                <a href="{{ isset($post) ? route('admin.posts.show', $post->slug) : route('admin.posts.index') }}" class="rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2 text-sm font-semibold shadow-[3px_3px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)]">Cancel</a>
            </div>

            <div class="rounded-[1rem] border-2 border-[#0f1026] bg-white p-6 shadow-[6px_6px_0_#0f1026] dark:border-cyan-300/60 dark:bg-slate-900/80 dark:shadow-[6px_6px_0_rgba(34,211,238,0.2)]">
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="mb-6">
                        <label for="title" class="block mb-2 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Title</label>
                        <input id="title" type="text" name="title" value="{{ old('title', $post?->title ?? '') }}" required class="w-full rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">
                    </div>

                    <div class="mb-6">
                        <label for="slug" class="block mb-2 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Slug</label>
                        <input id="slug" type="text" name="slug" value="{{ old('slug', $post?->slug ?? '') }}" required class="w-full rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">
                    </div>

                    <div class="mb-6">
                        <label for="category_id" class="block mb-2 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Category</label>
                        <select id="category_id" name="category_id" class="w-full rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">
                            <option value="">Auto-extract from content</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $post?->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="author_name" class="block mb-2 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Author Name</label>
                        <input id="author_name" type="text" name="author_name" value="{{ old('author_name', $post?->author_name ?? '') }}" required class="w-full rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">
                    </div>

                    <div class="mb-6">
                        <label for="status" class="block mb-2 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Status</label>
                        <select id="status" name="status" class="w-full rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">
                            <option value="draft" {{ old('status', $post?->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $post?->status ?? 'draft') === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="scheduled" {{ old('status', $post?->status ?? 'draft') === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="featured_image" class="block mb-2 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Featured Image URL</label>
                        <input id="featured_image" type="url" name="featured_image" value="{{ old('featured_image', $post?->featured_image ?? '') }}" placeholder="https://example.com/image.jpg" class="w-full rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="excerpt" class="block mb-2 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Excerpt</label>
                    <textarea id="excerpt" name="excerpt" rows="3" required class="w-full rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">{{ old('excerpt', $post?->excerpt ?? '') }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="content" class="block mb-2 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Content (HTML)</label>
                    <textarea id="content" name="content" rows="12" required class="w-full rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors font-mono text-sm dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">{{ old('content', $post?->content ?? '') }}</textarea>
                    <p class="mt-1 text-xs text-[#3a3f6b] dark:text-slate-500">Category is auto-extracted from content if not selected.</p>
                </div>

                <div class="rounded-[1rem] border-2 border-[#0f1026] bg-white p-6 shadow-[6px_6px_0_#0f1026] dark:border-cyan-300/60 dark:bg-slate-900/80 dark:shadow-[6px_6px_0_rgba(34,211,238,0.2)]">
                    <div class="grid gap-6 md:grid-cols-3">
                        <div class="mb-6">
                            <label for="status_display" class="block mb-2 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Publish Status</label>
                            <select id="status_display" name="status" class="w-full rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">
                                <option value="draft" {{ old('status', $post?->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $post?->status ?? 'draft') === 'published' ? 'selected' : '' }}>Published</option>
                                <option value="scheduled" {{ old('status', $post?->status ?? 'draft') === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="published_at" class="block mb-2 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Published By</label>
                            <div class="relative">
                                <input id="published_at" type="datetime-local" name="published_at" value="{{ old('published_at', isset($post) ? ($post->published_at?->format('Y-m-d\H:i') ?? now()->format('Y-m-d\H:i')) : now()->format('Y-m-d\H:i')) ?? now()->format('Y-m-d\H:i') }}" class="w-full rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 pr-10 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">
                                <button type="button" class="absolute inset-y-0 right-2.5 flex items-center pr-1 text-[#0f1026] dark:text-cyan-100 pointer-events-none select-none opacity-60">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                </button>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="scheduled_at" class="block mb-2 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Scheduled At</label>
                            <div class="relative">
                                <input id="scheduled_at" type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at', isset($post) ? $post->scheduled_at?->format('Y-m-d\H:i') : '') }}" class="w-full rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 pr-10 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">
                                <button type="button" class="absolute inset-y-0 right-2.5 flex items-center pr-1 text-[#0f1026] dark:text-cyan-100 pointer-events-none select-none opacity-60">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                </button>
                            </div>
                            <p class="mt-1 text-xs text-[#3a3f6b] dark:text-slate-500">Only used when status is Scheduled.</p>
                        </div>
                    </div>
                </div>

            <div class="mt-8 flex gap-3">
                <button type="submit" class="rounded-lg border-2 border-[#0f1026] bg-cyan-300 px-6 py-3 font-semibold shadow-[4px_4px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[5px_5px_0_#0f1026] dark:border-cyan-200 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-[4px_4px_0_rgba(34,211,238,0.4)] dark:hover:shadow-[5px_5px_0_rgba(34,211,238,0.5)]">
                    {{ isset($post) ? 'Update Post' : 'Create Post' }}
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
