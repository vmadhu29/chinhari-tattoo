@extends('layouts.public')

@section('content')
<section class="relative pt-32 pb-16 overflow-hidden bg-studio-darker" aria-label="Portfolio Detail">
    <div class="absolute inset-0 bg-ink-radial pointer-events-none" aria-hidden="true"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <a href="{{ route('portfolio') }}" class="inline-flex items-center text-sm text-verli hover:text-verli-light mb-8 group transition-colors">
            <svg class="w-4 h-4 mr-2 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Portfolio
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            {{-- Artwork Display --}}
            <div data-reveal>
                <div class="rounded-2xl overflow-hidden border border-studio-border bg-studio-black shadow-card">
                    <img 
                        src="{{ $portfolio->image_url }}"
                        alt="{{ $portfolio->alt_text ?? $portfolio->title }}"
                        class="w-full h-auto object-cover max-h-[600px]"
                    >
                </div>
            </div>

            {{-- Artwork Information --}}
            <div class="space-y-8" data-reveal data-delay="150">
                <div>
                    <h1 class="font-display text-4xl md:text-5xl text-studio-white tracking-wider mb-2">
                        {{ $portfolio->title }}
                    </h1>
                    <span class="badge-verli text-xs px-2.5 py-1">{{ $portfolio->tattoo_style }}</span>
                </div>

                <div class="space-y-4 border-y border-studio-border py-6">
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-studio-faint block uppercase text-xs tracking-widest mb-1">Artist</span>
                            <a href="{{ route('artists.show', $portfolio->artist->slug) }}" class="text-studio-white hover:text-verli transition-colors font-medium">
                                {{ $portfolio->artist->display_name }}
                            </a>
                        </div>
                        <div>
                            <span class="text-studio-faint block uppercase text-xs tracking-widest mb-1">Placement</span>
                            <span class="text-studio-white font-medium">{{ $portfolio->body_placement ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-studio-white font-semibold text-base mb-3">Project Description</h3>
                    <p class="text-studio-muted text-sm leading-relaxed">
                        {{ $portfolio->description }}
                    </p>
                </div>

                <div class="pt-6">
                    <a href="{{ route('booking.create', ['artist' => $portfolio->artist_id]) }}" class="btn-verli">
                        Request Similar Tattoo
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Related Work --}}
<section class="py-24 bg-studio-black border-t border-studio-border" aria-labelledby="related-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-reveal>
            <div class="section-eyebrow justify-center">More Inspiration</div>
            <h2 id="related-heading" class="section-title">Related <span class="text-verli-gradient">Designs</span></h2>
        </div>

        @if($related->isEmpty())
            <p class="text-center text-studio-muted text-sm">No related designs found.</p>
        @else
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($related as $i => $item)
                    <a 
                        href="{{ route('portfolio.show', $item->slug) }}"
                        class="portfolio-item rounded-2xl overflow-hidden aspect-square relative block group border border-studio-border/30 hover:border-verli/30 transition-all duration-300"
                        data-reveal
                        data-delay="{{ $i * 60 }}"
                        aria-label="{{ $item->title }}"
                    >
                        <img 
                            src="{{ $item->thumbnail_url }}"
                            alt="{{ $item->alt_text ?? $item->title }}"
                            loading="lazy"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        >
                        <div class="portfolio-item-overlay absolute inset-0 bg-gradient-to-t from-studio-black/90 via-studio-black/35 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-6 flex flex-col justify-end">
                            <span class="badge-verli text-[10px] self-start mb-2">{{ $item->tattoo_style }}</span>
                            <h3 class="text-studio-white font-semibold text-sm">{{ $item->title }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
