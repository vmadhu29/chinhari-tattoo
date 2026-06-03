@extends('layouts.public')

@section('content')

{{-- ══════════════════════════════════════════════════════
     HERO SECTION — Cinematic Full Screen
     ══════════════════════════════════════════════════════ --}}
<section
    id="hero"
    class="relative min-h-screen flex items-center justify-start overflow-hidden bg-[#121212] pt-20"
    aria-label="Hero"
>
    {{-- Background Image --}}
    <div class="absolute inset-0 z-0 bg-[#121212]">
        {{-- Right side banner image matching the reference --}}
        <div class="absolute inset-0 flex justify-end">
            <div class="w-full md:w-3/5 h-full relative">
                <img 
                    src="{{ asset('images/hero_banner.jpg') }}" 
                    alt="Dharam Sahu Tattooing" 
                    class="w-full h-full object-cover opacity-100"
                >
                {{-- Left-to-right fade mask --}}
                <div class="absolute inset-0 bg-gradient-to-r from-[#121212] via-[#121212]/40 to-transparent z-10 hidden md:block"></div>
                {{-- Bottom fade mask --}}
                <div class="absolute inset-0 bg-gradient-to-t from-[#121212] via-transparent to-transparent z-10"></div>
            </div>
        </div>
        {{-- Full dark overlay for mobile to maintain text readability --}}
        <div class="absolute inset-0 bg-black/50 md:hidden z-10"></div>
    </div>

    {{-- Particle Canvas Background --}}
    <canvas id="hero-canvas" class="absolute inset-0 z-10 pointer-events-none opacity-40"></canvas>

    {{-- Floating Left Reviews/Hygiene Badges --}}
    <div class="fixed left-0 top-1/2 -translate-y-1/2 z-40 hidden md:flex flex-col gap-3 pointer-events-auto">
        {{-- Google Reviews --}}
        <a href="{{ config('studio.google_maps_url', 'https://maps.app.goo.gl/FthHoox4rfMViKoLA') }}" target="_blank" rel="noopener" class="bg-white border-y border-r border-gray-200/80 rounded-r-2xl shadow-xl p-3 flex flex-col items-center justify-center text-center w-[76px] transition-all duration-300 hover:translate-x-1.5 group">
            {{-- Colored Google Icon --}}
            <svg class="w-6 h-6 mb-1.5" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
            </svg>
            <span class="text-[9px] text-gray-500 font-bold tracking-tight leading-none">Google</span>
            <span class="text-[9px] text-gray-400 font-semibold tracking-tight leading-none mt-0.5">Reviews</span>
            <span class="text-xs font-black text-black mt-2">4.9</span>
        </a>
        
        {{-- Hygiene & Safety --}}
        <div class="bg-white border-y border-r border-gray-200/80 rounded-r-2xl shadow-xl p-3 flex flex-col items-center justify-center text-center w-[76px] group">
            {{-- Green Medical Cross Icon --}}
            <svg class="w-6 h-6 mb-1.5 text-green-600" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            <span class="text-[9px] text-gray-500 font-bold tracking-tight leading-none">Hygiene &</span>
            <span class="text-[9px] text-gray-400 font-semibold tracking-tight leading-none mt-0.5">Safety</span>
            <span class="text-xs font-black text-black mt-2">4.9</span>
        </div>
    </div>

    {{-- Hero Content: Premium Glassmorphic Card --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-12 md:py-20">
        <div 
            class="bg-black/50 backdrop-blur-md border border-white/10 p-8 sm:p-10 md:p-12 rounded-[32px] max-w-md md:max-w-lg shadow-[0_20px_50px_rgba(0,0,0,0.5)] flex flex-col items-start text-left
                   opacity-0 animate-fade-in animate-fill-forwards relative overflow-hidden"
            style="animation-delay:0.3s;"
        >
            {{-- Subtle Gold Accent Badge --}}
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-gold/10 border border-gold/30 rounded-full text-[10px] uppercase tracking-[0.2em] font-bold text-gold mb-5 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-gold animate-pulse"></span>
                <span>Chhattisgarh's Premier Studio</span>
            </div>

            {{-- Main Headline: Mixed Serif & Sans-Serif Gold-Accent Typography --}}
            <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl tracking-tight leading-[1.2] text-white mb-3">
                Your Skin,<br>
                Our <span class="font-sans font-black bg-gradient-to-r from-gold via-gold-light to-gold bg-clip-text text-transparent uppercase tracking-wider block mt-0.5">Canvas</span>
            </h1>

            {{-- Gold Divider Line --}}
            <div class="w-12 h-0.5 bg-gradient-to-r from-gold to-gold-light mb-4 rounded-full shadow-sm"></div>

            {{-- Subtitle --}}
            <p class="text-gray-300 text-xs sm:text-sm leading-relaxed mb-6 max-w-md">
                Chhattisgarh's premier destination for bespoke, high-end body art. Led by master artist Dharam Sahu, we transform your stories, values, and memory into breathing masterpieces using world-class safety standards and award-winning craftsmanship.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 w-full sm:w-auto">
                <a href="{{ route('booking.create') }}" class="btn px-7 py-3.5 bg-gold text-black hover:bg-white hover:text-black transition-all duration-300 font-bold text-xs sm:text-sm text-center shadow-lg shadow-gold/10 hover:shadow-white/10 active:scale-95 flex items-center justify-center gap-2">
                    Book Free Consultation
                </a>
                <a href="tel:{{ config('studio.phone') }}" class="btn px-7 py-3.5 border border-white/20 text-white hover:text-gold hover:border-gold hover:bg-gold/10 transition-all duration-300 font-bold text-xs sm:text-sm tracking-wide text-center inline-flex items-center justify-center gap-2 active:scale-95 group">
                    <svg class="w-4 h-4 text-white group-hover:text-gold transition-colors flex-shrink-0 group-hover:rotate-12 duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span>Book on Call</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex flex-col items-center gap-2 opacity-60" aria-hidden="true">
        <span class="text-[10px] tracking-[0.3em] uppercase text-studio-muted">Scroll</span>
        <div class="w-px h-12 bg-gradient-to-b from-gold to-transparent animate-pulse"></div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     STATS SECTION
     ══════════════════════════════════════════════════════ --}}
