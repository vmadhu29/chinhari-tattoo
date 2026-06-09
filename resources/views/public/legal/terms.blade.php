@extends('layouts.public')

@section('content')
<section class="relative pt-32 pb-20 overflow-hidden bg-studio-darker" aria-label="Terms of Service Header">
    <div class="absolute inset-0 bg-ink-radial pointer-events-none" aria-hidden="true"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="font-display text-4xl md:text-6xl text-studio-white tracking-wider mb-4">
            TERMS OF <span class="text-verli-gradient">SERVICE</span>
        </h1>
        <p class="text-studio-muted text-sm">Last Updated: June 2026</p>
    </div>
</section>

<section class="py-20 bg-studio-black border-t border-studio-border" aria-label="Terms of Service Details">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-invert max-w-none text-studio-muted text-sm leading-relaxed space-y-6">
            <h2 class="text-studio-white font-display text-2xl tracking-wide uppercase mt-8">1. Booking Policy</h2>
            <p>
                Booking an appointment is completely free of charge and requires no advance deposit. You will only pay for your tattoo once the artwork is completed in our studio.
            </p>

            <h2 class="text-studio-white font-display text-2xl tracking-wide uppercase mt-8">2. Rescheduling & Cancellations</h2>
            <p>
                While booking is free, we kindly request that you provide at least 24 hours notice if you need to reschedule or cancel your appointment. Repeated cancellations with less than 24 hours notice or failure to show up may result in future bookings being declined.
            </p>

            <h2 class="text-studio-white font-display text-2xl tracking-wide uppercase mt-8">3. Studio Conduct & Age Restrictions</h2>
            <p>
                You must be at least 18 years of age to get a tattoo. Proper identification is required. We reserve the right to refuse service to anyone for any reason, including clients who are under the influence of alcohol or drugs.
            </p>

            <h2 class="text-studio-white font-display text-2xl tracking-wide uppercase mt-8">4. Liability</h2>
            <p>
                Tattooing is an irreversible body modification procedure. While we maintain the highest sanitation and professional standards, the client assumes all responsibility for the healing process and the decision to receive body art.
            </p>
        </div>
    </div>
</section>
@endsection
