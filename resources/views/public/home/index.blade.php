@extends('layouts.public')

@section('content')
@php
$siteBannerPath = \App\Models\Setting::where('key', 'site_banner')->value('value');
$heroBanner = $siteBannerPath ? asset('storage/' . $siteBannerPath) : asset('images/hero_banner.jpg');
@endphp

{{-- ══════════════════════════════════════════════════════
     HERO SECTION — Cinematic Full Screen
     ══════════════════════════════════════════════════════ --}}
<section
    id="hero"
    class="relative min-h-[70vh] md:min-h-[80vh] flex items-center justify-start overflow-hidden bg-studio-black pt-20"
    aria-label="Hero">
    <div class="absolute top-4 left-4 right-4 bottom-0 md:top-8 md:left-8 md:right-8 md:bottom-0 z-0 rounded-t-[32px] overflow-hidden bg-studio-darker shadow-[0_-10px_40px_rgba(255,193,7,0.1)]">
        {{-- Image fills the right 8/12 (2/3) of the screen, and text takes 4/12 (1/3) --}}
        <div class="absolute inset-y-0 right-0 w-full md:w-8/12 bg-[length:auto_100%] md:bg-cover bg-right bg-no-repeat opacity-100" style="background-image: url('{{ $heroBanner }}'); -webkit-mask-image: linear-gradient(to right, transparent 0%, black 50%); mask-image: linear-gradient(to right, transparent 0%, black 50%);"></div>
        {{-- Light gradient from left for text readability, but lighter overlay so image is visible --}}
        <div class="absolute inset-0 bg-gradient-to-r from-studio-darker via-studio-darker/60 to-transparent z-[1]"></div>
        {{-- Verli shadow/tint over the image --}}
        <div class="absolute inset-0 bg-gradient-to-r from-verli/10 via-transparent to-transparent mix-blend-multiply z-[2] pointer-events-none"></div>
    </div>

    {{-- Verli ambient glow behind the hero section --}}
    <div class="absolute bottom-0 left-0 right-0 h-64 bg-gradient-to-t from-verli/8 via-verli/3 to-transparent z-[1] pointer-events-none"></div>
    <div class="absolute top-1/2 -left-20 w-80 h-80 bg-verli/10 rounded-full blur-3xl z-[1] pointer-events-none -translate-y-1/2"></div>

    {{-- Particle Canvas Background --}}
    <canvas id="hero-canvas" class="absolute inset-0 z-10 pointer-events-none opacity-40"></canvas>

    {{-- Floating Left Reviews/Hygiene Badges --}}
    <div class="fixed left-0 top-1/2 -translate-y-1/2 z-40 hidden md:flex flex-col gap-3 pointer-events-auto">
        {{-- Google Reviews --}}
        <a href="{{ config('studio.google_maps_url', 'https://maps.app.goo.gl/FthHoox4rfMViKoLA') }}" target="_blank" rel="noopener" class="bg-studio-card border-y border-r border-studio-border/50 rounded-r-2xl shadow-xl p-3 flex flex-col items-center justify-center text-center w-[76px] transition-all duration-300 hover:translate-x-1.5 group">
            {{-- Colored Google Icon --}}
            <svg class="w-6 h-6 mb-1.5" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" />
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" />
            </svg>
            <span class="text-[9px] text-studio-muted font-bold tracking-tight leading-none">Google</span>
            <span class="text-[9px] text-studio-faint font-semibold tracking-tight leading-none mt-0.5">Reviews</span>
            <span class="text-xs font-black text-verli-dark mt-2">{{ number_format(Cache::get('google_rating', 4.8), 1) }}</span>
        </a>

        {{-- Hygiene & Safety --}}
        <div class="bg-studio-card border-y border-r border-studio-border/50 rounded-r-2xl shadow-xl p-3 flex flex-col items-center justify-center text-center w-[76px] group">
            {{-- Green Medical Cross Icon --}}
            <svg class="w-6 h-6 mb-1.5 text-green-600" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span class="text-[9px] text-studio-muted font-bold tracking-tight leading-none">Hygiene &</span>
            <span class="text-[9px] text-studio-faint font-semibold tracking-tight leading-none mt-0.5">Safety</span>
            <span class="text-xs font-black text-verli-dark mt-2">100%</span>
        </div>
    </div>

    {{-- Hero Content: Transparent Overlay --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-12 md:py-20">
        <div
            class="w-full md:w-4/12 flex flex-col items-start text-left
                   opacity-0 animate-fade-in animate-fill-forwards relative pr-4"
            style="
                animation-delay:0.3s;
            ">
            {{-- Subtle Verli Accent Badge --}}
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-verli/10 border border-verli/30 rounded-full text-[10px] uppercase tracking-[0.2em] font-bold text-verli mb-5 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-verli animate-pulse"></span>
                <span>Chhattisgarh's Most Trusted Tattoo Studio</span>
            </div>

            {{-- Main Headline: Mixed Serif & Sans-Serif Typography --}}
            <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl tracking-tight leading-[1.2] text-studio-white mb-3">
                Your Vision,<br>
                Our <span class="font-sans font-black bg-gradient-to-r from-verli via-verli-light to-verli bg-clip-text text-transparent uppercase tracking-wider block mt-0.5">Masterpiece</span>
            </h1>

            {{-- Verli Divider Line --}}
            <div class="w-12 h-0.5 bg-gradient-to-r from-verli to-verli-light mb-4 rounded-full shadow-sm"></div>

            {{-- Subtitle --}}
            <p class="text-studio-gray text-xs sm:text-sm leading-relaxed mb-6 max-w-md">
                Chhattisgarh's trusted home for premium custom tattoos. Led by artist Dharam Sahu, we create meaningful, high-quality body art with world-class safety standards, artistic excellence, and a personalized experience from consultation to completion.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-row items-center gap-2 sm:gap-3 w-full mt-4">
                <a href="{{ route('booking.create') }}" class="btn-verli flex-1 whitespace-nowrap text-[11px] lg:text-xs xl:text-sm !px-3 sm:!px-5">
                    Book Free Consultation
                </a>
                <a href="tel:{{ config('studio.phone') }}" class="btn-outline-verli flex-1 whitespace-nowrap text-[11px] lg:text-xs xl:text-sm !px-3 sm:!px-5 group">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span>Book on Call</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex flex-col items-center gap-2 opacity-60" aria-hidden="true">
        <span class="text-[10px] tracking-[0.3em] uppercase text-studio-muted">Scroll</span>
        <div class="w-px h-12 bg-gradient-to-b from-verli to-transparent animate-pulse"></div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     STATS SECTION
     ══════════════════════════════════════════════════════ --}}