<section class="py-14 bg-studio-darker border-y border-studio-border relative overflow-hidden" aria-label="Studio statistics">
    {{-- Decorative gold-accent lines --}}
    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-gold/30 to-transparent"></div>
    <div class="absolute inset-x-0 bottom-0 h-px bg-gradient-to-r from-transparent via-gold/30 to-transparent"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-y-8 md:gap-y-0 relative">
            @php
                $stats = [
                    ['number' => 500,  'suffix' => '+',  'label' => 'Happy Clients'],
                    ['number' => 8,    'suffix' => '+',  'label' => 'Years Experience'],
                    ['number' => 1000, 'suffix' => '+',  'label' => 'Tattoos Done'],
                    ['number' => 5,    'suffix' => '.0', 'label' => 'Google Rating'],
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
<section class="py-24 bg-studio-black" aria-labelledby="categories-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16" data-reveal>
            <div class="section-eyebrow justify-center">Explore Styles</div>
            <h2 id="categories-heading" class="section-title mb-4">Art That Speaks<br><span class="text-gold-gradient">Your Language</span></h2>
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
                    aria-label="{{ $cat['name'] }} tattoos"
                >
                    {{-- Background Image --}}
                    <img
                        src="{{ $cat['image'] }}"
                        alt="{{ $cat['name'] }} style"
                        loading="lazy"
                        class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out z-0"
                    >
                    {{-- Gradient Overlay (light-to-cream matching light mode design) --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-studio-black/95 via-studio-black/50 to-studio-black/10 transition-opacity duration-300 group-hover:opacity-90 z-0"></div>

                    {{-- Top Section: Count --}}
                    <div class="flex justify-end items-start z-10">
                        <span class="text-xs font-semibold text-studio-faint bg-studio-black/85 backdrop-blur-sm px-2.5 py-1 rounded-full border border-studio-border/50 shadow-sm">{{ $cat['count'] }}+</span>
                    </div>

                    {{-- Bottom Section: Title -- z-10 to stay on top of background image --}}
                    <div class="z-10">
                        <h3 class="text-studio-white font-semibold text-lg group-hover:text-gold transition-colors duration-300">{{ $cat['name'] }}</h3>
                        <p class="text-studio-faint text-xs mt-1 group-hover:text-studio-muted transition-colors">View Gallery →</p>
                    </div>

                    {{-- Gold Border on Hover --}}
                    <div class="absolute inset-0 border border-gold/0 group-hover:border-gold/30 rounded-2xl transition-all duration-300 pointer-events-none z-20"></div>
                </a>
            @endforeach
        </div>

        <div class="text-center mt-10" data-reveal>
            <a href="{{ route('portfolio') }}" class="btn-outline-gold">View All Styles</a>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     FEATURED PORTFOLIO
     ══════════════════════════════════════════════════════ --}}
<section class="py-24 bg-studio-darker" aria-labelledby="portfolio-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
            <div data-reveal>
                <div class="section-eyebrow">Featured Work</div>
                <h2 id="portfolio-heading" class="section-title">Ink That<br><span class="text-gold-gradient">Tells Stories</span></h2>
            </div>
            <a href="{{ route('portfolio') }}" class="btn-outline-gold self-start md:self-auto flex-shrink-0" data-reveal>
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
                        data-delay="{{ $i * 60 }}"
                    >
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
                        aria-label="{{ $item->title }}"
                    >
                        <img
                            src="{{ $item->thumbnail_url }}"
                            alt="{{ $item->alt_text ?? $item->title }}"
                            loading="lazy"
                            class="w-full h-full object-cover"
                        >
                        <div class="portfolio-item-overlay">
                            <span class="badge-gold text-xs">{{ $item->category->name ?? 'Tattoo' }}</span>
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
<section class="py-24 bg-studio-black relative overflow-hidden" aria-labelledby="artists-heading">
    <div class="absolute inset-0 bg-ink-radial pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        <div class="text-center mb-16" data-reveal>
            <div class="section-eyebrow justify-center">The Mastermind</div>
            <h2 id="artists-heading" class="section-title">Master of<br><span class="text-gold-gradient">The Craft</span></h2>
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
                    <p class="text-gold text-sm tracking-wider uppercase font-semibold">Founder & Master Artist</p>
                    <p class="text-studio-muted text-sm leading-relaxed">Raipur's premier tattoo artist with over 10 years of experience, specializing in hyper-realistic portraits, blackwork, mandalas, and spiritual designs.</p>
                </div>
            </div>
        @else
            <div class="max-w-5xl mx-auto bg-studio-card border border-studio-border rounded-3xl p-8 md:p-12 shadow-card flex flex-col md:flex-row gap-12 items-center" data-reveal>
                {{-- Left: Portrait --}}
                <div class="relative w-full md:w-2/5 aspect-[4/5] flex-shrink-0 group">
                    {{-- Offset Gold Accent Frame behind the photo --}}
                    <div class="absolute -inset-2 border border-gold/45 rounded-3xl translate-x-3 translate-y-3 transition-transform duration-500 group-hover:translate-x-1.5 group-hover:translate-y-1.5 -z-10 pointer-events-none"></div>
                    
                    {{-- Actual Image Container --}}
                    <div class="w-full h-full rounded-2xl overflow-hidden border border-studio-border bg-studio-dark relative z-10 shadow-md">
                        <img 
                            src="{{ $artist->profile_photo_url }}" 
                            alt="{{ $artist->display_name }}" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/45 via-transparent to-transparent"></div>
                    </div>
                </div>

                {{-- Right: Content --}}
                <div class="w-full md:w-3/5 space-y-6 text-left">
                    <div>
                        <span class="badge-gold text-xs px-3 py-1 mb-3">{{ $artist->experience_years }}+ Years Experience</span>
                        <h3 class="font-serif text-3xl md:text-4xl text-studio-white leading-none font-bold">{{ $artist->display_name }}</h3>
                        <p class="text-gold text-sm tracking-wider uppercase font-semibold mt-2">{{ $artist->tagline }}</p>
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
                                        <span class="text-gold">🏆</span> {{ $award }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex flex-wrap gap-4 pt-6 border-t border-studio-border">
                        <a href="{{ route('artists.show', $artist->slug) }}" class="btn-outline-gold btn-sm">View Full Portfolio</a>
                        <a href="{{ route('booking.create', ['artist' => $artist->id]) }}" class="btn-gold btn-sm">Book Artist</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     BOOKING PROCESS — How it Works
     ══════════════════════════════════════════════════════ --}}
