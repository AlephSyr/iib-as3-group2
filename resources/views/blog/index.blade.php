<x-layout title="Blog">
    <div class="mb-10">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full border-2 border-[#0f1026] bg-white/70 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] shadow-[3px_3px_0_#0f1026] transition-colors duration-300 dark:border-cyan-300/60 dark:bg-slate-900/70 dark:text-cyan-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)]">Archive</span>
                <h1 class="mt-4 font-display text-4xl font-bold tracking-tight sm:text-5xl dark:text-cyan-100">The Blog</h1>
                <p class="mt-2 max-w-2xl text-lg text-[#3a3f6b] dark:text-slate-400">Glossy ideas, hard edges. Browse by category or scroll through everything.</p>
            </div>
            <a href="{{ route('home') }}" class="rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2 text-sm font-semibold shadow-[3px_3px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)]">Back to home</a>
        </div>
    </div>

    <div class="mb-10 flex flex-wrap items-center gap-2">
        <a href="{{ route('blog.index') }}"
            class="rounded-full border-2 border-[#0f1026] px-4 py-1.5 text-sm font-semibold shadow-[3px_3px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/70 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] {{ request('category') === null ? 'bg-cyan-300 dark:bg-cyan-400 dark:text-slate-950' : 'bg-white dark:bg-slate-950/80 dark:text-cyan-100' }}">
            All
        </a>
        @foreach ($categories as $category)
            <a href="{{ route('blog.index', ['category' => $category]) }}"
                class="rounded-full border-2 border-[#0f1026] px-4 py-1.5 text-sm font-semibold shadow-[3px_3px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/70 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] {{ request('category') === $category ? 'bg-cyan-300 dark:bg-cyan-400 dark:text-slate-950' : 'bg-white dark:bg-slate-950/80 dark:text-cyan-100' }}">
                {{ $category }}
            </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($posts as $post)
            <article class="group relative overflow-hidden rounded-[1rem] border-2 border-[#0f1026] bg-white shadow-[8px_8px_0_#0f1026] transition-transform hover:-translate-y-1 hover:shadow-[10px_10px_0_#0f1026] dark:border-cyan-300/60 dark:bg-slate-900/80 dark:shadow-[8px_8px_0_rgba(34,211,238,0.2)] dark:hover:shadow-[10px_10px_0_rgba(34,211,238,0.25)]">
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-cyan-300 via-sky-300 to-blue-300 dark:from-cyan-400 dark:via-sky-400 dark:to-blue-500"></div>
                @if ($post->featured_image)
                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="h-48 w-full object-cover">
                @endif
                <div class="flex flex-col gap-3 p-6">
                    <div class="flex items-center justify-between text-xs font-semibold uppercase tracking-[0.25em] text-[#3a3f6b] dark:text-slate-400">
                        <span>{{ $post->category }}</span>
                        <time>{{ $post->published_at?->format('M d, Y') }}</time>
                    </div>
                    <a href="{{ $post->url }}" class="font-display text-xl font-bold leading-snug group-hover:underline decoration-2 underline-offset-4 dark:text-cyan-100">{{ $post->title }}</a>
                    <p class="text-sm text-[#3a3f6b] line-clamp-3 dark:text-slate-400">{{ $post->excerpt }}</p>
                    <div class="mt-auto flex items-center justify-between text-sm">
                        <span class="text-[#3a3f6b] dark:text-slate-400">By {{ $post->author_name }}</span>
                        <span class="rounded-md border-2 border-[#0f1026] bg-cyan-200 px-2 py-1 font-semibold shadow-[2px_2px_0_#0f1026] dark:border-cyan-200 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-[2px_2px_0_rgba(34,211,238,0.4)]">Read →</span>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-[1rem] border-2 border-dashed border-[#0f1026]/60 bg-white/70 p-10 text-center text-[#3a3f6b] shadow-[6px_6px_0_#0f1026] dark:border-cyan-300/40 dark:bg-slate-900/60 dark:text-slate-400 dark:shadow-[6px_6px_0_rgba(34,211,238,0.2)]">
                No posts yet. Check back soon.
            </div>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $posts->links() }}
    </div>
</x-layout>