<section class="py-14 bg-studio-darker border-y border-studio-border relative overflow-hidden" aria-label="Studio statistics">
    {{-- Decorative verli-accent lines --}}
    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-verli/30 to-transparent"></div>
    <div class="absolute inset-x-0 bottom-0 h-px bg-gradient-to-r from-transparent via-verli/30 to-transparent"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-y-8 md:gap-y-0 relative">
            @php
            $googleRating = Cache::get('google_rating', 5.0);
            $googleRatingWhole = floor($googleRating);
            $googleRatingSuffix = str_replace($googleRatingWhole, '', number_format($googleRating, 1));

            $stats = [
            ['number' => 500, 'suffix' => '+', 'label' => 'Happy Clients'],
            ['number' => 8, 'suffix' => '+', 'label' => 'Years Experience'],
            ['number' => 1000, 'suffix' => '+', 'label' => 'Tattoos Done'],
            ['number' => $googleRatingWhole, 'suffix' => $googleRatingSuffix, 'label' => 'Google Rating'],
            ];
            @endphp
            @foreach($stats as $i => $stat)
            <div class="text-center px-4 relative {{ $i > 0 ? 'md:border-l md:border-studio-border/50' : '' }} {{ $i == 1 ? 'border-r border-studio-border/30 md:border-r-0' : '' }}" data-reveal data-delay="{{ $i * 60 }}">
                <div class="stat-number transition-transform duration-500 hover:scale-105 inline-block">
                    <span data-counter data-target="{{ $stat['number'] }}">0</span>{{ $stat['suffix'] }}
                </div>
                <div class="stat-label text-[10px] tracking-[0.2em] font-bold text-studio-muted mt-2">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     TATTOO CATEGORIES — Scrollable Grid
     ══════════════════════════════════════════════════════ --}}