<section class="py-24 bg-studio-darker relative overflow-hidden" aria-labelledby="process-heading">
    {{-- Fine line accents matching premium luxury brand layout --}}
    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-gold/10 to-transparent"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16" data-reveal>
            <div class="section-eyebrow justify-center">Simple Process</div>
            <h2 id="process-heading" class="section-title">How to Book<br><span class="text-gold-gradient">Your Appointment</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 md:gap-6 relative">
            {{-- Connecting Line (desktop) --}}
            <div class="hidden md:block absolute top-12 left-[12.5%] right-[12.5%] h-px bg-gradient-to-r from-transparent via-gold/25 to-transparent z-0" aria-hidden="true"></div>

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
                        {{-- Elegant round backdrop with a thin gold border --}}
                        <div class="w-24 h-24 rounded-full border border-studio-border/60 bg-studio-card/85 flex items-center justify-center relative group-hover:border-gold/50 group-hover:shadow-gold-sm transition-all duration-500">
                            {{-- Massive elegant serif number in gold --}}
                            <span class="font-serif text-4xl font-light text-gold tracking-tight group-hover:scale-110 transition-transform duration-500">{{ $step['num'] }}</span>
                        </div>
                    </div>
                    <h3 class="text-studio-white font-semibold text-lg mb-3 group-hover:text-gold transition-colors duration-300">{{ $step['title'] }}</h3>
                    <p class="text-studio-muted text-xs sm:text-sm leading-relaxed max-w-[240px] mx-auto">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-14" data-reveal>
            <a href="{{ route('booking.create') }}" class="btn-gold btn-lg">Start Your Journey</a>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     TESTIMONIALS
     ══════════════════════════════════════════════════════ --}}
