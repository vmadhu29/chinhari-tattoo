<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $selectedStyle = $request->get('style');
        
        $query = Portfolio::where('is_published', true)->latest();
        
        if ($selectedStyle) {
            // Check if matches slug or text
            $query->where(function($q) use ($selectedStyle) {
                $q->where('tattoo_style', 'LIKE', '%' . $selectedStyle . '%')
                  ->orWhere('tags', 'LIKE', '%' . $selectedStyle . '%');
            });
        }
        
        $portfolios = $query->get();
        $categories = ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();

        SEOMeta::setTitle('Tattoo Design Gallery & Portfolio | Chinhari Tattoo Studio');
        SEOMeta::setDescription('Browse through our extensive gallery of premium custom tattoos, including Realism, Blackwork, Geometric, and Mandala designs created in Raipur.');
        SEOMeta::setCanonical(route('portfolio'));

        OpenGraph::setTitle('Chinhari Tattoo Design Gallery');
        OpenGraph::setDescription('View premium custom body art portfolio from our Raipur tattoo studio.');

        return view('public.portfolio.index', compact('portfolios', 'categories', 'selectedStyle'));
    }

    public function show(string $slug)
    {
        $portfolio = Portfolio::where('slug', $slug)->where('is_published', true)->firstOrFail();
        
        // Fetch related portfolios
        $related = Portfolio::where('is_published', true)
            ->where('id', '!=', $portfolio->id)
            ->where(function($q) use ($portfolio) {
                $q->where('artist_id', $portfolio->artist_id)
                  ->orWhere('category_id', $portfolio->category_id);
            })
            ->take(4)
            ->get();

        SEOMeta::setTitle("{$portfolio->title} - Tattoo Portfolio | Chinhari");
        SEOMeta::setDescription($portfolio->description);
        SEOMeta::setCanonical(route('portfolio.show', $portfolio->slug));

        OpenGraph::setTitle($portfolio->title);
        OpenGraph::setDescription($portfolio->description);

        return view('public.portfolio.show', compact('portfolio', 'related'));
    }
}
