@extends('layouts.public')

@section('content')
<section class="relative pt-32 pb-20 overflow-hidden bg-studio-darker" aria-label="Privacy Policy Header">
    <div class="absolute inset-0 bg-ink-radial pointer-events-none" aria-hidden="true"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="font-display text-4xl md:text-6xl text-studio-white tracking-wider mb-4">
            PRIVACY <span class="text-gold-gradient">POLICY</span>
        </h1>
        <p class="text-studio-muted text-sm">Last Updated: June 2026</p>
    </div>
</section>

<section class="py-20 bg-studio-black border-t border-studio-border" aria-label="Privacy Policy Details">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-invert max-w-none text-studio-muted text-sm leading-relaxed space-y-6">
            <h2 class="text-studio-white font-display text-2xl tracking-wide uppercase mt-8">1. Information We Collect</h2>
            <p>
                We collect personal information that you provide to us directly, such as when you book an appointment, submit an inquiry form, or subscribe to our newsletter. This information may include your name, email address, phone number, design preferences, and reference images.
            </p>

            <h2 class="text-studio-white font-display text-2xl tracking-wide uppercase mt-8">2. How We Use Your Information</h2>
            <p>
                We use the information we collect to manage your appointments, process booking deposits, verify payments via Razorpay, send notifications, and respond to your design inquiries.
            </p>

            <h2 class="text-studio-white font-display text-2xl tracking-wide uppercase mt-8">3. Security</h2>
            <p>
                The security of your personal information is important to us. We implement industry-standard security protocols to safeguard your personal details and payment records. No payment card details are stored on our servers.
            </p>

            <h2 class="text-studio-white font-display text-2xl tracking-wide uppercase mt-8">4. Contact Us</h2>
            <p>
                If you have any questions about this Privacy Policy, please contact us at info@chinharitattoostudio.com or +91 92850 01719.
            </p>
        </div>
    </div>
</section>
@endsection
