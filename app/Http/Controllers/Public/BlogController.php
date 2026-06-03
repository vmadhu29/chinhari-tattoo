<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 'published')
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get();

        SEOMeta::setTitle('Tattoo Aftercare Tips & News Blog | Chinhari Tattoo Studio');
        SEOMeta::setDescription('Learn about tattoo aftercare, healing processes, custom design inspiration, and news from Chinhari Tattoo Studio in Raipur.');
        SEOMeta::setCanonical(route('blog'));

        OpenGraph::setTitle('Chinhari Tattoo Blog');
        OpenGraph::setDescription('Tips, aftercare guidance, and inspiration from our professional artists.');

        return view('public.blog.index', compact('blogs'));
    }

    public function show(string $slug)
    {
        $blog = Blog::where('slug', $slug)->where('status', 'published')->firstOrFail();
        $blog->increment('views_count');

        // Fetch other blogs
        $recent = Blog::where('status', 'published')
            ->where('id', '!=', $blog->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        SEOMeta::setTitle("{$blog->title} | Chinhari Tattoo Blog");
        SEOMeta::setDescription($blog->excerpt);
        SEOMeta::setCanonical(route('blog.show', $blog->slug));

        OpenGraph::setTitle($blog->title);
        OpenGraph::setDescription($blog->excerpt);

        return view('public.blog.show', compact('blog', 'recent'));
    }
}
