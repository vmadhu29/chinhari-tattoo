@extends('layouts.public')

@section('content')
{{-- Page Header --}}
<section class="relative pt-32 pb-20 overflow-hidden" aria-label="About Us Header">
    <div class="absolute inset-0 bg-ink-radial pointer-events-none" aria-hidden="true"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="flex items-center justify-center gap-4 mb-4">
            <div class="w-8 h-px bg-verli/60"></div>
            <span class="text-verli text-xs tracking-[0.4em] uppercase font-semibold">Chinhari Tattoo Studio</span>
            <div class="w-8 h-px bg-verli/60"></div>
        </div>
        <h1 class="font-display text-5xl md:text-7xl text-studio-white tracking-wider mb-6">
            OUR STORY & <span class="text-verli-gradient">PHILOSOPHY</span>
        </h1>
        <p class="text-studio-muted text-lg max-w-2xl mx-auto leading-relaxed">
            Raipur's premier destination for custom tattoo art. We translate your life, beliefs, and memories into timeless ink.
        </p>
    </div>
</section>

{{-- The Studio & Philosophy --}}
<section class="py-20 bg-studio-darker border-y border-studio-border" aria-labelledby="story-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div data-reveal>
                <div class="section-eyebrow">Raipur's Pioneer</div>
                <h2 id="story-heading" class="section-title mb-6">Artistry Crafted<br><span class="text-verli-gradient">With Passion & Precision</span></h2>
                <div class="space-y-4 text-studio-muted text-sm leading-relaxed">
                    <p>
                        Established in Raipur, Chhattisgarh, <strong>Chinhari Tattoo Studio</strong> has grown to become the benchmark of premium tattooing in the region. The name "Chinhari" translates to a "mark" or "souvenir" in the local Chhattisgarhi language — representing the meaningful marks we etch on our clients' skins.
                    </p>
                    <p>
                        We do not believe in mass-produced designs. Every tattoo we create is a custom piece, conceptualized from scratch through personal consultations between our artists and you.
                    </p>
                    <p>
                        Inspired by global standards of tattooing, our studio features a high-end sterile environment, state-of-the-art equipment, and a curated lineup of specialized artists.
                    </p>
                </div>
            </div>
            <div class="relative" data-reveal data-delay="200">
                <div class="aspect-square bg-studio-card rounded-2xl border border-studio-border flex items-center justify-center p-8 overflow-hidden shadow-card">
                    <div class="text-center">
                        <span class="text-6xl block mb-6 animate-float" aria-hidden="true">🏆</span>
                        <h3 class="font-display text-2xl text-verli mb-2">Award-Winning Quality</h3>
                        <p class="text-studio-muted text-xs max-w-sm mx-auto">
                            Recognized for safety standards and custom composition design, bringing global standards of body art to Chhattisgarh.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Core Values --}}
<section class="py-24 bg-studio-black" aria-labelledby="values-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-reveal>
            <div class="section-eyebrow justify-center">How We Work</div>
            <h2 id="values-heading" class="section-title">Our Core<br><span class="text-verli-gradient">Principles</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $values = [
                    ['icon'=>'🛡️','title'=>'Absolute Hygiene','desc'=>'Your safety is our top priority. We use medical-grade autoclaves, single-use disposable needles, and strict sanitization before and after every single session.'],
                    ['icon'=>'🎨','title'=>'Custom Artistry','desc'=>'We do not copy designs. Our artists spend time understanding your ideas to draw custom, unique body art tailored to your body lines.'],
                    ['icon'=>'☕','title'=>'Comfortable Experience','desc'=>'Getting a tattoo is a personal journey. We provide a private, comfortable, and luxury studio space designed to make your session stress-free.'],
                ];
            @endphp
            @foreach($values as $i => $val)
                <div class="card p-8 flex flex-col gap-4 text-center rounded-2xl border border-studio-border" data-reveal data-delay="{{ $i * 100 }}">
                    <div class="text-4xl justify-center items-center flex mb-2" aria-hidden="true">{{ $val['icon'] }}</div>
                    <h3 class="text-studio-white font-semibold text-lg">{{ $val['title'] }}</h3>
                    <p class="text-studio-muted text-sm leading-relaxed">{{ $val['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="py-20 bg-studio-darker text-center border-t border-studio-border" aria-label="CTA">
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="font-display text-4xl md:text-5xl text-studio-white mb-6">WANT TO MEET AN ARTIST?</h2>
        <p class="text-studio-muted mb-8 text-sm">
            Consultations are free, and there is no obligation. Book your session to discuss design concept, placement, size, and cost.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('booking.create') }}" class="btn-verli">Book Consultation</a>
            <a href="{{ route('artists') }}" class="btn-outline-verli">Meet the Artists</a>
        </div>
    </div>
</section>
@endsection
