@extends('layouts.public')

@section('content')
<section class="relative pt-32 pb-8 overflow-hidden bg-studio-darker" aria-label="Booking Header">
    <div class="absolute inset-0 bg-ink-radial pointer-events-none" aria-hidden="true"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="flex items-center justify-center gap-4 mb-4">
            <div class="w-8 h-px bg-gold/60"></div>
            <span class="text-gold text-xs tracking-[0.4em] uppercase font-semibold">Reserve Your Session</span>
            <div class="w-8 h-px bg-gold/60"></div>
        </div>
        <h1 class="font-display text-4xl md:text-6xl text-studio-white tracking-wider mb-4">
            BOOK AN <span class="text-gold-gradient">APPOINTMENT</span>
        </h1>
        <p class="text-studio-muted text-sm max-w-xl mx-auto leading-relaxed">
            Fill in your preferred artist, schedule a date, submit design references, and pay a secure deposit to reserve your slot.
        </p>
    </div>
</section>

<section class="pb-24 bg-studio-black" aria-label="Booking Wizard Form">
    <div class="max-w-7xl mx-auto">
        <livewire:booking-wizard />
    </div>
</section>
@endsection