<div class="tribal-divider h-10 tribal-bg bg-studio-darker border-t border-studio-border/50"></div>
<section class="py-24 bg-studio-black" aria-labelledby="categories-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16" data-reveal>
            <div class="section-eyebrow justify-center">Explore Styles</div>
            <h2 id="categories-heading" class="section-title mb-4">Art That Speaks<br><span class="text-verli-gradient">Your Language</span></h2>
            <p class="section-subtitle mx-auto text-center">From bold tribal designs to delicate fine line art — we master every style.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @php
            $categories = [
            [
            'name' => 'Realism',
            'count' => 48,
            'image' => 'https://www.thefashionisto.com/wp-content/uploads/2023/11/Lion-Forearm-Tattoo-Men.jpg'
            ],
            [
            'name' => 'Portrait',
            'count' => 35,
            'image' => 'https://i.pinimg.com/736x/59/c5/97/59c597ad941b79839b5139ccd0aff3a8.jpg'
            ],
            [
            'name' => 'Blackwork',
            'count' => 62,
            'image' => 'https://tattoobnb.com/cdn/shop/files/Big-Blackwork-Snake-and-Circles-on-Men-Back-Tattoo-by-ahn_ttt-Tattoobnb.webp?v=1760683712&width=533'
            ],
            [
            'name' => 'Tribal',
            'count' => 29,
            'image' => 'https://cdn2.stylecraze.com/wp-content/uploads/2024/08/Polynesian-Tribal-Leg-Tattoo.jpg'
            ],
            [
            'name' => 'Geometric',
            'count' => 41,
            'image' => 'https://i.pinimg.com/originals/8e/11/eb/8e11eb8cb3a9a1e4011d855d45217ea9.jpg'
            ],
            [
            'name' => 'Mandala',
            'count' => 53,
            'image' => 'https://herway.net/wp-content/uploads/2024/08/Ornamental-Geometric-Mandala-Sleeve.jpg'
            ],
            [
            'name' => 'Neo Traditional',
            'count' => 27,
            'image' => 'https://inkpicks.com/wp-content/uploads/2024/11/snake-neck-tattoo-761614.webp'
            ],
            [
            'name' => 'Minimalist',
            'count' => 38,
            'image' => 'https://91tattoos.com/wp-content/uploads/2025/07/Classic-Outline-Rose-Wrist-Tattoo-With-Blush-Pink-Short-Nails-For-Soft-Floral-Tattoo-Designs-1229x1536.jpg'
            ],
            ];
            @endphp

            @foreach($categories as $i => $cat)
            <a
                href="{{ route('portfolio', ['style' => Str::slug($cat['name'])]) }}"
                class="card-hover group relative overflow-hidden rounded-2xl p-6 flex flex-col justify-between min-h-[180px]"
                data-reveal
                data-delay="{{ $i * 80 }}"
                aria-label="{{ $cat['name'] }} tattoos">
                {{-- Background Image --}}
                <img
                    src="{{ $cat['image'] }}"
                    alt="{{ $cat['name'] }} style"
                    loading="lazy"
                    class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out z-0">
                {{-- Gradient Overlay (darker at bottom for readability) --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/80 to-black/10 transition-opacity duration-300 group-hover:opacity-90 z-0"></div>

                {{-- Top Section: Count --}}
                <div class="flex justify-end items-start relative z-10">
                    <span class="text-xs font-bold text-studio-black bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-full border border-verli/50 shadow-sm">{{ $cat['count'] }}+</span>
                </div>

                {{-- Bottom Section: Title -- z-10 to stay on top of background image --}}
                <div class="relative z-10">
                    <h3 class="text-white font-semibold text-lg group-hover:text-verli transition-colors duration-300">{{ $cat['name'] }}</h3>
                    <p class="text-gray-300 text-xs mt-1 group-hover:text-white transition-colors">View Gallery →</p>
                </div>

                {{-- Gold Border on Hover --}}
                <div class="absolute inset-0 border border-verli/0 group-hover:border-verli/30 rounded-2xl transition-all duration-300 pointer-events-none z-20"></div>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-10" data-reveal>
            <a href="{{ route('portfolio') }}" class="btn-outline-verli">View All Styles</a>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     FEATURED PORTFOLIO
     ══════════════════════════════════════════════════════ --}}
<div class="tribal-divider h-10 tribal-bg bg-studio-black border-t border-studio-border/50"></div>
<section class="py-24 bg-studio-darker" aria-labelledby="portfolio-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col items-center text-center gap-6 mb-16">
            <div data-reveal class="flex flex-col items-center">
                <div class="section-eyebrow justify-center">Featured Work</div>
                <h2 id="portfolio-heading" class="section-title">Ink That<br><span class="text-verli-gradient">Tells Stories</span></h2>
            </div>
            <a href="{{ route('portfolio') }}" class="btn-outline-verli flex-shrink-0" data-reveal>
                View Full Portfolio
            </a>
        </div>

        {{-- Masonry-style portfolio grid --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 auto-rows-[200px]">
            @php
            $featured = $featuredPortfolios ?? collect([]);
            $gridLayouts = ['row-span-2', '', 'row-span-2', '', '', 'row-span-2', '', ''];
            @endphp

            @if($featured->isEmpty())
            {{-- Placeholder grid when no portfolio exists --}}
            @foreach($gridLayouts as $i => $span)
            <div
                class="portfolio-item {{ $span }} bg-studio-card rounded-xl overflow-hidden"
                data-reveal
                data-delay="{{ $i * 60 }}">
                <div class="w-full h-full flex items-center justify-center">
                    <div class="text-center">
                        <div class="text-4xl mb-3" aria-hidden="true">🎨</div>
                        <p class="text-xs text-studio-faint">Portfolio Coming Soon</p>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            @foreach($featured->take(8) as $i => $item)
            <a
                href="{{ route('portfolio.show', $item->slug) }}"
                class="portfolio-item {{ $gridLayouts[$i] ?? '' }}"
                data-reveal
                data-delay="{{ $i * 60 }}"
                aria-label="{{ $item->title }}">
                <img
                    src="{{ $item->thumbnail_url }}"
                    alt="{{ $item->alt_text ?? $item->title }}"
                    loading="lazy"
                    class="w-full h-full object-cover">
                <div class="portfolio-item-overlay">
                    <span class="badge-verli text-xs">{{ $item->category->name ?? 'Tattoo' }}</span>
                    <h3 class="text-white font-semibold mt-2 text-sm">{{ $item->title }}</h3>
                    <p class="text-studio-muted text-xs">{{ $item->artist->display_name ?? 'Artist' }}</p>
                </div>
            </a>
            @endforeach
            @endif
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     ARTIST SPOTLIGHT — Dharam Sahu
     ══════════════════════════════════════════════════════ --}}
