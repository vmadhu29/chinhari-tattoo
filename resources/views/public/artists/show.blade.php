@extends('layouts.public')

@section('content')
{{-- Artist Profile Header --}}
<section class="relative pt-32 pb-16 overflow-hidden bg-studio-darker" aria-label="Artist Banner">
    <div class="absolute inset-0 bg-ink-radial pointer-events-none" aria-hidden="true"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <a href="{{ route('artists') }}" class="inline-flex items-center text-sm text-verli hover:text-verli-light mb-8 group transition-colors">
            <svg class="w-4 h-4 mr-2 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Artists
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-center">
            {{-- Profile Photo --}}
            <div class="lg:col-span-1 max-w-sm mx-auto lg:mx-0 w-full" data-reveal>
                <div class="aspect-[4/5] bg-studio-black border-2 border-verli/20 rounded-2xl overflow-hidden shadow-verli-sm">
                    <img 
                        src="{{ $artist->profile_photo_url }}" 
                        alt="{{ $artist->display_name }}"
                        class="w-full h-full object-cover object-top"
                    >
                </div>
            </div>

            {{-- Artist Info --}}
            <div class="lg:col-span-2 space-y-6" data-reveal data-delay="100">
                <div class="flex flex-wrap items-center gap-4">
                    <h1 class="font-display text-4xl md:text-6xl text-studio-white tracking-wider leading-none">
                        {{ $artist->display_name }}
                    </h1>
                    <span class="badge-verli text-xs px-3 py-1">{{ $artist->experience_years }}+ Years Experience</span>
                </div>
                
                <p class="text-verli text-lg tracking-wider uppercase font-semibold">{{ $artist->tagline }}</p>
                
                <p class="text-studio-muted text-sm md:text-base leading-relaxed max-w-xl">
                    {{ $artist->bio }}
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                    <div>
                        <span class="text-xs text-studio-faint block uppercase mb-2 tracking-widest font-semibold">Specializations</span>
                        <div class="flex flex-wrap gap-2">
                            @foreach($artist->specializations ?? [] as $spec)
                                <span class="text-xs bg-studio-black border border-studio-border text-studio-gray px-3 py-1.5 rounded-full">{{ $spec }}</span>
                            @endforeach
                        </div>
                    </div>

                    @if(!empty($artist->awards))
                        <div>
                            <span class="text-xs text-studio-faint block uppercase mb-2 tracking-widest font-semibold">Accreditation & Awards</span>
                            <ul class="space-y-1.5 text-xs text-studio-muted">
                                @foreach($artist->awards as $award)
                                    <li class="flex items-center gap-2">
                                        <span class="text-verli">🏆</span> {{ $award }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="flex flex-wrap items-center gap-4 pt-6 border-t border-studio-border">
                    <a href="{{ route('booking.create', ['artist' => $artist->id]) }}" class="btn-verli">
                        Book Session with {{ explode(' ', $artist->display_name)[0] }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Artist Portfolio Gallery --}}
<section class="py-24 bg-studio-black border-t border-studio-border" aria-labelledby="portfolio-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-reveal>
            <div class="section-eyebrow justify-center">Design Gallery</div>
            <h2 id="portfolio-heading" class="section-title">Featured Artworks By<br><span class="text-verli-gradient">{{ explode(' ', $artist->display_name)[0] }}</span></h2>
        </div>

        @if($portfolios->isEmpty())
            <div class="text-center py-16 bg-studio-darker border border-studio-border rounded-2xl" data-reveal>
                <span class="text-5xl block mb-4" aria-hidden="true">🎨</span>
                <h3 class="text-studio-white font-medium mb-1">Portfolio In Progress</h3>
                <p class="text-studio-muted text-xs">This artist is currently updating their public portfolio. Check back soon!</p>
            </div>
        @else
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($portfolios as $i => $item)
                    <a 
                        href="{{ route('portfolio.show', $item->slug) }}"
                        class="portfolio-item rounded-2xl overflow-hidden aspect-square relative block group"
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
                            <p class="text-studio-faint text-xs mt-1">View Details →</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
