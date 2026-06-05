@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-semibold text-gray-900">Add Portfolio Image</h1>
    <a href="{{ route('admin.portfolio') }}" class="text-gray-500 hover:text-gray-700 font-medium text-sm">
        &larr; Back to Portfolio
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm max-w-2xl">
    <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Image File <span class="text-red-500">*</span></label>
            <input type="file" name="image" accept="image/*" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 border border-gray-200 rounded-md p-2">
            @error('image') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
            <select name="category_id" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Title (Optional)</label>
            <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Traditional Dragon Sleeve" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm">
            @error('title') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Description (Optional)</label>
            <textarea name="description" rows="4" placeholder="Add some context about this piece..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm">{{ old('description') }}</textarea>
            @error('description') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="pt-4 border-t border-gray-200">
            <button type="submit" class="bg-red-700 text-white px-6 py-2 rounded-lg font-medium hover:bg-red-800 transition-colors">
                Upload Image
            </button>
        </div>
    </form>
</div>
@endsection
