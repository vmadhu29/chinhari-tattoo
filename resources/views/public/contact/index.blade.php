@extends('layouts.public')

@section('content')
<section class="relative pt-32 pb-16 overflow-hidden bg-studio-darker" aria-label="Contact Header">
    <div class="absolute inset-0 bg-ink-radial pointer-events-none" aria-hidden="true"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="flex items-center justify-center gap-4 mb-4">
            <div class="w-8 h-px bg-verli/60"></div>
            <span class="text-verli text-xs tracking-[0.4em] uppercase font-semibold">GET IN TOUCH</span>
            <div class="w-8 h-px bg-verli/60"></div>
        </div>
        <h1 class="font-display text-5xl md:text-7xl text-studio-white tracking-wider mb-6">
            CONTACT <span class="text-verli-gradient">US</span>
        </h1>
        <p class="text-studio-muted text-lg max-w-2xl mx-auto leading-relaxed">
            Have questions or want to discuss a custom design? Message us directly or visit our studio in Raipur, Chhattisgarh.
        </p>
    </div>
</section>

<section class="py-20 bg-white border-t border-studio-border" aria-labelledby="inquiry-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">

            {{-- Contact Information / Direct Channels --}}
            <div class="space-y-8" data-reveal>
                <div>
                    <h2 id="inquiry-heading" class="font-display text-3xl text-studio-white tracking-wider mb-4">Direct Channels</h2>
                    <p class="text-studio-muted text-sm leading-relaxed mb-6">
                        For immediate replies, we suggest messaging us via WhatsApp or calling directly.
                    </p>
                </div>

                <div class="space-y-6">
                    <div class="flex gap-4 items-start">
                        <div class="w-12 h-12 rounded-xl bg-verli/10 border border-verli/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-verli" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-studio-white font-semibold mb-1">Phone Call</p>
                            <a href="tel:{{ config('studio.phone') }}" class="text-studio-muted text-sm hover:text-verli transition-colors font-medium">
                                {{ config('studio.phone') }}
                            </a>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start">
                        <div class="w-12 h-12 rounded-xl bg-verli/10 border border-verli/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-verli" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-studio-white font-semibold mb-1">WhatsApp Chat</p>
                            <a href="https://wa.me/{{ config('studio.whatsapp_number') }}?text=Hi! I want to consult on a tattoo idea." target="_blank" rel="noopener" class="text-verli text-sm hover:text-verli-light transition-colors font-medium">
                                Chat with us →
                            </a>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start">
                        <div class="w-12 h-12 rounded-xl bg-verli/10 border border-verli/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-verli" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-studio-white font-semibold mb-1">Opening Hours</p>
                            <p class="text-studio-muted text-sm">Mon – Sun: <span class="text-verli">10:00 AM – 10:00 PM</span></p>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-studio-border">
                    <p class="text-xs text-studio-faint uppercase mb-3 tracking-widest font-semibold">Social Connect</p>
                    <div class="flex gap-3">
                        <a href="{{ config('studio.instagram') }}" target="_blank" rel="noopener" class="px-4 py-2 border border-studio-border rounded-lg text-xs hover:border-verli hover:text-verli transition-all duration-300 bg-studio-darker">Instagram</a>
                        <a href="{{ config('studio.facebook') }}" target="_blank" rel="noopener" class="px-4 py-2 border border-studio-border rounded-lg text-xs hover:border-verli hover:text-verli transition-all duration-300 bg-studio-darker">Facebook</a>
                        <a href="{{ config('studio.youtube') }}" target="_blank" rel="noopener" class="px-4 py-2 border border-studio-border rounded-lg text-xs hover:border-verli hover:text-verli transition-all duration-300 bg-studio-darker">YouTube</a>
                    </div>
                </div>
            </div>

            {{-- Custom Inquiry Form --}}
            <div class="card p-8 rounded-2xl border border-studio-border bg-studio-darker" data-reveal data-delay="150">
                <h3 class="text-studio-white font-semibold text-xl mb-6">Send an Inquiry</h3>

                <div id="formSuccess" class="hidden bg-green-500/10 border border-green-500/20 text-green-400 p-4 rounded-lg mb-6 text-sm">
                    ✓ Your inquiry is ready! You are being redirected to WhatsApp. <strong>Please hit "Send" in WhatsApp to complete your booking.</strong>
                </div>

                <form id="contactForm" class="space-y-4">
                    <div>
                        <label for="name" class="block text-xs uppercase tracking-wider text-studio-muted mb-2 font-semibold">Full Name</label>
                        <input type="text" id="name" required class="w-full bg-studio-black border border-studio-border rounded-lg px-4 py-3 text-sm text-studio-white focus:outline-none focus:border-verli">
                    </div>
                    <div>
                        <label for="email" class="block text-xs uppercase tracking-wider text-studio-muted mb-2 font-semibold">Email Address</label>
                        <input type="email" id="email" required class="w-full bg-studio-black border border-studio-border rounded-lg px-4 py-3 text-sm text-studio-white focus:outline-none focus:border-verli">
                    </div>
                    <div>
                        <label for="phone" class="block text-xs uppercase tracking-wider text-studio-muted mb-2 font-semibold">Phone Number</label>
                        <input type="tel" id="phone" required class="w-full bg-studio-black border border-studio-border rounded-lg px-4 py-3 text-sm text-studio-white focus:outline-none focus:border-verli">
                    </div>
                    <div>
                        <label for="message" class="block text-xs uppercase tracking-wider text-studio-muted mb-2 font-semibold">Describe your design idea</label>
                        <textarea id="message" rows="4" required placeholder="Size, style, body placement, etc." class="w-full bg-studio-black border border-studio-border rounded-lg px-4 py-3 text-sm text-studio-white focus:outline-none focus:border-verli"></textarea>
                    </div>
                    <button type="submit" class="btn-verli w-full py-3 text-center text-sm font-semibold rounded-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.01 2.01c-5.52 0-10 4.48-10 10 0 1.77.46 3.44 1.28 4.9L2 22l5.24-1.28c1.4.77 3.01 1.19 4.77 1.19 5.52 0 10-4.48 10-10s-4.48-10-10-10zm5.18 14.18c-.22.61-1.25 1.15-1.72 1.21-.43.06-1 .11-3.21-.8-2.67-1.1-4.38-3.83-4.51-4.01-.13-.18-1.07-1.42-1.07-2.71s.68-1.89.92-2.14c.24-.25.53-.31.7-.31.18 0 .36 0 .52.01.19.01.44-.07.67.48.24.58.71 1.73.77 1.85.06.12.11.27.02.44-.09.18-.13.29-.27.46-.12.15-.27.33-.37.44-.12.13-.25.27-.11.51.14.24.62 1.02 1.33 1.65.91.82 1.68 1.07 1.92 1.19.24.12.38.1.53-.08.14-.17.62-.71.79-.96.17-.25.33-.21.55-.13.22.08 1.41.67 1.65.79.24.12.4.18.46.28.06.11.06.63-.16 1.24z" />
                        </svg>
                        Send via WhatsApp
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Get form values
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const message = document.getElementById('message').value;

        // Format WhatsApp Message
        const waNumber = "{{ config('studio.whatsapp_number', '919285001719') }}".replace(/[^0-9]/g, '');
        const text = `*New Tattoo Enquiry*%0A%0A*Name:* ${name}%0A*Phone:* ${phone}%0A*Email:* ${email}%0A*Design Idea:* ${message}`;

        // Show success message
        document.getElementById('formSuccess').classList.remove('hidden');

        // Open WhatsApp in new tab
        const waUrl = `https://wa.me/${waNumber}?text=${text}`;
        window.open(waUrl, '_blank');

        // Reset form
        this.reset();
    });
</script>
@endpush