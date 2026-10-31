<x-admin-layout title="Sign In">
    <div class="mx-auto max-w-2xl py-12">
        <div class="rounded-[1.25rem] border-2 border-[#0f1026] bg-white shadow-[12px_12px_0_#0f1026] dark:border-cyan-300/60 dark:bg-slate-900/90 dark:shadow-[12px_12px_0_rgba(34,211,238,0.25)]">
            <div class="p-8 sm:p-10">
                <div class="text-center mb-8">
                    <a href="{{ route('admin.dashboard') }}" class="font-display text-2xl font-bold tracking-tight dark:text-cyan-100">{{ config('app.name', 'IIB Group 2') }}</a>
                    <p class="mt-2 text-sm text-[#3a3f6b] dark:text-slate-400">Admin sign-in</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 rounded-lg border-2 border-[#0f1026] bg-rose-100 px-4 py-3 shadow-[4px_4px_0_#0f1026] dark:border-rose-400/60 dark:bg-rose-900/20 dark:text-rose-100 dark:shadow-[4px_4px_0_rgba(239,68,68,0.25)]">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.store') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Email address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">
                    </div>

                    <div class="mb-8">
                        <label for="password" class="block mb-2 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Password</label>
                        <input id="password" type="password" name="password" required class="w-full rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">
                    </div>

                    <button type="submit" class="w-full rounded-lg border-2 border-[#0f1026] bg-cyan-300 px-4 py-3 font-semibold shadow-[4px_4px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[5px_5px_0_#0f1026] dark:border-cyan-200 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-[4px_4px_0_rgba(34,211,238,0.4)] dark:hover:shadow-[5px_5px_0_rgba(34,211,238,0.5)]">
                        Sign in
                    </button>
                </form>

                <div class="mt-8 text-center text-sm text-[#3a3f6b] dark:text-slate-400">
                    <a href="{{ route('home') }}" class="hover:underline decoration-2 underline-offset-4 dark:text-cyan-100">← Back to site</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
