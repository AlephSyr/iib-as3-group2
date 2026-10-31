<x-admin-layout title="Posts">
    <div class="mb-8">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="font-display text-3xl font-bold tracking-tight dark:text-cyan-100">All Posts</h1>
                <p class="mt-2 text-[#3a3f6b] dark:text-slate-400">Manage your blog posts.</p>
            </div>
            <a href="{{ route('admin.posts.create') }}" class="rounded-lg border-2 border-[#0f1026] bg-cyan-300 px-5 py-2.5 font-semibold shadow-[4px_4px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[5px_5px_0_#0f1026] dark:border-cyan-200 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-[4px_4px_0_rgba(34,211,238,0.4)] dark:hover:shadow-[5px_5px_0_rgba(34,211,238,0.5)]">New Post</a>
        </div>
    </div>

    <div class="rounded-[1rem] border-2 border-[#0f1026] bg-white shadow-[6px_6px_0_#0f1026] dark:border-cyan-300/60 dark:bg-slate-900/80 dark:shadow-[6px_6px_0_rgba(34,211,238,0.2)]">
        <div class="p-6">
            <form method="GET" class="flex flex-wrap gap-4 mb-6">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search posts..." class="w-full md:w-64 rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">
                </div>
                <select name="status" class="rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">
                    <option value="">All statuses</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                <select name="category" class="rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">
                    <option value="">All categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="rounded-lg border-2 border-[#0f1026] bg-cyan-300 px-5 py-2.5 font-semibold shadow-[4px_4px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[5px_5px_0_#0f1026] dark:border-cyan-200 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-[4px_4px_0_rgba(34,211,238,0.4)] dark:hover:shadow-[5px_5px_0_rgba(34,211,238,0.5)]">Filter</button>
                <a href="{{ route('admin.posts.index') }}" class="rounded-lg border-2 border-[#0f1026] bg-white px-5 py-2.5 font-semibold shadow-[4px_4px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[5px_5px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[4px_4px_0_rgba(34,211,238,0.25)] dark:hover:shadow-[5px_5px_0_rgba(34,211,238,0.3)]">Clear</a>
            </form>
        </div>

        @if ($posts->isNotEmpty())
            <div class="p-5 overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-[#0f1026] dark:border-cyan-300/60">
                            <th class="pb-4 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Title</th>
                            <th class="pb-4 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Category</th>
                            <th class="pb-4 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Author</th>
                            <th class="pb-4 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Status</th>
                            <th class="pb-4 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Published</th>
                            <th class="pb-4 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr class="border-b border-[#0f1026]/30 hover:bg-white/50 transition-colors dark:border-cyan-300/20 dark:hover:bg-slate-950/30 group">
                                <td class="py-4">
                                    <a href="{{ route('admin.posts.show', $post->slug) }}" class="text-sm font-medium dark:text-cyan-100 hover:underline decoration-2 underline-offset-4">{{ $post->title }}</a>
                                </td>
                                <td class="py-4 text-sm">
                                    <span class="inline-flex items-center rounded-full border-2 border-[#0f1026] px-2.5 py-0.5 text-xs font-semibold shadow-[2px_2px_0_#0f1026] dark:border-cyan-300/60 dark:text-cyan-100 dark:shadow-[2px_2px_0_rgba(34,211,238,0.25)]" style="background-color: {{ $post->category?->color ?? '#0f1026' }}">
                                        {{ $post->category?->name ?? 'Uncategorized' }}
                                    </span>
                                </td>
                                <td class="py-4 text-sm text-[#3a3f6b] dark:text-slate-400">{{ $post->author_name }}</td>
                                <td class="py-4 text-sm">
                                    <span class="inline-flex items-center rounded-full border-2 border-[#0f1026] px-2.5 py-0.5 text-xs font-semibold shadow-[2px_2px_0_#0f1026] dark:border-cyan-300/60 dark:text-cyan-100 dark:shadow-[2px_2px_0_rgba(34,211,238,0.25)] {{ $post->status === 'published' ? 'bg-cyan-100 dark:bg-cyan-900/30' : ($post->status === 'draft' ? 'bg-rose-100 dark:bg-rose-900/30' : 'bg-amber-100 dark:bg-amber-900/30') }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </td>
                                <td class="py-4 text-sm text-[#3a3f6b] dark:text-slate-400">
                                    {{ $post->published_at?->format('M d, Y') ?? '-' }}
                                </td>
                                <td class="py-4 text-right">
                                    <a href="{{ route('admin.posts.show', $post->slug) }}" class="rounded-md border-2 border-[#0f1026] bg-white px-3 py-1.5 text-xs font-semibold shadow-[2px_2px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[3px_3px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[2px_2px_0_rgba(34,211,238,0.25)] dark:hover:shadow-[3px_3px_0_rgba(34,211,238,0.3)] mr-2">View</a>
                                    <a href="{{ route('admin.posts.edit', $post->slug) }}" class="rounded-md border-2 border-[#0f1026] bg-white px-3 py-1.5 text-xs font-semibold shadow-[2px_2px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[3px_3px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[2px_2px_0_rgba(34,211,238,0.25)] dark:hover:shadow-[3px_3px_0_rgba(34,211,238,0.3)]">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t-2 border-[#0f1026] dark:border-cyan-300/60">
                {{ $posts->links() }}
            </div>
        @else
            <div class="p-8 text-center text-[#3a3f6b] dark:text-slate-400">No posts found.</div>
        @endif
    </div>
</x-admin-layout>