<div class="tribal-divider h-10 tribal-bg bg-studio-darker border-t border-studio-border/50"></div>
<section class="py-24 bg-studio-black relative overflow-hidden" aria-labelledby="artists-heading">
    <div class="absolute inset-0 bg-ink-radial pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        <div class="text-center mb-16" data-reveal>
            <div class="section-eyebrow justify-center">The Mastermind</div>
            <h2 id="artists-heading" class="section-title">Master of<br><span class="text-verli-gradient">The Craft</span></h2>
            <p class="section-subtitle mx-auto text-center mt-4">Meet Dharam Sahu, the creative force and founder behind Chinhari Tattoo Studio.</p>
        </div>

        @php $artists = $featuredArtists ?? collect([]); @endphp
        @php $artist = $artists->first(); @endphp

        @if(!$artist)
        <div class="max-w-4xl mx-auto bg-studio-card border border-studio-border rounded-2xl p-8 shadow-card flex flex-col md:flex-row gap-8 items-center" data-reveal>
            <div class="w-full md:w-1/3 aspect-[4/5] bg-studio-charcoal rounded-xl overflow-hidden">
                <div class="w-full h-full flex items-center justify-center text-studio-faint">
                    <span>Profile Photo</span>
                </div>
            </div>
            <div class="w-full md:w-2/3 space-y-4">
                <h3 class="font-serif text-3xl text-studio-white font-bold">Dharam Sahu</h3>
                <p class="text-verli text-sm tracking-wider uppercase font-semibold">Founder & Master Artist</p>
                <p class="text-studio-muted text-sm leading-relaxed">Raipur's premier tattoo artist with over 10 years of experience, specializing in hyper-realistic portraits, blackwork, mandalas, and spiritual designs.</p>
            </div>
        </div>
        @else
        <div class="max-w-5xl mx-auto bg-studio-card border border-studio-border rounded-3xl p-8 md:p-12 shadow-card flex flex-col md:flex-row gap-12 items-center" data-reveal>
            {{-- Left: Portrait --}}
            <div class="relative w-full md:w-2/5 aspect-[4/5] flex-shrink-0 group">
                {{-- Offset Gold Accent Frame behind the photo --}}
                <div class="absolute -inset-2 border border-verli/45 rounded-3xl translate-x-3 translate-y-3 transition-transform duration-500 group-hover:translate-x-1.5 group-hover:translate-y-1.5 -z-10 pointer-events-none"></div>

                {{-- Actual Image Container --}}
                <div class="w-full h-full rounded-2xl overflow-hidden border border-studio-border bg-studio-dark relative z-10 shadow-md">
                    <img
                        src="{{ $artist->profile_photo_url }}"
                        alt="{{ $artist->display_name }}"
                        class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-700 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/45 via-transparent to-transparent"></div>
                </div>
            </div>

            {{-- Right: Content --}}
            <div class="w-full md:w-3/5 space-y-6 text-left">
                <div>
                    <span class="badge-verli text-xs px-3 py-1 mb-3">{{ $artist->experience_years }}+ Years Experience</span>
                    <h3 class="font-serif text-3xl md:text-4xl text-studio-white leading-none font-bold">{{ $artist->display_name }}</h3>
                    <p class="text-verli text-sm tracking-wider uppercase font-semibold mt-2">{{ $artist->tagline }}</p>
                </div>

                <p class="text-studio-gray text-sm md:text-base leading-relaxed">
                    {{ $artist->bio }}
                </p>

                <div class="space-y-3 pt-2">
                    <span class="text-xs text-studio-faint block uppercase tracking-widest font-semibold">Specializations</span>
                    <div class="flex flex-wrap gap-2">
                        @foreach($artist->specializations ?? [] as $spec)
                        <span class="text-xs bg-studio-dark border border-studio-border text-studio-gray px-3 py-1.5 rounded-full font-medium shadow-sm">{{ $spec }}</span>
                        @endforeach
                    </div>
                </div>

                @if(!empty($artist->awards))
                <div class="space-y-2">
                    <span class="text-xs text-studio-faint block uppercase tracking-widest font-semibold">Awards & Accreditation</span>
                    <ul class="space-y-1.5 text-xs text-studio-muted">
                        @foreach($artist->awards as $award)
                        <li class="flex items-center gap-2">
                            <span class="text-verli">🏆</span> {{ $award }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="flex flex-wrap gap-4 pt-6 border-t border-studio-border">
                    <a href="{{ route('artists.show', $artist->slug) }}" class="btn-outline-verli btn-sm">View Full Portfolio</a>
                    <a href="{{ route('booking.create', ['artist' => $artist->id]) }}" class="btn-verli btn-sm">Book Artist</a>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     BOOKING PROCESS — How it Works
     ══════════════════════════════════════════════════════ --}}
