@php
    use Illuminate\Support\Str;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'IIB Group 2') }} — Blog</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */ @layer properties{@supports (((-webkit-hyphens:none)) and (not (margin-trim:inline))) or ((-moz-orient:inline) and (not (color:rgb(from red r g b)))){*,:before,:after,::backdrop{--tw-translate-x:0;--tw-translate-y:0;--tw-translate-z:0;--tw-rotate-x:initial;--tw-rotate-y:initial;--tw-rotate-z:initial;--tw-skew-x:initial;--tw-skew-y:initial;--tw-space-x-reverse:0;--tw-border-style:solid;--tw-leading:initial;--tw-font-weight:initial;--tw-tracking:initial;--tw-shadow:0 0 #0000;--tw-shadow-color:initial;--tw-shadow-alpha:100%;--tw-inset-shadow:0 0 #0000;--tw-inset-shadow-color:initial;--tw-inset-shadow-alpha:100%;--tw-ring-color:initial;--tw-ring-shadow:0 0 #0000;--tw-inset-ring-color:initial;--tw-inset-ring-shadow:0 0 #0000;--tw-ring-inset:initial;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-offset-shadow:0 0 #0000;--tw-blur:initial;--tw-brightness:initial;--tw-contrast:initial;--tw-grayscale:initial;--tw-hue-rotate:initial;--tw-invert:initial;--tw-opacity:initial;--tw-saturate:initial;--tw-sepia:initial;--tw-drop-shadow:initial;--tw-drop-shadow-color:initial;--tw-drop-shadow-alpha:100%;--tw-drop-shadow-size:initial;--tw-duration:initial;--tw-ease:initial;--tw-content:""}}}@layer theme{:root,:host{--font-sans:Inter, ui-sans-serif, system-ui, sans-serif;--font-display:Space Grotesk, ui-sans-serif, system-ui, sans-serif;}}
            </style>
        @endif
        <script>
            (function () {
                try {
                    var stored = localStorage.getItem('theme');
                    var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    if (stored === 'dark' || (!stored && prefersDark)) {
                        document.documentElement.classList.add('dark');
                    }
                } catch (e) {}
            })();
        </script>
    </head>
    <body class="min-h-screen bg-[#e8f6ff] text-[#0f1026] antialiased transition-colors duration-300 dark:bg-[#020617] dark:text-[#e2e8f0]">
        <div class="fixed inset-0 -z-10 overflow-hidden">
            <div class="absolute -top-32 -left-32 h-96 w-96 rounded-full bg-cyan-300/60 blur-[120px] dark:bg-cyan-500/20"></div>
            <div class="absolute top-40 -right-24 h-[28rem] w-[28rem] rounded-full bg-sky-200/70 blur-[140px] dark:bg-sky-500/15"></div>
            <div class="absolute bottom-[-16rem] left-1/3 h-[32rem] w-[32rem] rounded-full bg-blue-200/60 blur-[160px] dark:bg-blue-600/10"></div>
            <div class="absolute inset-x-0 top-0 h-64 bg-gradient-to-b from-white/70 to-transparent dark:from-slate-950/80 dark:to-transparent"></div>
        </div>

        <header class="sticky top-0 z-30">
            <div class="mx-auto max-w-7xl px-6 lg:px-10">
                <nav class="mt-4 flex items-center justify-between rounded-xl border-2 border-[#0f1026] bg-white/80 px-4 py-3 shadow-[6px_6px_0_#0f1026] backdrop-blur-sm transition-colors duration-300 dark:border-cyan-300/60 dark:bg-slate-900/70 dark:shadow-[6px_6px_0_rgba(34,211,238,0.25)]">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('home') }}" class="font-display text-lg font-bold tracking-tight dark:text-cyan-100">{{ config('app.name', 'IIB Group 2') }}</a>
                        <div class="hidden items-center gap-3 text-sm font-medium sm:flex">
                            <a href="{{ route('home') }}" class="hover:underline decoration-2 underline-offset-4">Home</a>
                            <a href="{{ route('blog.index') }}" class="hover:underline decoration-2 underline-offset-4">All Posts</a>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-sm">
                        <button type="button" data-theme-toggle class="inline-flex items-center gap-2 rounded-lg border-2 border-[#0f1026] bg-white px-3 py-1.5 font-semibold shadow-[3px_3px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)]">
                            <span class="dark:hidden">🌙 Dark</span>
                            <span class="hidden dark:inline">☀️ Light</span>
                        </button>
                        <a href="{{ route('blog.index') }}" class="rounded-lg border-2 border-[#0f1026] bg-cyan-300 px-3 py-1.5 font-semibold shadow-[3px_3px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[4px_4px_0_#0f1026] dark:border-cyan-200 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-[3px_3px_0_rgba(34,211,238,0.4)]">Browse Blog</a>
                    </div>
                </nav>
            </div>
        </header>

        <main>
            <section class="mx-auto max-w-7xl px-6 lg:px-10">
                <div class="mt-10 grid gap-8 lg:grid-cols-[minmax(0,2fr)_minmax(0,1fr)] lg:items-center">
                    <div>
                        <span class="inline-flex items-center gap-2 rounded-full border-2 border-[#0f1026] bg-white/70 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] shadow-[3px_3px_0_#0f1026] transition-colors duration-300 dark:border-cyan-300/60 dark:bg-slate-900/70 dark:text-cyan-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)]">Alif × Zenn × Zul</span>
                        <h1 class="mt-6 font-display text-4xl font-bold leading-tight tracking-tight sm:text-5xl lg:text-6xl dark:text-cyan-100">Publish glossy thoughts with hard edges.</h1>
                        <p class="mt-4 max-w-xl text-lg text-[#1f2340] dark:text-slate-400">A bright, glassy blog template with bold drop-shadows, crisp grids, and readable typography built for Laravel.</p>
                        <div class="mt-6 flex flex-wrap items-center gap-3">
                            <a href="{{ route('blog.index') }}" class="rounded-lg border-2 border-[#0f1026] bg-cyan-300 px-5 py-2.5 font-semibold shadow-[4px_4px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[5px_5px_0_#0f1026] dark:border-cyan-200 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-[4px_4px_0_rgba(34,211,238,0.4)] dark:hover:shadow-[5px_5px_0_rgba(34,211,238,0.5)]">Read the archive</a>
                            @if ($categories->isNotEmpty())
                                <a href="{{ route('blog.index', ['category' => $categories->first()]) }}" class="rounded-lg border-2 border-[#0f1026] bg-white px-5 py-2.5 font-semibold shadow-[4px_4px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[5px_5px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[4px_4px_0_rgba(34,211,238,0.25)] dark:hover:shadow-[5px_5px_0_rgba(34,211,238,0.3)]">Explore {{ $categories->first() }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="relative">
                        <div class="absolute -inset-4 rounded-[1.25rem] bg-gradient-to-br from-white/70 via-cyan-100/60 to-sky-200/60 blur-xl dark:from-cyan-500/10 dark:via-sky-500/10 dark:to-blue-600/10"></div>
                        <div class="relative overflow-hidden rounded-[1.25rem] border-2 border-[#0f1026] bg-white shadow-[10px_10px_0_#0f1026] dark:border-cyan-300/60 dark:bg-slate-900/90 dark:shadow-[10px_10px_0_rgba(34,211,238,0.25)]">
                            <div class="flex items-center gap-2 border-b-2 border-[#0f1026] bg-gradient-to-r from-cyan-200 to-sky-200 px-4 py-2 dark:border-cyan-300/60 dark:from-cyan-900/40 dark:to-sky-900/40">
                                <span class="h-2.5 w-2.5 rounded-full border-2 border-[#0f1026] bg-rose-300 dark:border-rose-400/80 dark:bg-rose-500/80"></span>
                                <span class="h-2.5 w-2.5 rounded-full border-2 border-[#0f1026] bg-amber-200 dark:border-amber-400/80 dark:bg-amber-400/80"></span>
                                <span class="h-2.5 w-2.5 rounded-full border-2 border-[#0f1026] bg-emerald-300 dark:border-emerald-400/80 dark:bg-emerald-400/80"></span>
                                <span class="ml-auto text-xs font-semibold uppercase tracking-[0.3em] dark:text-cyan-100">glassy.panel</span>
                            </div>
                            <div class="space-y-4 p-6">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-[#3a3f6b] dark:text-slate-400">Featured</p>
                                    <p class="mt-2 font-display text-2xl font-bold leading-snug dark:text-cyan-100">{{ $featured?->title ?? 'Start writing your first post' }}</p>
                                    <p class="mt-2 text-sm text-[#3a3f6b] dark:text-slate-400">{{ Str::limit($featured?->excerpt ?? 'Seed posts with the factory to populate this landing page.', 110) }}</p>
                                </div>
                                @if ($featured)
                                    <a href="{{ $featured->url }}" class="inline-flex items-center gap-2 rounded-lg border-2 border-[#0f1026] bg-cyan-300 px-4 py-2 text-sm font-semibold shadow-[4px_4px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[5px_5px_0_#0f1026] dark:border-cyan-200 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-[4px_4px_0_rgba(34,211,238,0.4)] dark:hover:shadow-[5px_5px_0_rgba(34,211,238,0.5)]">Read featured →</a>
                                @else
                                    <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 rounded-lg border-2 border-[#0f1026] bg-cyan-300 px-4 py-2 text-sm font-semibold shadow-[4px_4px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[5px_5px_0_#0f1026] dark:border-cyan-200 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-[4px_4px_0_rgba(34,211,238,0.4)] dark:hover:shadow-[5px_5px_0_rgba(34,211,238,0.5)]">Go to blog →</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 lg:px-10">
                <div class="mt-12 flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <h2 class="font-display text-3xl font-bold tracking-tight dark:text-cyan-100">Latest drops</h2>
                        <p class="mt-2 text-[#3a3f6b] dark:text-slate-400">Fresh from the archive, rendered with glossy panels and brutal borders.</p>
                    </div>
                    <a href="{{ route('blog.index') }}" class="rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2 text-sm font-semibold shadow-[3px_3px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:hover:shadow-[4px_4px_0_rgba(34,211,238,0.3)]">View all</a>
                </div>
                <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($latest as $post)
                        <article class="group relative overflow-hidden rounded-[1rem] border-2 border-[#0f1026] bg-white shadow-[8px_8px_0_#0f1026] transition-transform hover:-translate-y-1 hover:shadow-[10px_10px_0_#0f1026] dark:border-cyan-300/60 dark:bg-slate-900/80 dark:shadow-[8px_8px_0_rgba(34,211,238,0.2)] dark:hover:shadow-[10px_10px_0_rgba(34,211,238,0.25)]">
                            <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-cyan-300 via-sky-300 to-blue-300 dark:from-cyan-400 dark:via-sky-400 dark:to-blue-500"></div>
                            <div class="flex flex-col gap-3 p-6">
                                <div class="flex items-center justify-between text-xs font-semibold uppercase tracking-[0.25em] text-[#3a3f6b] dark:text-slate-400">
                                    <span>{{ $post->category }}</span>
                                    <time>{{ $post->published_at?->format('M d, Y') }}</time>
                                </div>
                                <a href="{{ $post->url }}" class="font-display text-xl font-bold leading-snug group-hover:underline decoration-2 underline-offset-4 dark:text-cyan-100">{{ $post->title }}</a>
                                <p class="text-sm text-[#3a3f6b] dark:text-slate-400">{{ Str::limit($post->excerpt, 130) }}</p>
                                <div class="mt-auto flex items-center justify-between text-sm">
                                    <span class="text-[#3a3f6b] dark:text-slate-400">By {{ $post->author_name }}</span>
                                    <span class="rounded-md border-2 border-[#0f1026] bg-cyan-200 px-2 py-1 font-semibold shadow-[2px_2px_0_#0f1026] dark:border-cyan-200 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-[2px_2px_0_rgba(34,211,238,0.4)]">Read →</span>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full rounded-[1rem] border-2 border-dashed border-[#0f1026]/60 bg-white/70 p-10 text-center text-[#3a3f6b] shadow-[6px_6px_0_#0f1026] dark:border-cyan-300/40 dark:bg-slate-900/60 dark:text-slate-400 dark:shadow-[6px_6px_0_rgba(34,211,238,0.2)]">No posts published yet.</div>
                    @endforelse
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 lg:px-10">
                <div class="mt-12 mb-16 rounded-[1.25rem] border-2 border-[#0f1026] bg-gradient-to-br from-white via-cyan-50 to-sky-100 p-8 shadow-[10px_10px_0_#0f1026] sm:p-10 lg:flex lg:items-center lg:justify-between dark:border-cyan-300/60 dark:from-slate-900/90 dark:via-cyan-950/40 dark:to-sky-950/40 dark:shadow-[10px_10px_0_rgba(34,211,238,0.25)]">
                    <div>
                        <span class="inline-flex items-center rounded-full border-2 border-[#0f1026] bg-white px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] shadow-[3px_3px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)]">Browse by vibe</span>
                        <h3 class="mt-4 font-display text-3xl font-bold tracking-tight dark:text-cyan-100">Pick a category and dive in.</h3>
                        <p class="mt-2 max-w-2xl text-[#3a3f6b] dark:text-slate-400">Tutorials, Laravel, PHP, design, career advice, and opinion pieces — all in a glossy, hard-edged theme.</p>
                    </div>
                    @if ($categories->isNotEmpty())
                        <div class="mt-6 flex flex-wrap gap-2 lg:mt-0">
                            @foreach ($categories as $category)
                                <a href="{{ route('blog.index', ['category' => $category]) }}" class="rounded-full border-2 border-[#0f1026] bg-white px-4 py-1.5 text-sm font-semibold shadow-[3px_3px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:hover:shadow-[4px_4px_0_rgba(34,211,238,0.3)]">{{ $category }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
        </main>

        <footer class="border-t-2 border-[#0f1026] bg-white/70 transition-colors duration-300 dark:border-cyan-300/50 dark:bg-slate-950/80">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-6 py-8 text-sm text-[#3a3f6b] sm:flex-row lg:px-10 dark:text-slate-400">
                <p>&copy; {{ now()->year }} {{ config('app.name', 'IIB Group 2') }}. Neo-Brutal × Frutiger Aero.</p>
                <div class="flex items-center gap-4 font-semibold">
                    <a href="{{ route('home') }}" class="hover:underline decoration-2 underline-offset-4">Home</a>
                    <a href="{{ route('blog.index') }}" class="hover:underline decoration-2 underline-offset-4">Blog</a>
                </div>
            </div>
        </footer>

        <script>
            (function () {
                var toggle = document.querySelectorAll('[data-theme-toggle]');
                if (!toggle.length) return;
                toggle.forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        var root = document.documentElement;
                        var isDark = root.classList.toggle('dark');
                        try {
                            localStorage.setItem('theme', isDark ? 'dark' : 'light');
                        } catch (e) {}
                    });
                });
            })();
        </script>
    </body>
</html>
