@extends('admin.layouts.app')

@section('title', 'Content Moderation Logs')

@section('content')
<div class="space-y-8">

    {{-- Page Header --}}
    <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                🛡️ Content Moderation Dashboard
            </h1>
            <p class="mt-2 text-slate-500">
                Audit log history of automatically filtered profanity and toxic language. (Read-Only)
            </p>
        </div>
    </div>

    {{-- Statistics Overview Cards --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">
        {{-- Total Logs --}}
        <div class="rounded-2xl border border-indigo-200 bg-indigo-50 p-6">
            <p class="text-sm font-medium text-indigo-700">Total Filtered Events</p>
            <h2 class="mt-3 text-3xl font-bold text-indigo-900">{{ number_format($totalLogs) }}</h2>
        </div>

        {{-- Top Prohibited Words --}}
        <div class="rounded-2xl border border-rose-200 bg-rose-50 p-6 sm:col-span-2">
            <p class="text-sm font-medium text-rose-700 mb-2">Most Common Prohibited Words</p>
            <div class="flex flex-wrap gap-2">
                @forelse($topProhibitedWords as $word => $count)
                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white rounded-xl text-xs font-bold text-rose-800 border border-rose-200 shadow-xs">
                    <span>{{ $word }}</span>
                    <span class="px-1.5 py-0.5 bg-rose-100 rounded-md text-[10px] text-rose-700 font-extrabold">{{ $count }}x</span>
                </span>
                @empty
                <span class="text-xs text-rose-500 italic">No prohibited word logs detected yet.</span>
                @endforelse
            </div>
        </div>

        {{-- Content Types Summary --}}
        <div class="rounded-2xl border border-amber-200 bg-amber-50 p-6">
            <p class="text-sm font-medium text-amber-700">Active Content Channels</p>
            <h2 class="mt-3 text-3xl font-bold text-amber-900">{{ count($contentTypeBreakdown) }}</h2>
        </div>
    </div>

    {{-- Search & Filter Bar --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="GET" action="{{ route('admin.moderation.index') }}" class="grid grid-cols-1 gap-4 md:grid-cols-12">
            <div class="md:col-span-6">
                <label class="mb-2 block text-sm font-medium text-slate-700">Search Content or User</label>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search original text, cleaned text, word, or user..."
                    class="h-11 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="md:col-span-4">
                <label class="mb-2 block text-sm font-medium text-slate-700">Content Type</label>
                <select name="content_type" class="h-11 w-full rounded-xl border border-slate-300 px-4 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Types</option>
                    @foreach($contentTypes as $type)
                    <option value="{{ $type }}" {{ request('content_type') === $type ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('_', ' ', $type)) }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2 flex items-end gap-2">
                <button type="submit" class="h-11 w-full rounded-xl bg-indigo-600 font-bold text-white hover:bg-indigo-700 text-sm transition-colors">
                    Filter
                </button>
                @if(request()->hasAny(['search', 'content_type']))
                <a href="{{ route('admin.moderation.index') }}" class="h-11 px-4 flex items-center justify-center rounded-xl bg-slate-100 font-bold text-slate-600 hover:bg-slate-200 text-sm">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Moderation Logs Table --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs font-bold uppercase text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">User</th>
                        <th class="px-6 py-4">Channel / Type</th>
                        <th class="px-6 py-4">Detected Words</th>
                        <th class="px-6 py-4">Original Content</th>
                        <th class="px-6 py-4">Cleaned Content</th>
                        <th class="px-6 py-4">Date / Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($logs as $log)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs font-bold text-slate-400">#{{ $log->id }}</td>
                        <td class="px-6 py-4 font-medium text-slate-900">
                            @if($log->user)
                            <div>
                                <span class="block font-bold">{{ $log->user->name }}</span>
                                <span class="text-xs text-slate-400">{{ $log->user->email }}</span>
                            </div>
                            @else
                            <span class="text-slate-400 italic">Guest / System</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                {{ ucfirst(str_replace('_', ' ', $log->content_type)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                @if(is_array($log->matched_words))
                                    @foreach($log->matched_words as $word)
                                    <span class="px-2 py-0.5 rounded-md bg-rose-100 text-rose-700 text-[10px] font-black">
                                        {{ $word }}
                                    </span>
                                    @endforeach
                                @else
                                    <span class="text-xs text-slate-400">-</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 max-w-xs truncate text-rose-700 font-mono text-xs bg-rose-50/50 rounded-lg p-2">
                            {{ $log->original_content }}
                        </td>
                        <td class="px-6 py-4 max-w-xs truncate text-emerald-700 font-mono text-xs bg-emerald-50/50 rounded-lg p-2">
                            {{ $log->cleaned_content }}
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-400 whitespace-nowrap">
                            {{ $log->created_at ? $log->created_at->format('d M Y H:i:s') : '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-slate-400">
                            No moderation logs match your criteria.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($logs->hasPages())
        <div class="p-6 border-t border-slate-200">
            {{ $logs->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
