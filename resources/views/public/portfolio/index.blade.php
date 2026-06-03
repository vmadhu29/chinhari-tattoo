@extends('layouts.public')

@section('content')
{{-- Portfolio Header --}}
<section class="relative pt-32 pb-16 overflow-hidden" aria-label="Portfolio Header">
    <div class="absolute inset-0 bg-ink-radial pointer-events-none" aria-hidden="true"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="flex items-center justify-center gap-4 mb-4">
            <div class="w-8 h-px bg-gold/60"></div>
            <span class="text-gold text-xs tracking-[0.4em] uppercase font-semibold">Tattoo Gallery</span>
            <div class="w-8 h-px bg-gold/60"></div>
        </div>
        <h1 class="font-display text-5xl md:text-7xl text-studio-white tracking-wider mb-6">
            DESIGN <span class="text-gold-gradient">PORTFOLIO</span>
        </h1>
        <p class="text-studio-muted text-lg max-w-2xl mx-auto leading-relaxed">
            Discover custom artworks crafted by our expert artists in Raipur. Filter by your preferred tattoo style to explore.
        </p>
    </div>
</section>

{{-- Filter Navigation --}}
<section class="py-6 bg-studio-darker border-y border-studio-border sticky top-[72px] z-30" aria-label="Portfolio Filters">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-center gap-2">
            <a 
                href="{{ route('portfolio') }}" 
                class="px-5 py-2 text-xs font-semibold uppercase tracking-wider rounded-full border transition-all duration-200
                       {{ !$selectedStyle ? 'bg-gold border-gold text-studio-black' : 'border-studio-border text-studio-muted hover:text-white hover:border-studio-muted bg-studio-black' }}"
            >
                All Works
            </a>
            @foreach($categories as $cat)
                <a 
                    href="{{ route('portfolio', ['style' => $cat->slug]) }}" 
                    class="px-5 py-2 text-xs font-semibold uppercase tracking-wider rounded-full border transition-all duration-200
                           {{ $selectedStyle === $cat->slug ? 'bg-gold border-gold text-studio-black' : 'border-studio-border text-studio-muted hover:text-white hover:border-studio-muted bg-studio-black' }}"
                >
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Design Grid --}}
<section class="py-16 bg-studio-black" aria-label="Gallery Grid">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($portfolios->isEmpty())
            <div class="text-center py-20 bg-studio-darker border border-studio-border rounded-2xl" data-reveal>
                <span class="text-5xl block mb-4" aria-hidden="true">🎨</span>
                <h3 class="text-studio-white font-medium mb-1">No Artworks Found</h3>
                <p class="text-studio-muted text-xs">We haven't uploaded tattoos under this category yet. Check out other styles!</p>
            </div>
        @else
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($portfolios as $i => $item)
                    <a 
                        href="{{ route('portfolio.show', $item->slug) }}"
                        class="portfolio-item rounded-2xl overflow-hidden aspect-[3/4] relative block group border border-studio-border/30 hover:border-gold/30 transition-all duration-300"
                        data-reveal
                        data-delay="{{ ($i % 8) * 50 }}"
                        aria-label="{{ $item->title }}"
                    >
                        <img 
                            src="{{ $item->thumbnail_url }}"
                            alt="{{ $item->alt_text ?? $item->title }}"
                            loading="lazy"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        >
                        <div class="portfolio-item-overlay absolute inset-0 bg-gradient-to-t from-studio-black/95 via-studio-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-6 flex flex-col justify-end">
                            <span class="badge-gold text-[10px] self-start mb-2">{{ $item->tattoo_style }}</span>
                            <h3 class="text-studio-white font-semibold text-sm">{{ $item->title }}</h3>
                            <p class="text-studio-muted text-[11px] mt-0.5">By {{ $item->artist->display_name }}</p>
                            <p class="text-studio-faint text-[10px] mt-2">View Details →</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
