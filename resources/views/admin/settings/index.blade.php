@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-semibold text-gray-900">Site Settings</h1>
</div>

<div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm max-w-3xl">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        {{-- Logo Upload --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Site Logo</label>
            @if($logo)
                <div class="mb-4">
                    <p class="text-xs text-gray-500 mb-1">Current Logo:</p>
                    <img src="{{ asset('storage/' . $logo) }}" alt="Site Logo" class="h-16 w-auto border border-gray-200 rounded p-2 bg-gray-50">
                </div>
            @endif
            <input type="file" name="site_logo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
            <p class="mt-1 text-xs text-gray-500">Recommended size: 200x50px. PNG or SVG preferred.</p>
            @error('site_logo') <span class="text-sm text-red-600 mt-1">{{ $message }}</span> @enderror
        </div>

        <hr class="border-gray-200">

        {{-- Banner Upload --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Home Page Banner (Hero Image)</label>
            @if($banner)
                <div class="mb-4">
                    <p class="text-xs text-gray-500 mb-1">Current Banner:</p>
                    <img src="{{ asset('storage/' . $banner) }}" alt="Site Banner" class="h-32 w-full object-cover border border-gray-200 rounded bg-gray-50">
                </div>
            @endif
            <input type="file" name="site_banner" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
            <p class="mt-1 text-xs text-gray-500">This will replace the background video. Recommended size: 1920x1080px. High-quality JPEG/WEBP.</p>
            @error('site_banner') <span class="text-sm text-red-600 mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-red-700 text-white px-6 py-2 rounded-lg font-medium hover:bg-red-800 transition-colors">
                Save Settings
            </button>
        </div>
    </form>
</div>
@endsection