<div class="tribal-divider h-10 tribal-bg bg-studio-black border-t border-studio-border/50"></div>
<section class="py-24 bg-studio-darker relative overflow-hidden" aria-labelledby="process-heading">
    {{-- Fine line accents matching premium luxury brand layout --}}
    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-verli/10 to-transparent"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16" data-reveal>
            <div class="section-eyebrow justify-center">Simple Process</div>
            <h2 id="process-heading" class="section-title">How to Book<br><span class="text-verli-gradient">Your Appointment</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 md:gap-6 relative">
            {{-- Connecting Line (desktop) --}}
            <div class="hidden md:block absolute top-12 left-[12.5%] right-[12.5%] h-px bg-gradient-to-r from-transparent via-verli/25 to-transparent z-0" aria-hidden="true"></div>

            @php
            $steps = [
            ['num'=>'01','title'=>'Book Online','desc'=>'Choose your artist, style, and time slot through our booking system.'],
            ['num'=>'02','title'=>'Consultation','desc'=>'Share your idea, placement, and reference images with your artist.'],
            ['num'=>'03','title'=>'Design Review','desc'=>'Review and approve your custom design before the session.'],
            ['num'=>'04','title'=>'Get Inked','desc'=>'Sit back and watch your tattoo come to life by our expert.'],
            ];
            @endphp

            @foreach($steps as $i => $step)
            <div class="text-center group relative z-10" data-reveal data-delay="{{ $i * 100 }}">
                <div class="relative flex justify-center items-center mb-6">
                    {{-- Elegant round backdrop with a thin verli border --}}
                    <div class="w-24 h-24 rounded-full border border-studio-border/60 bg-studio-card/85 flex items-center justify-center relative group-hover:border-verli/50 group-hover:shadow-verli-sm transition-all duration-500">
                        {{-- Massive elegant serif number in verli --}}
                        <span class="font-serif text-4xl font-light text-verli tracking-tight group-hover:scale-110 transition-transform duration-500">{{ $step['num'] }}</span>
                    </div>
                </div>
                <h3 class="text-studio-white font-semibold text-lg mb-3 group-hover:text-verli transition-colors duration-300">{{ $step['title'] }}</h3>
                <p class="text-studio-muted text-xs sm:text-sm leading-relaxed max-w-[240px] mx-auto">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-14" data-reveal>
            <a href="{{ route('booking.create') }}" class="btn-verli btn-lg">Start Your Journey</a>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     TESTIMONIALS
     ══════════════════════════════════════════════════════ --}}
