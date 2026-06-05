@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-semibold text-gray-900">Portfolio Images</h1>
    <a href="{{ route('admin.portfolio.create') }}" class="bg-red-700 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-800 transition-colors inline-flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Image
    </a>
</div>

<div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
    @if($portfolios->isEmpty())
        <div class="p-12 text-center text-gray-500">
            <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <p class="text-lg font-medium text-gray-900 mb-1">No images yet</p>
            <p>Upload your first portfolio image to showcase your work.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
            @foreach($portfolios as $portfolio)
                <div class="relative group rounded-xl overflow-hidden border border-gray-200 bg-gray-50 flex flex-col">
                    <div class="aspect-square w-full relative">
                        <img src="{{ $portfolio->image_url }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover">
                        {{-- Hover Actions --}}
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <form action="{{ route('admin.portfolio.destroy', $portfolio->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="p-4 flex-1 flex flex-col">
                        <span class="text-xs font-semibold text-red-600 mb-1 uppercase tracking-wider">{{ $portfolio->category->name ?? 'Uncategorized' }}</span>
                        <h3 class="text-sm font-medium text-gray-900 mb-2 truncate">{{ $portfolio->title ?? 'Untitled' }}</h3>
                        <p class="text-xs text-gray-500 line-clamp-2 mt-auto">{{ $portfolio->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="p-4 border-t border-gray-200">
            {{ $portfolios->links() }}
        </div>
    @endif
</div>
@endsection
