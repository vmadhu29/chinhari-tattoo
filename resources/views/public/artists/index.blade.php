@extends('layouts.public')

@section('content')
<section class="relative pt-32 pb-20 overflow-hidden" aria-label="Artists Header">
    <div class="absolute inset-0 bg-ink-radial pointer-events-none" aria-hidden="true"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="flex items-center justify-center gap-4 mb-4">
            <div class="w-8 h-px bg-gold/60"></div>
            <span class="text-gold text-xs tracking-[0.4em] uppercase font-semibold">THE CREATIVE MINDS</span>
            <div class="w-8 h-px bg-gold/60"></div>
        </div>
        <h1 class="font-display text-5xl md:text-7xl text-studio-white tracking-wider mb-6">
            OUR <span class="text-gold-gradient">ARTISTS</span>
        </h1>
        <p class="text-studio-muted text-lg max-w-2xl mx-auto leading-relaxed">
            Meet Raipur's finest tattoo artists. Each artist specializes in custom work, bringing unique styling and years of expertise to your body art.
        </p>
    </div>
</section>

<section class="py-20 bg-studio-darker border-t border-studio-border" aria-label="Artists Gallery">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-8">
            @foreach($artists as $i => $artist)
                <div class="artist-card w-full max-w-sm flex flex-col h-full bg-studio-black border border-studio-border rounded-2xl overflow-hidden hover:border-gold/30 transition-all duration-300 shadow-card" data-reveal data-delay="{{ $i * 100 }}">
                    <div class="artist-card-photo aspect-[4/5] overflow-hidden bg-studio-card relative">
                        <img 
                            src="{{ $artist->profile_photo_url }}" 
                            alt="{{ $artist->display_name }}" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        >
                        <div class="artist-card-photo-overlay absolute inset-0 bg-gradient-to-t from-studio-black via-transparent to-transparent opacity-60"></div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h3 class="text-studio-white font-serif text-2xl font-semibold">{{ $artist->display_name }}</h3>
                                <p class="text-gold text-xs tracking-wider uppercase mt-1">{{ $artist->tagline }}</p>
                            </div>
                            <span class="badge-gold text-xs px-2.5 py-1">{{ $artist->experience_years }}+ Years</span>
                        </div>
                        <p class="text-studio-muted text-sm leading-relaxed mb-6 flex-grow">{{ $artist->bio }}</p>
                        
                        <div class="mb-6">
                            <span class="text-xs text-studio-faint block uppercase mb-2 tracking-widest font-semibold">Specializations</span>
                            <div class="flex flex-wrap gap-2">
                                @foreach($artist->specializations ?? [] as $spec)
                                    <span class="text-xs bg-studio-card border border-studio-border text-studio-gray px-3 py-1 rounded-full">{{ $spec }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex gap-3 mt-auto">
                            <a href="{{ route('artists.show', $artist->slug) }}" class="btn-outline-gold btn-sm w-1/2 text-center">View Portfolio</a>
                            <a href="{{ route('booking.create', ['artist' => $artist->id]) }}" class="btn-gold btn-sm w-1/2 text-center">Book Artist</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
