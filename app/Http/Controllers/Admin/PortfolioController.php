<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Auth;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with('category')->latest()->paginate(12);
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        $categories = ServiceCategory::orderBy('name')->get();
        return view('admin.portfolio.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'category_id' => 'required|exists:service_categories,id',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $path = $request->file('image')->store('portfolio', 'public');
        
        $artistId = Auth::user()->artist_id ?? 1; // Fallback to first artist if no direct mapping exists

        Portfolio::create([
            'artist_id' => $artistId,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title ?? 'portfolio-' . uniqid()),
            'description' => $request->description,
            'file_path' => $path,
            'thumbnail_path' => $path,
            'is_published' => true,
            'is_featured' => true,
        ]);

        return redirect()->route('admin.portfolio')->with('success', 'Image uploaded successfully!');
    }
    
    public function destroy(Portfolio $portfolio)
    {
        // Delete physical file if exists
        if ($portfolio->file_path && Storage::disk('public')->exists($portfolio->file_path)) {
            Storage::disk('public')->delete($portfolio->file_path);
        }
        
        $portfolio->forceDelete();
        
        return redirect()->route('admin.portfolio')->with('success', 'Image deleted successfully.');
    }
}
