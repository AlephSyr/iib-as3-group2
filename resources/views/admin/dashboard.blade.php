<x-admin-layout title="Dashboard">
    <div class="mb-8">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="font-display text-3xl font-bold tracking-tight dark:text-cyan-100">Dashboard</h1>
                <p class="mt-2 text-[#3a3f6b] dark:text-slate-400">Overview of your blog content and activity.</p>
            </div>
            <a href="{{ route('admin.posts.create') }}" class="rounded-lg border-2 border-[#0f1026] bg-cyan-300 px-5 py-2.5 font-semibold shadow-[4px_4px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[5px_5px_0_#0f1026] dark:border-cyan-200 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-[4px_4px_0_rgba(34,211,238,0.4)] dark:hover:shadow-[5px_5px_0_rgba(34,211,238,0.5)]">New Post</a>
        </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($stats as $label => $value)
            <div class="rounded-[1rem] border-2 border-[#0f1026] bg-white p-5 shadow-[6px_6px_0_#0f1026] dark:border-cyan-300/60 dark:bg-slate-900/80 dark:shadow-[6px_6px_0_rgba(34,211,238,0.2)]">
                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-[#3a3f6b] dark:text-slate-400 mb-2">{{ ucfirst(str_replace('_', ' ', $label)) }}</p>
                <p class="font-display text-2xl font-bold dark:text-cyan-100">{{ $value }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-10 rounded-[1rem] border-2 border-[#0f1026] bg-white shadow-[6px_6px_0_#0f1026] dark:border-cyan-300/60 dark:bg-slate-900/80 dark:shadow-[6px_6px_0_rgba(34,211,238,0.2)] overflow-hidden">
        <div class="p-5 border-b-2 border-[#0f1026] dark:border-cyan-300/60">
            <h2 class="font-display text-xl font-bold dark:text-cyan-100">Recent Posts</h2>
        </div>
        <div class="p-5 overflow-x-auto">
            @if ($recentPosts->isNotEmpty())
                <table class="w-full text-left border-collapse min-w-full">
                    <thead>
                        <tr class="border-b-2 border-[#0f1026] dark:border-cyan-300/60">
                            <th class="pb-3 text-xs font-semibold uppercase tracking-[0.25em] text-[#3a3f6b] dark:text-slate-400">Title</th>
                            <th class="pb-3 text-xs font-semibold uppercase tracking-[0.25em] text-[#3a3f6b] dark:text-slate-400">Category</th>
                            <th class="pb-3 text-xs font-semibold uppercase tracking-[0.25em] text-[#3a3f6b] dark:text-slate-400">Status</th>
                            <th class="pb-3 text-xs font-semibold uppercase tracking-[0.25em] text-[#3a3f6b] dark:text-slate-400">Updated</th>
                            <th class="pb-3 text-xs font-semibold uppercase tracking-[0.25em] text-[#3a3f6b] dark:text-slate-400 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentPosts as $post)
                            <tr class="border-b border-[#0f1026]/30 hover:bg-white/50 transition-colors dark:border-cyan-300/20 dark:hover:bg-slate-950/30">
                                <td class="py-3 text-sm font-medium dark:text-slate-200">{{ $post->title }}</td>
                                <td class="py-3 text-sm">
                                    <span class="inline-flex items-center rounded-full border-2 border-[#0f1026] px-2 py-0.5 text-[10px] font-semibold shadow-[2px_2px_0_#0f1026] dark:border-cyan-300/60 dark:text-cyan-100 dark:shadow-[2px_2px_0_rgba(34,211,238,0.25)]" style="background-color: {{ $post->category?->color ?? '#0f1026' }}">
                                        {{ $post->category?->name ?? 'Uncategorized' }}
                                    </span>
                                </td>
                                <td class="py-3 text-sm">
                                    <span class="inline-flex items-center rounded-full border-2 border-[#0f1026] px-2 py-0.5 text-[10px] font-semibold shadow-[2px_2px_0_#0f1026] dark:border-cyan-300/60 dark:text-cyan-100 dark:shadow-[2px_2px_0_rgba(34,211,238,0.25)] {{ $post->status === 'published' ? 'bg-cyan-100 dark:bg-cyan-900/30' : ($post->status === 'draft' ? 'bg-rose-100 dark:bg-rose-900/30' : 'bg-amber-100 dark:bg-amber-900/30') }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </td>
                                <td class="py-3 text-sm text-[#3a3f6b] dark:text-slate-400">{{ $post->updated_at?->format('M d, Y') }}</td>
                                <td class="py-3 text-sm text-right">
                                    <a href="{{ route('admin.posts.show', $post->slug) }}" class="rounded-md border-2 border-[#0f1026] bg-white px-3 py-1 text-xs font-semibold shadow-[2px_2px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[3px_3px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[2px_2px_0_rgba(34,211,238,0.25)] dark:hover:shadow-[3px_3px_0_rgba(34,211,238,0.3)]">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="py-8 text-center text-[#3a3f6b] dark:text-slate-400">No posts yet.</div>
            @endif
        </div>
    </div>
</x-admin-layout>
