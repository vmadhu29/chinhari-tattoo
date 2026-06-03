@extends('layouts.public')

@section('content')
<section class="relative pt-32 pb-16 overflow-hidden bg-studio-darker" aria-label="Contact Header">
    <div class="absolute inset-0 bg-ink-radial pointer-events-none" aria-hidden="true"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="flex items-center justify-center gap-4 mb-4">
            <div class="w-8 h-px bg-gold/60"></div>
            <span class="text-gold text-xs tracking-[0.4em] uppercase font-semibold">GET IN TOUCH</span>
            <div class="w-8 h-px bg-gold/60"></div>
        </div>
        <h1 class="font-display text-5xl md:text-7xl text-studio-white tracking-wider mb-6">
            CONTACT <span class="text-gold-gradient">US</span>
        </h1>
        <p class="text-studio-muted text-lg max-w-2xl mx-auto leading-relaxed">
            Have questions or want to discuss a custom design? Message us directly or visit our studio in Raipur, Chhattisgarh.
        </p>
    </div>
</section>

<section class="py-20 bg-studio-black border-t border-studio-border" aria-labelledby="inquiry-heading">
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
                        <div class="w-12 h-12 rounded-xl bg-gold/10 border border-gold/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <p class="text-studio-white font-semibold mb-1">Phone Call</p>
                            <a href="tel:{{ config('studio.phone') }}" class="text-studio-muted text-sm hover:text-gold transition-colors font-medium">
                                {{ config('studio.phone') }}
                            </a>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start">
                        <div class="w-12 h-12 rounded-xl bg-gold/10 border border-gold/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <div>
                            <p class="text-studio-white font-semibold mb-1">WhatsApp Chat</p>
                            <a href="https://wa.me/{{ config('studio.whatsapp_number') }}?text=Hi! I want to consult on a tattoo idea." target="_blank" rel="noopener" class="text-gold text-sm hover:text-gold-light transition-colors font-medium">
                                Chat with us →
                            </a>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start">
                        <div class="w-12 h-12 rounded-xl bg-gold/10 border border-gold/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-studio-white font-semibold mb-1">Opening Hours</p>
                            <p class="text-studio-muted text-sm">Mon – Sun: <span class="text-gold">10:00 AM – 9:00 PM</span></p>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-studio-border">
                    <p class="text-xs text-studio-faint uppercase mb-3 tracking-widest font-semibold">Social Connect</p>
                    <div class="flex gap-3">
                        <a href="{{ config('studio.instagram') }}" target="_blank" rel="noopener" class="px-4 py-2 border border-studio-border rounded-lg text-xs hover:border-gold hover:text-gold transition-all duration-300 bg-studio-darker">Instagram</a>
                        <a href="{{ config('studio.facebook') }}" target="_blank" rel="noopener" class="px-4 py-2 border border-studio-border rounded-lg text-xs hover:border-gold hover:text-gold transition-all duration-300 bg-studio-darker">Facebook</a>
                        <a href="{{ config('studio.youtube') }}" target="_blank" rel="noopener" class="px-4 py-2 border border-studio-border rounded-lg text-xs hover:border-gold hover:text-gold transition-all duration-300 bg-studio-darker">YouTube</a>
                    </div>
                </div>
            </div>

            {{-- Custom Inquiry Form --}}
            <div class="card p-8 rounded-2xl border border-studio-border bg-studio-darker" data-reveal data-delay="150">
                <h3 class="text-studio-white font-semibold text-xl mb-6">Send an Inquiry</h3>
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-xs uppercase tracking-wider text-studio-muted mb-2 font-semibold">Full Name</label>
                        <input type="text" id="name" name="name" required class="w-full bg-studio-black border border-studio-border rounded-lg px-4 py-3 text-sm text-white focus:outline-none focus:border-gold">
                    </div>
                    <div>
                        <label for="email" class="block text-xs uppercase tracking-wider text-studio-muted mb-2 font-semibold">Email Address</label>
                        <input type="email" id="email" name="email" required class="w-full bg-studio-black border border-studio-border rounded-lg px-4 py-3 text-sm text-white focus:outline-none focus:border-gold">
                    </div>
                    <div>
                        <label for="phone" class="block text-xs uppercase tracking-wider text-studio-muted mb-2 font-semibold">Phone Number</label>
                        <input type="tel" id="phone" name="phone" required class="w-full bg-studio-black border border-studio-border rounded-lg px-4 py-3 text-sm text-white focus:outline-none focus:border-gold">
                    </div>
                    <div>
                        <label for="message" class="block text-xs uppercase tracking-wider text-studio-muted mb-2 font-semibold">Describe your design idea</label>
                        <textarea id="message" name="message" rows="4" required placeholder="Size, style, body placement, etc." class="w-full bg-studio-black border border-studio-border rounded-lg px-4 py-3 text-sm text-white focus:outline-none focus:border-gold"></textarea>
                    </div>
                    <button type="submit" class="btn-gold w-full py-3 text-center text-sm font-semibold rounded-lg">Submit Message</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
