<x-layout title="{{ $post->title }}">
    <article class="max-w-4xl mx-auto">
        <header class="mb-10">
            <a href="{{ route('blog.index') }}" class="mb-6 inline-flex items-center gap-2 rounded-lg border-2 border-[#0f1026] bg-white px-3 py-1.5 text-sm font-semibold shadow-[3px_3px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)]">← Back to archive</a>
            @if ($post->featured_image)
                <div class="mt-6 overflow-hidden rounded-[1.25rem] border-2 border-[#0f1026] shadow-[10px_10px_0_#0f1026] dark:border-cyan-300/60 dark:shadow-[10px_10px_0_rgba(34,211,238,0.25)]">
                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="h-72 w-full object-cover">
                </div>
            @endif
            <div class="mt-6 flex flex-wrap items-center gap-3">
                <span class="inline-flex items-center rounded-full border-2 border-[#0f1026] bg-cyan-300 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] shadow-[3px_3px_0_#0f1026] dark:border-cyan-200 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-[3px_3px_0_rgba(34,211,238,0.4)]">
                    {{ $post->category->name ?? 'Uncategorized' }}
                </span>
                <time class="text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">{{ $post->published_at?->format('F d, Y') }}</time>
                <span class="text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">By {{ $post->author_name }}</span>
                <form action="{{ route('blog.like', $post->slug) }}" method="POST">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-1 rounded-full border-2 border-[#0f1026] bg-cyan-300 px-3 py-1 text-xs font-semibold shadow-[3px_3px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[4px_4px_0_#0f1026] dark:border-cyan-200 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-[3px_3px_0_rgba(34,211,238,0.4)] dark:hover:shadow-[4px_4px_0_rgba(34,211,238,0.5)]">
                        ♥ {{ $post->like ?? 0 }} likes
                    </button>
                </form>
            </div>
            <h1 class="mt-4 font-display text-4xl font-bold leading-tight tracking-tight sm:text-5xl lg:text-6xl dark:text-cyan-100">
                {{ $post->title }}
            </h1>
            <p class="mt-4 max-w-2xl text-lg text-[#3a3f6b] dark:text-slate-400">
                {{ $post->excerpt }}
            </p>
        </header>

        <div class="relative">
            <div class="absolute -inset-4 -z-10 rounded-[1.25rem] bg-gradient-to-br from-white/70 via-cyan-100/60 to-sky-200/60 blur-xl dark:from-cyan-500/10 dark:via-sky-500/10 dark:to-blue-600/10"></div>
            <div class="prose max-w-none rounded-[1.25rem] border-2 border-[#0f1026] bg-white p-6 shadow-[10px_10px_0_#0f1026] sm:p-10 lg:p-12 dark:border-cyan-300/60 dark:bg-slate-900/90 dark:shadow-[10px_10px_0_rgba(34,211,238,0.25)]">
                {!! $post->content !!}
            </div>
        </div>
    </article>

    <div class="mx-auto mt-12 flex max-w-4xl flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        @if ($previous)
            <a href="{{ $previous->url }}" class="flex items-center gap-3 rounded-[1rem] border-2 border-[#0f1026] bg-white px-5 py-4 shadow-[6px_6px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[8px_8px_0_#0f1026] dark:border-cyan-300/60 dark:bg-slate-900/80 dark:shadow-[6px_6px_0_rgba(34,211,238,0.2)] dark:hover:shadow-[8px_8px_0_rgba(34,211,238,0.25)]">
                <svg width="16" height="16" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-[#0f1026] dark:text-cyan-100">
                    <path d="M10.5 7.00031H3.5M3.5 7.00031L7.5 3.00031M3.5 7.00031L7.5 11.0003" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-[#3a3f6b] dark:text-slate-400">Previous</p>
                    <p class="font-display font-semibold dark:text-cyan-100">{{ $previous->title }}</p>
                </div>
            </a>
        @else
            <div></div>
        @endif

        @if ($next)
            <a href="{{ $next->url }}" class="flex items-center gap-3 rounded-[1rem] border-2 border-[#0f1026] bg-white px-5 py-4 text-right shadow-[6px_6px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[8px_8px_0_#0f1026] sm:ml-auto dark:border-cyan-300/60 dark:bg-slate-900/80 dark:shadow-[6px_6px_0_rgba(34,211,238,0.2)] dark:hover:shadow-[8px_8px_0_rgba(34,211,238,0.25)]">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-[#3a3f6b] dark:text-slate-400">Next</p>
                    <p class="font-display font-semibold dark:text-cyan-100">{{ $next->title }}</p>
                </div>
                <svg width="16" height="16" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-[#0f1026] dark:text-cyan-100">
                    <path d="M3.5 7.00031H10.5M10.5 7.00031L6.5 3.00031M10.5 7.00031L6.5 11.0003" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </a>
        @endif
    </div>
</x-layout>

