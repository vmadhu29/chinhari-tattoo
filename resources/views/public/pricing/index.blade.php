@extends('layouts.public')

@section('content')
<section class="relative pt-32 pb-20 overflow-hidden" aria-label="Pricing Header">
    <div class="absolute inset-0 bg-ink-radial pointer-events-none" aria-hidden="true"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="flex items-center justify-center gap-4 mb-4">
            <div class="w-8 h-px bg-verli/60"></div>
            <span class="text-verli text-xs tracking-[0.4em] uppercase font-semibold">PRICING POLICY</span>
            <div class="w-8 h-px bg-verli/60"></div>
        </div>
        <h1 class="font-display text-5xl md:text-7xl text-studio-white tracking-wider mb-6">
            TRANSPARENT <span class="text-verli-gradient">RATES</span>
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
            <div class="section-eyebrow justify-center">Fair & Transparent</div>
            <h2 id="rates-heading" class="section-title">Size-Based<br><span class="text-verli-gradient">Pricing</span></h2>
            <p class="text-studio-muted text-sm max-w-2xl mx-auto mt-4">We do not charge by the hour or offer arbitrary fixed prices. Your tattoo's cost is calculated mathematically based on its exact dimensions.</p>
        </div>

        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Size-Based Model --}}
            <div class="card p-8 sm:p-10 rounded-3xl border border-studio-border flex flex-col justify-center relative overflow-hidden" data-reveal>
                <div class="absolute top-0 right-0 p-8 opacity-5">
                    <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>
                </div>
                <div class="relative z-10">
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-verli/10 text-verli mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>
                    </span>
                    <h3 class="text-studio-white font-display text-2xl mb-4">Measurement Pricing</h3>
                    <p class="text-studio-gray text-sm leading-relaxed mb-6">
                        The price of your tattoo is strictly determined by its surface area in square inches (Length × Width). This ensures you only pay for the exact size of the artwork on your skin.
                    </p>
                    <ul class="space-y-4 text-studio-muted text-sm mb-8">
                        <li class="flex items-start gap-3">
                            <span class="text-verli mt-0.5" aria-hidden="true">✔</span> 
                            <span><strong>Fair Calculation:</strong> No unpredictable hourly billing.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-verli mt-0.5" aria-hidden="true">✔</span> 
                            <span><strong>Custom Adjustments:</strong> Minor price variations may apply based on extreme detail, shading density, or complex body placements.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-verli mt-0.5" aria-hidden="true">✔</span> 
                            <span><strong>Upfront Quotes:</strong> You will know the exact cost before we start tattooing.</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- The Process --}}
            <div class="card p-8 sm:p-10 rounded-3xl border border-studio-border flex flex-col justify-center relative overflow-hidden bg-verli/5" data-reveal data-delay="150">
                <div class="relative z-10">
                    <h3 class="text-studio-white font-display text-2xl mb-6">How to get a quote?</h3>
                    
                    <div class="space-y-6 relative">
                        <div class="absolute left-4 top-4 bottom-4 w-px bg-verli/30"></div>
                        
                        <div class="flex gap-4 relative">
                            <div class="w-8 h-8 rounded-full bg-studio-dark border border-verli flex items-center justify-center text-verli text-xs font-bold flex-shrink-0 z-10 shadow-sm">1</div>
                            <div>
                                <h4 class="text-white font-semibold text-sm mb-1">Share Your Idea</h4>
                                <p class="text-studio-muted text-xs leading-relaxed">Send us your reference images or concepts.</p>
                            </div>
                        </div>
                        
                        <div class="flex gap-4 relative">
                            <div class="w-8 h-8 rounded-full bg-studio-dark border border-verli flex items-center justify-center text-verli text-xs font-bold flex-shrink-0 z-10 shadow-sm">2</div>
                            <div>
                                <h4 class="text-white font-semibold text-sm mb-1">Determine Size</h4>
                                <p class="text-studio-muted text-xs leading-relaxed">Measure the exact height and width in inches of where you want the tattoo.</p>
                            </div>
                        </div>
                        
                        <div class="flex gap-4 relative">
                            <div class="w-8 h-8 rounded-full bg-verli flex items-center justify-center text-white text-xs font-bold flex-shrink-0 z-10 shadow-[0_0_15px_rgba(139,30,30,0.5)]">3</div>
                            <div>
                                <h4 class="text-white font-semibold text-sm mb-1">Get Your Exact Price</h4>
                                <p class="text-studio-muted text-xs leading-relaxed">We calculate the square inch area and provide your final quote instantly.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Deposit Info --}}
<section class="py-24 bg-studio-black" aria-labelledby="deposit-heading">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <div class="section-eyebrow justify-center" data-reveal>Securing Slots</div>
        <h2 id="deposit-heading" class="section-title mb-6" data-reveal>Booking Deposit &<br><span class="text-verli-gradient">Reservation Policy</span></h2>
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
            <a href="{{ route('booking.create') }}" class="btn-verli btn-lg">Book Free Consultation</a>
        </div>
    </div>
</section>
@endsection
