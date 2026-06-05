<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::where('is_active', true)->orderBy('sort_order')->get();

        SEOMeta::setTitle('Our Professional Tattoo Artists | Chinhari Tattoo Studio');
        SEOMeta::setDescription('Meet the award-winning tattoo artists at Chinhari Tattoo Studio in Raipur. Specialists in realism, portrait, geometric, mandala, and blackwork.');
        SEOMeta::setCanonical(route('artists'));

        OpenGraph::setTitle('Chinhari Tattoo Studio - Meet Our Artist');
        OpenGraph::setDescription('Raipur\'s finest body artists, specializing in custom work, realism, Polynesian, blackwork, and fine lines.');

        return view('public.artists.index', compact('artists'));
    }

    public function show(string $slug)
    {
        $artist = Artist::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $portfolios = $artist->portfolios()->where('is_published', true)->orderBy('sort_order')->get();

        SEOMeta::setTitle("{$artist->display_name} - Tattoo Artist in Raipur | Chinhari");
        SEOMeta::setDescription("Explore the body art portfolio of {$artist->display_name} at Chinhari Tattoo Studio. Specializing in " . implode(', ', $artist->specializations ?? []));
        SEOMeta::setCanonical(route('artists.show', $artist->slug));

        OpenGraph::setTitle("{$artist->display_name} - Chinhari Tattoo Studio");
        OpenGraph::setDescription($artist->bio);

        return view('public.artists.show', compact('artist', 'portfolios'));
    }
}
