<x-admin-layout title="View Post">
    <div class="max-w-4xl">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <a href="{{ route('admin.posts.index') }}" class="mb-2 inline-flex items-center gap-2 rounded-lg border-2 border-[#0f1026] bg-white px-3 py-1.5 text-sm font-semibold shadow-[3px_3px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)]">← Back to posts</a>
                <h1 class="font-display text-2xl font-bold tracking-tight dark:text-cyan-100">{{ $post->title }}</h1>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.posts.edit', $post->slug) }}" class="rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2 text-sm font-semibold shadow-[3px_3px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)]">Edit</a>
                <form method="POST" action="{{ route('admin.posts.destroy', $post->slug) }}" class="inline" onsubmit="return confirm('Delete this post?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2 text-sm font-semibold shadow-[3px_3px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)]">Delete</button>
                </form>
            </div>
        </div>

        <div class="rounded-[1rem] border-2 border-[#0f1026] bg-white shadow-[6px_6px_0_#0f1026] dark:border-cyan-300/60 dark:bg-slate-900/80 dark:shadow-[6px_6px_0_rgba(34,211,238,0.2)]">
            <div class="p-6 border-b-2 border-[#0f1026] dark:border-cyan-300/60">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center rounded-full border-2 border-[#0f1026] px-2.5 py-0.5 text-xs font-semibold shadow-[2px_2px_0_#0f1026] dark:border-cyan-300/60 dark:text-cyan-100 dark:shadow-[2px_2px_0_rgba(34,211,238,0.25)]" style="background-color: {{ $post->category?->color ?? '#0f1026' }}">
                            {{ $post->category?->name ?? 'Uncategorized' }}
                        </span>
                        <span class="inline-flex items-center rounded-full border-2 border-[#0f1026] px-2.5 py-0.5 text-xs font-semibold shadow-[2px_2px_0_#0f1026] dark:border-cyan-300/60 dark:text-cyan-100 dark:shadow-[2px_2px_0_rgba(34,211,238,0.25)] {{ $post->status === 'published' ? 'bg-cyan-100 dark:bg-cyan-900/30' : ($post->status === 'draft' ? 'bg-rose-100 dark:bg-rose-900/30' : 'bg-amber-100 dark:bg-amber-900/30') }}">
                            {{ ucfirst($post->status) }}
                        </span>
                    </div>
                    <a href="{{ $post->url }}" target="_blank" class="rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2 text-sm font-semibold shadow-[3px_3px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)]">View on site</a>
                </div>
            </div>

            <div class="p-6">
                <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="border-b-2 border-[#0f1026]/30 pb-4 dark:border-cyan-300/20">
                        <dt class="text-xs font-semibold uppercase tracking-[0.25em] text-[#3a3f6b] dark:text-slate-400">Title</dt>
                        <dd class="mt-1 text-sm font-medium dark:text-slate-200">{{ $post->title }}</dd>
                    </div>
                    <div class="border-b-2 border-[#0f1026]/30 pb-4 dark:border-cyan-300/20">
                        <dt class="text-xs font-semibold uppercase tracking-[0.25em] text-[#3a3f6b] dark:text-slate-400">Slug</dt>
                        <dd class="mt-1 text-sm font-mono text-[#3a3f6b] dark:text-slate-400">{{ $post->slug }}</dd>
                    </div>
                    <div class="border-b-2 border-[#0f1026]/30 pb-4 dark:border-cyan-300/20">
                        <dt class="text-xs font-semibold uppercase tracking-[0.25em] text-[#3a3f6b] dark:text-slate-400">Author</dt>
                        <dd class="mt-1 text-sm font-medium dark:text-slate-200">{{ $post->author_name }}</dd>
                    </div>
                    <div class="border-b-2 border-[#0f1026]/30 pb-4 dark:border-cyan-300/20">
                        <dt class="text-xs font-semibold uppercase tracking-[0.25em] text-[#3a3f6b] dark:text-slate-400">Category</dt>
                        <dd class="mt-1 text-sm font-medium dark:text-slate-200">{{ $post->category?->name ?? 'Uncategorized' }}</dd>
                    </div>
                    <div class="border-b-2 border-[#0f1026]/30 pb-4 dark:border-cyan-300/20">
                        <dt class="text-xs font-semibold uppercase tracking-[0.25em] text-[#3a3f6b] dark:text-slate-400">Published At</dt>
                        <dd class="mt-1 text-sm font-medium dark:text-slate-200">{{ $post->published_at?->format('M d, Y h:i A') ?? 'Not published' }}</dd>
                    </div>
                    <div class="border-b-2 border-[#0f1026]/30 pb-4 dark:border-cyan-300/20">
                        <dt class="text-xs font-semibold uppercase tracking-[0.25em] text-[#3a3f6b] dark:text-slate-400">Scheduled At</dt>
                        <dd class="mt-1 text-sm font-medium dark:text-slate-200">{{ $post->scheduled_at?->format('M d, Y h:i A') ?? 'Not scheduled' }}</dd>
                    </div>
                    <div class="border-b-2 border-[#0f1026]/30 pb-4 dark:border-cyan-300/20">
                        <dt class="text-xs font-semibold uppercase tracking-[0.25em] text-[#3a3f6b] dark:text-slate-400">Created</dt>
                        <dd class="mt-1 text-sm font-medium dark:text-slate-200">{{ $post->created_at->format('M d, Y h:i A') }}</dd>
                    </div>
                    <div class="border-b-2 border-[#0f1026]/30 pb-4 dark:border-cyan-300/20">
                        <dt class="text-xs font-semibold uppercase tracking-[0.25em] text-[#3a3f6b] dark:text-slate-400">Updated</dt>
                        <dd class="mt-1 text-sm font-medium dark:text-slate-200">{{ $post->updated_at->format('M d, Y h:i A') }}</dd>
                    </div>
                </dl>
            </div>

            <div class="p-6 border-t-2 border-[#0f1026] dark:border-cyan-300/60">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-display text-lg font-bold dark:text-cyan-100">Excerpt</h2>
                </div>
                <div class="prose p-4 border-2 border-[#0f1026] bg-white shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/60 dark:bg-slate-950/80 dark:shadow-[4px_4px_0_rgba(34,211,238,0.25)]">
                    {{ $post->excerpt }}
                </div>
            </div>

            <div class="p-6 border-t-2 border-[#0f1026] dark:border-cyan-300/60">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-display text-lg font-bold dark:text-cyan-100">Content</h2>
                </div>
                <div class="prose p-4 border-2 border-[#0f1026] bg-white shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/60 dark:bg-slate-950/80 dark:shadow-[4px_4px_0_rgba(34,211,238,0.25)]">
                    {!! $post->content !!}
                </div>
            </div>

            @if ($post->featured_image)
                <div class="p-6 border-t-2 border-[#0f1026] dark:border-cyan-300/60">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-display text-lg font-bold dark:text-cyan-100">Featured Image</h2>
                    </div>
                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="rounded-lg border-2 border-[#0f1026] shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/60 dark:shadow-[4px_4px_0_rgba(34,211,238,0.25)] max-w-full">
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
