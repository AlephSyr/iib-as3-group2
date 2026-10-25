@props(['title' => null])

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ? $title.' · ' : '' }}Admin · {{ config('app.name', 'IIB Group 2') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                        <a href="{{ route('admin.dashboard') }}" class="font-display text-lg font-bold tracking-tight dark:text-cyan-100">{{ config('app.name', 'IIB Group 2') }}</a>
                        <span class="text-xs font-semibold uppercase tracking-[0.25em] rounded-lg border-2 border-[#0f1026] bg-cyan-100 px-2 py-1 dark:border-cyan-300/60 dark:bg-cyan-900/30 dark:text-cyan-100 shadow-[2px_2px_0_#0f1026] dark:shadow-[2px_2px_0_rgba(34,211,238,0.25)]">Admin</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm">
                        <a href="{{ route('home') }}" class="rounded-lg border-2 border-[#0f1026] bg-white px-3 py-1.5 font-semibold shadow-[3px_3px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)]">View Site</a>
                        <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="rounded-lg border-2 border-[#0f1026] bg-white px-3 py-1.5 font-semibold shadow-[3px_3px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)]">Sign out</button>
                        </form>
                    </div>
                </nav>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-6 lg:px-10 py-10 min-h-[60vh]">
            @if (session('success'))
                <div class="mb-6 rounded-lg border-2 border-[#0f1026] bg-cyan-100 px-4 py-3 shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/60 dark:bg-cyan-900/20 dark:text-cyan-100 dark:shadow-[4px_4px_0_rgba(34,211,238,0.25)]">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 rounded-lg border-2 border-[#0f1026] bg-rose-100 px-4 py-3 shadow-[4px_4px_0_#0f1026] dark:border-rose-400/60 dark:bg-rose-900/20 dark:text-rose-100 dark:shadow-[4px_4px_0_rgba(239,68,68,0.25)]">
                    {{ session('error') }}
                </div>
            @endif

            {{ $slot }}
        </main>

        <footer class="border-t-2 border-[#0f1026] bg-white/70 mt-auto transition-colors duration-300 dark:border-cyan-300/50 dark:bg-slate-950/80">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-6 py-8 text-sm text-[#3a3f6b] sm:flex-row lg:px-10 dark:text-slate-400">
                <p>&copy; {{ now()->year }} {{ config('app.name', 'IIB Group 2') }}. Admin Panel.</p>
                <div class="flex items-center gap-4 font-semibold">
                    <a href="{{ route('admin.dashboard') }}" class="hover:underline decoration-2 underline-offset-4">Dashboard</a>
                    <a href="{{ route('admin.posts.index') }}" class="hover:underline decoration-2 underline-offset-4">Posts</a>
                    <a href="{{ route('admin.categories.index') }}" class="hover:underline decoration-2 underline-offset-4">Categories</a>
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
