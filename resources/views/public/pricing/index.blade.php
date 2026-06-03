@extends('layouts.public')

@section('content')
<section class="relative pt-32 pb-20 overflow-hidden" aria-label="Pricing Header">
    <div class="absolute inset-0 bg-ink-radial pointer-events-none" aria-hidden="true"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="flex items-center justify-center gap-4 mb-4">
            <div class="w-8 h-px bg-gold/60"></div>
            <span class="text-gold text-xs tracking-[0.4em] uppercase font-semibold">PRICING POLICY</span>
            <div class="w-8 h-px bg-gold/60"></div>
        </div>
        <h1 class="font-display text-5xl md:text-7xl text-studio-white tracking-wider mb-6">
            TRANSPARENT <span class="text-gold-gradient">RATES</span>
        </h1>
        <p class="text-studio-muted text-lg max-w-2xl mx-auto leading-relaxed">
            No hidden costs. We charge based on tattoo size, complexity, and custom design details. Read how we estimate your project.
        </p>
    </div>
</section>

{{-- Pricing Models --}}
<section class="py-20 bg-studio-darker border-y border-studio-border" aria-labelledby="rates-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-reveal>
            <div class="section-eyebrow justify-center">Estimating Value</div>
            <h2 id="rates-heading" class="section-title">Our Pricing<br><span class="text-gold-gradient">Structures</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Hourly Pricing --}}
            <div class="card p-8 rounded-2xl border border-studio-border flex flex-col justify-between" data-reveal>
                <div>
                    <span class="text-3xl block mb-4" aria-hidden="true">⏱️</span>
                    <h3 class="text-studio-white font-display text-2xl mb-4">Hourly Rates</h3>
                    <p class="text-studio-muted text-sm leading-relaxed mb-6">
                        Best suited for large-scale custom tattoos (e.g. full sleeve, full back, large chest pieces) that span multiple sessions.
                    </p>
                    <ul class="space-y-3 text-studio-gray text-sm mb-8">
                        <li class="flex items-center gap-3">
                            <span class="text-gold" aria-hidden="true">✔</span> Base Rate: From ₹800 – ₹1,200 / hr
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-gold" aria-hidden="true">✔</span> Depends on choice of artist and complex detail
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-gold" aria-hidden="true">✔</span> Calculated on actual tattoo machine active time
                        </li>
                    </ul>
                </div>
                <div class="pt-6 border-t border-studio-border text-center">
                    <span class="text-xs text-studio-faint block uppercase mb-1">Starting from</span>
                    <span class="text-gold font-display text-4xl">₹800 <span class="text-sm font-sans text-studio-muted">/ hour</span></span>
                </div>
            </div>

            {{-- Fixed Pricing --}}
            <div class="card p-8 rounded-2xl border border-studio-border flex flex-col justify-between" data-reveal data-delay="150">
                <div>
                    <span class="text-3xl block mb-4" aria-hidden="true">🏷️</span>
                    <h3 class="text-studio-white font-display text-2xl mb-4">Fixed Quotes</h3>
                    <p class="text-studio-muted text-sm leading-relaxed mb-6">
                        Ideal for small, medium-sized, minimalist, or flash designs that can be completed within a single session.
                    </p>
                    <ul class="space-y-3 text-studio-gray text-sm mb-8">
                        <li class="flex items-center gap-3">
                            <span class="text-gold" aria-hidden="true">✔</span> Flat price quoted beforehand
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-gold" aria-hidden="true">✔</span> Based on dimensions (size in inches) & placement
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-gold" aria-hidden="true">✔</span> Ideal for minimal text, geometry, and small portraits
                        </li>
                    </ul>
                </div>
                <div class="pt-6 border-t border-studio-border text-center">
                    <span class="text-xs text-studio-faint block uppercase mb-1">Starting from</span>
                    <span class="text-gold font-display text-4xl">₹2,000 <span class="text-sm font-sans text-studio-muted">/ design</span></span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Deposit Info --}}
<section class="py-24 bg-studio-black" aria-labelledby="deposit-heading">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <div class="section-eyebrow justify-center" data-reveal>Securing Slots</div>
        <h2 id="deposit-heading" class="section-title mb-6" data-reveal>Booking Deposit &<br><span class="text-gold-gradient">Reservation Policy</span></h2>
        <div class="card p-8 rounded-2xl border border-studio-border space-y-4 text-studio-muted text-sm leading-relaxed text-left" data-reveal>
            <p>
                To reserve an appointment time and secure a spot with our artists, a <strong>non-refundable deposit</strong> is required.
            </p>
            <p>
                The deposit amount (starting from ₹500 to ₹1,500 depending on the size of the tattoo) is paid online via Razorpay during booking and is <strong>fully adjusted</strong> against the final price of your tattoo on the day of your session.
            </p>
            <p class="text-xs text-studio-faint">
                * Rescheduling requires a 24-hour notice to carry over your deposit. No-shows or late cancellations will forfeit the deposit.
            </p>
        </div>
        <div class="mt-10" data-reveal>
            <a href="{{ route('booking.create') }}" class="btn-gold btn-lg">Book Free Consultation</a>
        </div>
    </div>
</section>
@endsection
