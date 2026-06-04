<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\Faq;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;

class HomeController extends Controller
{
    public function index()
    {
        // SEO
        SEOMeta::setTitle('Best Tattoo Studio in Raipur | Chinhari Tattoo Studio');
        SEOMeta::setDescription('Chinhari Tattoo Studio — Premium custom tattoos by expert artists in Raipur, Chhattisgarh. Book your free consultation today. Realism, Portrait, Blackwork, Tribal & more.');
        SEOMeta::addKeyword(['best tattoo studio raipur', 'tattoo artist raipur', 'tattoo studio chhattisgarh', 'custom tattoo raipur', 'tattoo shop raipur', 'chinhari tattoo']);
        SEOMeta::setCanonical(route('home'));

        OpenGraph::setTitle('Chinhari Tattoo Studio — Your Skin, Our Canvas');
        OpenGraph::setDescription('Premium custom tattoos by award-winning artists in Raipur, Chhattisgarh. Book your free consultation.');
        OpenGraph::setType('website');
        OpenGraph::setUrl(route('home'));

        TwitterCard::setType('summary_large_image');
        TwitterCard::setTitle('Chinhari Tattoo Studio | Best in Raipur');

        JsonLd::setType('LocalBusiness');
        JsonLd::setTitle('Chinhari Tattoo Studio');
        JsonLd::addValue('priceRange', '₹₹₹');
        JsonLd::addValue('areaServed', 'Raipur');

        // Data
        $featuredArtists      = Artist::where('is_active', true)->orderBy('sort_order')->take(3)->get();
        $featuredPortfolios   = Portfolio::where('is_featured', true)->where('is_published', true)->take(8)->get();
        $homeFaqs             = Faq::where('is_published', true)->orderBy('sort_order')->take(5)->get();
        $googleReviews        = \App\Models\Review::all();

        return view('public.home.index', compact(
            'featuredArtists',
            'featuredPortfolios',
            'homeFaqs',
            'googleReviews',
        ));
    }
}