<div class="tribal-divider h-10 tribal-bg bg-studio-darker border-t border-studio-border/50"></div>
<section class="py-24 bg-studio-black" aria-labelledby="testimonials-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16" data-reveal>
            <div class="section-eyebrow justify-center">Google Reviews</div>
            <h2 id="testimonials-heading" class="section-title">Loved by Chhattisgarh,<br><span class="text-verli-gradient">Rated 4.9★ on Google</span></h2>

            {{-- Google Review Aggregate Rating Summary --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-6">
                <div class="inline-flex items-center gap-3 px-4 py-2 bg-studio-dark/50 border border-studio-border/30 rounded-2xl">
                    {{-- Google Logo --}}
                    <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05" />
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335" />
                    </svg>
                    <span class="text-sm font-bold text-studio-white">{{ number_format(Cache::get('google_rating', 4.8), 1) }}</span>
                    <div class="flex text-verli">
                        @for($s=1;$s<=round(Cache::get('google_rating', 4.8));$s++)
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                            @endfor
                    </div>
                    <span class="text-[11px] text-studio-muted">based on {{ Cache::get('google_review_count', '150+') }} reviews</span>
                </div>
                <a href="https://maps.app.goo.gl/FthHoox4rfMViKoLA" target="_blank" rel="noopener" class="text-xs text-verli hover:text-verli-light inline-flex items-center gap-1 font-semibold group transition-all">
                    Write a Review
                    <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($googleReviews ?? [] as $i => $review)
            <div class="card-glass p-6 sm:p-7 flex flex-col gap-4 relative" data-reveal data-delay="{{ $i * 80 }}">

                {{-- Google G Logo in Corner --}}
                <div class="absolute top-6 right-6 opacity-30">
                    <svg class="w-4 h-4" viewBox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05" />
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335" />
                    </svg>
                </div>

                {{-- Review Header: Google-style User Profile --}}
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0 {{ $review->avatar_color }}">
                        {{ $review->author_initials }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-studio-white font-semibold text-sm leading-tight flex items-center gap-1.5 truncate">
                            {{ $review->author_name }}
                            <span class="inline-flex items-center justify-center w-3.5 h-3.5 rounded-full bg-blue-500/20 text-blue-400 text-[8px]" title="Verified Local Guide">✓</span>
                        </p>
                        <p class="text-studio-faint text-xs mt-0.5 truncate">{{ $review->location ?? 'Raipur, Chhattisgarh' }}</p>
                    </div>
                </div>

                {{-- Rating Stars & Date --}}
                <div class="flex items-center justify-between gap-2 border-t border-studio-border/20 pt-3">
                    <div class="flex gap-0.5 text-verli">
                        @for($s = 1; $s <= $review->rating; $s++)
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            @endfor
                    </div>
                    <span class="text-studio-faint text-[10px]">{{ $review->relative_time }}</span>
                </div>

                {{-- Review Content --}}
                <blockquote class="text-studio-gray text-xs sm:text-sm leading-relaxed flex-1 italic">
                    "{{ $review->content }}"
                </blockquote>

                {{-- Tattoo Style Badge --}}
                <div class="flex justify-between items-center mt-auto pt-3 border-t border-studio-border/20 text-xs text-studio-faint">
                    <span>Style: <strong class="text-verli">{{ $review->style ?? 'Custom Tattoo' }}</strong></span>
                    <span class="text-[9px] uppercase tracking-wider font-bold text-emerald-400 bg-emerald-500/10 px-1.5 py-0.5 rounded">Google Review</span>
                </div>

            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     FAQ SECTION
     ══════════════════════════════════════════════════════ --}}
<div class="tribal-divider h-10 tribal-bg bg-studio-black border-t border-studio-border/50"></div>
<section class="py-24 bg-studio-darker" aria-labelledby="faq-heading">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16" data-reveal>
            <div class="section-eyebrow justify-center">FAQ</div>
            <h2 id="faq-heading" class="section-title">Common<br><span class="text-verli-gradient">Questions</span></h2>
        </div>

        <div class="space-y-3" x-data="{ open: null }">
            @php
            $faqs = $homeFaqs ?? collect([
            ['q'=>'How much does a tattoo cost?','a'=>'Prices vary based on size, complexity, color, and placement. Small tattoos start from ₹2,000. We offer a free consultation to give you an accurate quote before booking.'],
            ['q'=>'Is the studio hygienic and safe?','a'=>'Absolutely. We follow strict sterilization protocols. All needles are single-use, equipment is autoclave sterilized, and artists wear gloves throughout the session.'],
            ['q'=>'How do I book an appointment?','a'=>'You can book online through our website, WhatsApp us at +91 9285001719, or visit us directly. Walk-ins are welcome based on artist availability.'],
            ['q'=>'How long does healing take?','a'=>'Surface healing takes 2-4 weeks. Full healing (deep layers) takes 2-6 months. We provide complete aftercare instructions and follow-up support.'],
            ['q'=>'Can you do cover-up tattoos?','a'=>'Yes! Our artists specialize in cover-up tattoos. Share a photo of your existing tattoo during consultation and we\'ll design the perfect solution.'],
            ]);
            @endphp

            @foreach($faqs as $i => $faq)
            @php
            $q = is_array($faq) ? $faq['q'] : $faq->question;
            $a = is_array($faq) ? $faq['a'] : $faq->answer;
            @endphp
            <div
                class="card border-studio-border overflow-hidden"
                data-reveal
                data-delay="{{ $i * 80 }}">
                <button
                    @click="open === {{ $i }} ? open = null : open = {{ $i }}"
                    class="w-full flex items-center justify-between p-6 text-left group"
                    :aria-expanded="open === {{ $i }}"
                    aria-controls="faq-answer-{{ $i }}">
                    <span class="text-studio-white font-medium pr-4 group-hover:text-verli transition-colors duration-200">{{ $q }}</span>
                    <svg
                        class="w-5 h-5 text-verli flex-shrink-0 transition-transform duration-300"
                        :class="open === {{ $i }} ? 'rotate-45' : ''"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </button>
                <div
                    id="faq-answer-{{ $i }}"
                    x-show="open === {{ $i }}"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-2"
                    class="px-6 pb-6"
                    role="region">
                    <p class="text-studio-muted text-sm leading-relaxed border-t border-studio-border pt-4">{{ $a }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     CONTACT & MAP
     ══════════════════════════════════════════════════════ --}}
