@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- Stat Card --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-50 text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Portfolio Images</p>
                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Portfolio::count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-50 text-purple-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Categories</p>
                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\ServiceCategory::count() }}</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-lg font-medium text-gray-900">Recent Uploads</h2>
    </div>
    <div class="p-0">
        <ul class="divide-y divide-gray-200">
            @forelse(\App\Models\Portfolio::with('category')->latest()->take(5)->get() as $item)
            <li class="p-4 hover:bg-gray-50 flex items-center gap-4">
                <img src="{{ $item->thumbnail_url }}" alt="" class="w-16 h-16 object-cover rounded-lg">
                <div>
                    <p class="text-sm font-medium text-gray-900">{{ $item->title ?? 'Untitled Image' }}</p>
                    <p class="text-sm text-gray-500">{{ $item->category->name ?? 'Uncategorized' }}</p>
                </div>
                <div class="ml-auto text-sm text-gray-500">
                    {{ $item->created_at->diffForHumans() }}
                </div>
            </li>
            @empty
            <li class="p-6 text-center text-gray-500 text-sm">No images uploaded yet.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
