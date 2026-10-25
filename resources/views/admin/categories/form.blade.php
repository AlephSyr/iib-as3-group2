<x-admin-layout title="{{ isset($category) ? 'Edit Category' : 'New Category' }}">
    <div class="max-w-2xl">
        <form method="POST" action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}">
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif

            <div class="mb-6 flex items-center justify-between">
                <h1 class="font-display text-2xl font-bold tracking-tight dark:text-cyan-100">{{ isset($category) ? 'Edit Category' : 'New Category' }}</h1>
                <a href="{{ route('admin.categories.index') }}" class="rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2 text-sm font-semibold shadow-[3px_3px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[4px_4px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)]">Cancel</a>
            </div>

            <div class="rounded-[1rem] border-2 border-[#0f1026] bg-white p-6 shadow-[6px_6px_0_#0f1026] dark:border-cyan-300/60 dark:bg-slate-900/80 dark:shadow-[6px_6px_0_rgba(34,211,238,0.2)]">
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $category?->name ?? '') }}" required class="w-full rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">
                    </div>

                    <div class="mb-6">
                        <label for="slug" class="block mb-2 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Slug</label>
                        <input id="slug" type="text" name="slug" value="{{ old('slug', $category?->slug ?? '') }}" required class="w-full rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">
                    </div>

                    <div class="mb-6">
                        <label for="color" class="block mb-2 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Color</label>
                        <input id="color" type="color" name="color" value="{{ old('color', $category?->color ?? '#0f1026') }}" class="w-full rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400 h-10 p-0">
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block mb-2 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Description</label>
                        <textarea id="description" name="description" rows="3" class="w-full rounded-lg border-2 border-[#0f1026] bg-white px-4 py-2.5 shadow-[3px_3px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:text-slate-100 dark:shadow-[3px_3px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400">{{ old('description', $category?->description ?? '') }}</textarea>
                    </div>

                    <div class="mb-6">
                        <div class="flex items-center">
                            <input id="is_active" name="is_active" type="checkbox" class="rounded border-2 border-[#0f1026] bg-white shadow-[2px_2px_0_#0f1026] focus:border-cyan-500 focus:outline-none transition-colors dark:border-cyan-300/60 dark:bg-slate-950/80 dark:shadow-[2px_2px_0_rgba(34,211,238,0.25)] dark:focus:border-cyan-400" {{ old('is_active', $category?->is_active ?? true) ? 'checked' : '' }}>
                            <label for="is_active" class="ml-3 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Active (shown on site)</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex gap-3">
                <button type="submit" class="rounded-lg border-2 border-[#0f1026] bg-cyan-300 px-6 py-3 font-semibold shadow-[4px_4px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[5px_5px_0_#0f1026] dark:border-cyan-200 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-[4px_4px_0_rgba(34,211,238,0.4)] dark:hover:shadow-[5px_5px_0_rgba(34,211,238,0.5)]">
                    {{ isset($category) ? 'Update Category' : 'Create Category' }}
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