<section class="py-24 bg-studio-black relative overflow-hidden" aria-labelledby="contact-heading">
    {{-- Ambient Background --}}
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-verli/5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16" data-reveal>
            <div class="section-eyebrow justify-center">Connect With Us</div>
            <h2 id="contact-heading" class="section-title">Visit Our<br><span class="text-verli-gradient">Studio</span></h2>
            <p class="section-subtitle mx-auto mt-4 max-w-xl">We're located in the heart of Raipur. Drop by for a consultation or reach out to start your tattoo journey.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Column 1: Small Map Bento Card --}}
            <div class="card-glass p-3 relative overflow-hidden group min-h-[350px] h-full flex flex-col" data-reveal>
                <div class="w-full h-full rounded-xl overflow-hidden relative flex-1">
                    @if(config('studio.google_maps_embed_url'))
                    <iframe src="{{ config('studio.google_maps_embed_url') }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" style="border:0; filter: invert(90%) hue-rotate(180deg) brightness(0.7) contrast(1.2);" allowfullscreen loading="lazy"></iframe>
                    @else
                    <div class="absolute inset-0 bg-studio-dark flex items-center justify-center">
                        <div class="absolute inset-0 noise"></div>
                        <div class="relative z-10 text-center flex flex-col items-center">
                            <div class="w-14 h-14 bg-verli/10 rounded-full flex items-center justify-center mb-4 border border-verli/30">
                                <svg class="w-6 h-6 text-verli animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg text-white font-serif font-bold px-4">Chinhari Tattoo Studio</h3>
                        </div>
                    </div>
                    @endif

                    {{-- Floating Glass Button on Map --}}
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 w-[90%]">
                        <a href="{{ config('studio.google_maps_url') }}" class="flex items-center justify-between w-full p-3 card-glass bg-studio-black/80 hover:bg-studio-black transition-colors shadow-2xl backdrop-blur-xl" target="_blank" rel="noopener">
                            <div class="text-left">
                                <p class="text-white font-bold text-xs tracking-wide">Get Directions</p>
                                <p class="text-studio-muted text-[10px] mt-0.5">Raipur, CG</p>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-verli flex items-center justify-center text-studio-black shadow-lg group-hover:scale-110 transition-transform">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Column 2: Location Details --}}
            <div class="card-glass p-8 flex flex-col justify-center group h-full" data-reveal data-delay="100">
                <div class="w-12 h-12 rounded-2xl bg-studio-dark border border-studio-border flex items-center justify-center mb-6 group-hover:border-verli transition-colors shadow-lg">
                    <svg class="w-6 h-6 text-verli" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <h3 class="text-2xl font-serif text-white font-bold mb-3">Headquarters</h3>
                <p class="text-studio-gray text-sm leading-relaxed mb-6"><strong>Chinhari Tattoo Studio</strong><br>Bazaar Chowk, near Competition Academy, Shikshak Colony, Daganiya, Amanaka, Raipur<br>Chhattisgarh 492001, India</p>

                {{-- Phone --}}
                <a href="tel:+919285001719" class="flex items-center gap-3 mb-6 group/phone">
                    <div class="w-10 h-10 rounded-full bg-studio-dark border border-studio-border flex items-center justify-center group-hover/phone:border-verli transition-colors shadow-md">
                        <svg class="w-4 h-4 text-verli" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-studio-faint uppercase tracking-[0.15em] font-bold">Call Us</p>
                        <p class="text-white font-semibold text-sm group-hover/phone:text-verli transition-colors">+91 92850 01719</p>
                    </div>
                </a>

                <div class="w-full h-px bg-studio-border/50 my-2"></div>

                <div class="mt-6 flex flex-col gap-4">
                    <div class="flex justify-between items-center">
                        <p class="text-[10px] text-studio-faint uppercase tracking-[0.2em] font-bold">Status</p>
                        <p class="text-sm font-semibold text-green-400 flex items-center gap-2">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                            </span>
                            Accepting Walk-ins
                        </p>
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="text-[10px] text-studio-faint uppercase tracking-[0.2em] font-bold">Hours</p>
                        <p class="text-sm font-semibold text-white">10:00 AM - 10:00 PM</p>
                    </div>
                </div>
            </div>

            {{-- Column 3: Big Social Media Cards --}}
            <div class="flex flex-col justify-between gap-4 h-full" data-reveal data-delay="200">
                {{-- Instagram --}}
                <a href="{{ config('studio.instagram') }}" class="card-glass p-5 flex items-center gap-5 group hover:-translate-y-1 transition-transform" target="_blank" rel="noopener">
                    <div class="w-14 h-14 shrink-0 rounded-full bg-studio-dark border border-studio-border flex items-center justify-center text-pink-500 group-hover:bg-gradient-to-tr group-hover:from-yellow-400 group-hover:via-pink-500 group-hover:to-purple-500 group-hover:text-white group-hover:border-transparent transition-all shadow-md">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.199-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.199 4.358 2.618 6.781 6.98 6.98 1.28.058 1.689.072 4.948.072s3.668-.014 4.948-.072c4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948s-.014-3.667-.072-4.947c-.197-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-bold text-lg mb-0.5">Instagram</p>
                        <p class="text-verli text-sm font-semibold">@chinhari_tattoo_raipur</p>
                    </div>
                </a>

                {{-- Facebook --}}
                <a href="{{ config('studio.facebook') }}" class="card-glass p-5 flex items-center gap-5 group hover:-translate-y-1 transition-transform" target="_blank" rel="noopener">
                    <div class="w-14 h-14 shrink-0 rounded-full bg-studio-dark border border-studio-border flex items-center justify-center text-blue-500 group-hover:bg-blue-600 group-hover:text-white group-hover:border-transparent transition-all shadow-md">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-bold text-lg mb-0.5">Facebook</p>
                        <p class="text-verli text-sm font-semibold">ChinhariTattooStudio</p>
                    </div>
                </a>

                {{-- YouTube --}}
                <a href="{{ config('studio.youtube') }}" class="card-glass p-5 flex items-center gap-5 group hover:-translate-y-1 transition-transform" target="_blank" rel="noopener">
                    <div class="w-14 h-14 shrink-0 rounded-full bg-studio-dark border border-studio-border flex items-center justify-center text-red-500 group-hover:bg-red-600 group-hover:text-white group-hover:border-transparent transition-all shadow-md">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-bold text-lg mb-0.5">YouTube</p>
                        <p class="text-verli text-sm font-semibold">@ChinhariTattoo</p>
                    </div>
                </a>

                {{-- WhatsApp --}}
                <a href="https://wa.me/{{ config('studio.whatsapp_number') }}" class="card-glass p-5 flex items-center gap-5 group hover:-translate-y-1 transition-transform" target="_blank" rel="noopener">
                    <div class="w-14 h-14 shrink-0 rounded-full bg-studio-dark border border-studio-border flex items-center justify-center text-green-500 group-hover:bg-[#25D366] group-hover:text-white group-hover:border-transparent transition-all shadow-md">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-bold text-lg mb-0.5">WhatsApp</p>
                        <p class="text-verli text-sm font-semibold">+91 92850 01719</p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // ── Hero Canvas Particle Effect (Ink Drops) ──
    const canvas = document.getElementById('hero-canvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        const particles = [];
        const PARTICLE_COUNT = 40;

        function resize() {
            canvas.width = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;
        }
        resize();
        window.addEventListener('resize', resize);

        class Particle {
            constructor() {
                this.reset();
            }
            reset() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.r = Math.random() * 2 + 0.5;
                this.vx = (Math.random() - 0.5) * 0.3;
                this.vy = (Math.random() - 0.5) * 0.3;
                this.alpha = Math.random() * 0.4 + 0.1;
                this.verli = Math.random() > 0.7;
            }
            update() {
                this.x += this.vx;
                this.y += this.vy;
                if (this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) this.reset();
            }
            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
                ctx.fillStyle = this.verli ?
                    `rgba(255, 193, 7, ${this.alpha})` :
                    `rgba(255, 213, 79, ${this.alpha * 0.5})`;
                ctx.fill();
            }
        }

        for (let i = 0; i < PARTICLE_COUNT; i++) particles.push(new Particle());

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(p => {
                p.update();
                p.draw();
            });
            requestAnimationFrame(animate);
        }
        animate();
    }
</script>
@endpush