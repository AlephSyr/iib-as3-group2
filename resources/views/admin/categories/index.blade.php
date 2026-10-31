<x-admin-layout title="Categories">
    <div class="mb-8">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="font-display text-3xl font-bold tracking-tight dark:text-cyan-100">Categories</h1>
                <p class="mt-2 text-[#3a3f6b] dark:text-slate-400">Manage blog categories.</p>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="rounded-lg border-2 border-[#0f1026] bg-cyan-300 px-5 py-2.5 font-semibold shadow-[4px_4px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[5px_5px_0_#0f1026] dark:border-cyan-200 dark:bg-cyan-400 dark:text-slate-950 dark:shadow-[4px_4px_0_rgba(34,211,238,0.4)] dark:hover:shadow-[5px_5px_0_rgba(34,211,238,0.5)]">New Category</a>
        </div>
    </div>

    <div class="rounded-[1rem] border-2 border-[#0f1026] bg-white shadow-[6px_6px_0_#0f1026] dark:border-cyan-300/60 dark:bg-slate-900/80 dark:shadow-[6px_6px_0_rgba(34,211,238,0.2)]">
        <div class="p-5 overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-2 border-[#0f1026] dark:border-cyan-300/60">
                        <th class="pb-4 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Name</th>
                        <th class="pb-4 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Slug</th>
                        <th class="pb-4 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Color</th>
                        <th class="pb-4 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Posts</th>
                        <th class="pb-4 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400">Status</th>
                        <th class="pb-4 text-sm font-semibold text-[#3a3f6b] dark:text-slate-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="border-b border-[#0f1026]/30 hover:bg-white/50 transition-colors dark:border-cyan-300/20 dark:hover:bg-slate-950/30 group">
                            <td class="py-4 text-sm font-medium dark:text-slate-200">{{ $category->name }}</td>
                            <td class="py-4 text-sm font-mono text-[#3a3f6b] dark:text-slate-400">{{ $category->slug }}</td>
                            <td class="py-4 text-sm">
                                <span class="inline-block w-6 h-6 rounded-full border-2 border-[#0f1026] shadow-[2px_2px_0_#0f1026] dark:border-cyan-300/60 dark:shadow-[2px_2px_0_rgba(34,211,238,0.25)]" style="background-color: {{ $category->color }}"></span>
                            </td>
                            <td class="py-4 text-sm text-[#3a3f6b] dark:text-slate-400">{{ $category->posts_count }}</td>
                            <td class="py-4 text-sm">
                                <span class="inline-flex items-center rounded-full border-2 border-[#0f1026] px-2.5 py-0.5 text-xs font-semibold shadow-[2px_2px_0_#0f1026] dark:border-cyan-300/60 dark:text-cyan-100 dark:shadow-[2px_2px_0_rgba(34,211,238,0.25)] {{ $category->is_active ? 'bg-cyan-100 dark:bg-cyan-900/30' : 'bg-rose-100 dark:bg-rose-900/30' }}">
                                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="py-4 text-right">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="rounded-md border-2 border-[#0f1026] bg-white px-3 py-1.5 text-xs font-semibold shadow-[2px_2px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[3px_3px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[2px_2px_0_rgba(34,211,238,0.25)] dark:hover:shadow-[3px_3px_0_rgba(34,211,238,0.3)] mr-2">Edit</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline" onsubmit="return confirm('Delete this category? Posts will be unassigned.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-md border-2 border-[#0f1026] bg-white px-3 py-1.5 text-xs font-semibold shadow-[2px_2px_0_#0f1026] transition-transform hover:-translate-y-0.5 hover:shadow-[3px_3px_0_#0f1026] dark:border-cyan-300/70 dark:bg-slate-950/80 dark:text-cyan-100 dark:shadow-[2px_2px_0_rgba(34,211,238,0.25)] dark:hover:shadow-[3px_3px_0_rgba(34,211,238,0.3)]">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
