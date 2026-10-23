@props([
    'title' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ? $title.' · ' : '' }}{{ config('app.name', 'IIB Group 2') }}</title>

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
    <body {{ $attributes->merge(['class' => 'min-h-screen bg-[#e8f6ff] text-[#0f1026] antialiased transition-colors duration-300 dark:bg-[#020617] dark:text-[#e2e8f0]']) }}>
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

        <main class="mx-auto max-w-7xl px-6 lg:px-10 py-10">
            {{ $slot }}
        </main>

        <footer class="border-t-2 border-[#0f1026] bg-white/70 mt-auto transition-colors duration-300 dark:border-cyan-300/50 dark:bg-slate-950/80">
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
                var toggle = document.querySelector('[data-theme-toggle]');
                if (!toggle) return;
                toggle.addEventListener('click', function () {
                    var root = document.documentElement;
                    var isDark = root.classList.toggle('dark');
                    try {
                        localStorage.setItem('theme', isDark ? 'dark' : 'light');
                    } catch (e) {}
                });
            })();
        </script>
    </body>
</html>