<section class="py-24 bg-studio-black" aria-labelledby="testimonials-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16" data-reveal>
            <div class="section-eyebrow justify-center">Google Reviews</div>
            <h2 id="testimonials-heading" class="section-title">Loved by Chhattisgarh,<br><span class="text-gold-gradient">Rated 4.8★ on Google</span></h2>
            
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
                    <span class="text-sm font-bold text-studio-white">4.8</span>
                    <div class="flex text-gold">
                        @for($s=1;$s<=5;$s++)
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <span class="text-[11px] text-studio-muted">based on 150+ reviews</span>
                </div>
                <a href="https://maps.app.goo.gl/FthHoox4rfMViKoLA" target="_blank" rel="noopener" class="text-xs text-gold hover:text-gold-light inline-flex items-center gap-1 font-semibold group transition-all">
                    Write a Review
                    <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
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
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0 {{ $review['avatar_color'] }}">
                            {{ $review['initials'] }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-studio-white font-semibold text-sm leading-tight flex items-center gap-1.5 truncate">
                                {{ $review['name'] }}
                                <span class="inline-flex items-center justify-center w-3.5 h-3.5 rounded-full bg-blue-500/20 text-blue-400 text-[8px]" title="Verified Local Guide">✓</span>
                            </p>
                            <p class="text-studio-faint text-xs mt-0.5 truncate">{{ $review['location'] }}</p>
                        </div>
                    </div>

                    {{-- Rating Stars & Date --}}
                    <div class="flex items-center justify-between gap-2 border-t border-studio-border/20 pt-3">
                        <div class="flex gap-0.5 text-gold">
                            @for($s = 1; $s <= $review['rating']; $s++)
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <span class="text-studio-faint text-[10px]">{{ $review['relative_date'] }}</span>
                    </div>

                    {{-- Review Content --}}
                    <blockquote class="text-studio-gray text-xs sm:text-sm leading-relaxed flex-1 italic">
                        "{{ $review['content'] }}"
                    </blockquote>

                    {{-- Tattoo Style Badge --}}
                    <div class="flex justify-between items-center mt-auto pt-3 border-t border-studio-border/20 text-xs text-studio-faint">
                        <span>Style: <strong class="text-gold">{{ $review['style'] }}</strong></span>
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
<section class="py-24 bg-studio-darker" aria-labelledby="faq-heading">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16" data-reveal>
            <div class="section-eyebrow justify-center">FAQ</div>
            <h2 id="faq-heading" class="section-title">Common<br><span class="text-gold-gradient">Questions</span></h2>
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
                    data-delay="{{ $i * 80 }}"
                >
                    <button
                        @click="open === {{ $i }} ? open = null : open = {{ $i }}"
                        class="w-full flex items-center justify-between p-6 text-left group"
                        :aria-expanded="open === {{ $i }}"
                        aria-controls="faq-answer-{{ $i }}"
                    >
                        <span class="text-studio-white font-medium pr-4 group-hover:text-gold transition-colors duration-200">{{ $q }}</span>
                        <svg
                            class="w-5 h-5 text-gold flex-shrink-0 transition-transform duration-300"
                            :class="open === {{ $i }} ? 'rotate-45' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
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
                        role="region"
                    >
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
<section class="py-24 bg-studio-black" aria-labelledby="contact-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

            {{-- Contact Info --}}
            <div data-reveal>
                <div class="section-eyebrow">Find Us</div>
                <h2 id="contact-heading" class="section-title mb-8">Visit Our<br><span class="text-gold-gradient">Studio</span></h2>

                <div class="space-y-6">
                    <div class="flex gap-4 items-start">
                        <div class="w-12 h-12 rounded-xl bg-gold/10 border border-gold/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-studio-white font-semibold mb-1">Location</p>
                            <p class="text-studio-muted text-sm">Chinhari Tattoo Studio, Raipur, Chhattisgarh 492001</p>
                            <a href="{{ config('studio.google_maps_url') }}" class="text-gold text-xs hover:text-gold-light mt-2 inline-block" target="_blank" rel="noopener">Open in Google Maps →</a>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start">
                        <div class="w-12 h-12 rounded-xl bg-gold/10 border border-gold/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <p class="text-studio-white font-semibold mb-1">Phone / WhatsApp</p>
                            <a href="tel:+919285001719" class="text-studio-muted text-sm hover:text-gold transition-colors">+91 92850 01719</a>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start">
                        <div class="w-12 h-12 rounded-xl bg-gold/10 border border-gold/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-studio-white font-semibold mb-1">Studio Hours</p>
                            <p class="text-studio-muted text-sm">Monday – Sunday: <span class="text-gold">10:00 AM – 9:00 PM</span></p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 mt-10">
                    <a href="tel:+919285001719" class="btn-gold btn-sm">Call Now</a>
                    <a href="https://wa.me/919285001719?text=Hi! I'd like to book a tattoo appointment." class="btn-whatsapp btn-sm" target="_blank" rel="noopener">WhatsApp</a>
                    <a href="{{ route('contact') }}" class="btn-outline-gold btn-sm">Contact Form</a>
                </div>
            </div>

            {{-- Google Maps Embed --}}
            <div class="rounded-2xl overflow-hidden border border-studio-border shadow-card h-96 lg:h-auto lg:min-h-[400px]" data-reveal data-delay="200">
                @if(config('studio.google_maps_embed_url'))
                    <iframe
                        src="{{ config('studio.google_maps_embed_url') }}"
                        class="w-full h-full min-h-[400px]"
                        style="border:0; filter: invert(90%) hue-rotate(180deg) brightness(0.85) contrast(0.85);"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Chinhari Tattoo Studio Location Map"
                        aria-label="Google Maps showing Chinhari Tattoo Studio location in Raipur"
                    ></iframe>
                @else
                    <div class="w-full h-full min-h-[400px] bg-studio-card flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-studio-faint mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            <p class="text-studio-muted text-sm">Raipur, Chhattisgarh</p>
                            <a href="{{ config('studio.google_maps_url') }}" class="btn-outline-gold btn-sm mt-4 inline-block" target="_blank" rel="noopener">Open in Google Maps</a>
                        </div>
                    </div>
                @endif
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
        canvas.width  = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;
    }
    resize();
    window.addEventListener('resize', resize);

    class Particle {
        constructor() { this.reset(); }
        reset() {
            this.x    = Math.random() * canvas.width;
            this.y    = Math.random() * canvas.height;
            this.r    = Math.random() * 2 + 0.5;
            this.vx   = (Math.random() - 0.5) * 0.3;
            this.vy   = (Math.random() - 0.5) * 0.3;
            this.alpha = Math.random() * 0.4 + 0.1;
            this.gold  = Math.random() > 0.7;
        }
        update() {
            this.x += this.vx;
            this.y += this.vy;
            if (this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) this.reset();
        }
        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
            ctx.fillStyle = this.gold
                ? `rgba(212, 175, 55, ${this.alpha})`
                : `rgba(139, 0, 0, ${this.alpha * 0.5})`;
            ctx.fill();
        }
    }

    for (let i = 0; i < PARTICLE_COUNT; i++) particles.push(new Particle());

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(p => { p.update(); p.draw(); });
        requestAnimationFrame(animate);
    }
    animate();
}
</script>
@endpush
