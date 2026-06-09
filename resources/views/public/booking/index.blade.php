@extends('layouts.public')

@section('content')
<section class="relative pt-32 pb-8 overflow-hidden bg-studio-black" aria-label="Booking Header">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="flex items-center justify-center gap-4 mb-4">
            <div class="w-8 h-px bg-verli/60"></div>
            <span class="text-verli text-xs tracking-[0.4em] uppercase font-semibold">Reserve Your Session</span>
            <div class="w-8 h-px bg-verli/60"></div>
        </div>
        <h1 class="font-display text-4xl md:text-6xl text-studio-white tracking-wider mb-4">
            BOOK AN <span class="bg-gradient-to-r from-verli to-verli-light bg-clip-text text-transparent">APPOINTMENT</span>
        </h1>
        <p class="text-gray-500 text-sm max-w-xl mx-auto leading-relaxed">
            Fill in your basic details, preferred date, and submit your design ideas to connect with our team directly via WhatsApp.
        </p>
    </div>
</section>

<section class="pb-24 bg-studio-black" aria-label="Booking Form">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        
        {{-- Booking Form Container --}}
        <div id="booking-form-container" class="bg-studio-darker relative rounded-[32px] p-6 md:p-10 shadow-[0_20px_50px_-12px_rgba(255,193,7,0.15)] border border-verli/10">
            <div class="absolute inset-0 bg-gradient-to-br from-verli/10 via-transparent to-transparent rounded-[32px] pointer-events-none"></div>
            <form id="whatsapp-booking-form" class="space-y-6 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-xs font-bold text-studio-muted uppercase tracking-wider mb-2">Full Name *</label>
                        <input type="text" id="name" placeholder="John Doe" required minlength="2" maxlength="100" class="w-full bg-studio-black border border-studio-border/50 rounded-xl px-4 py-3 text-studio-white placeholder-gray-600 focus:outline-none focus:border-verli focus:ring-1 focus:ring-verli transition-colors">
                    </div>
                    
                    {{-- Phone --}}
                    <div>
                        <label for="phone" class="block text-xs font-bold text-studio-muted uppercase tracking-wider mb-2">Phone Number *</label>
                        <input type="tel" id="phone" placeholder="+91 90000 00000" required minlength="10" maxlength="15" pattern="^\+?[0-9\s\-]+$" title="Please enter a valid phone number (10-15 digits)" class="w-full bg-studio-black border border-studio-border/50 rounded-xl px-4 py-3 text-studio-white placeholder-gray-600 focus:outline-none focus:border-verli focus:ring-1 focus:ring-verli transition-colors">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Date --}}
                    <div>
                        <label for="date" class="block text-xs font-bold text-studio-muted uppercase tracking-wider mb-2">Preferred Date</label>
                        <input type="date" id="date" class="w-full bg-studio-black border border-studio-border/50 rounded-xl px-4 py-3 text-studio-white placeholder-gray-600 focus:outline-none focus:border-verli focus:ring-1 focus:ring-verli transition-colors [color-scheme:dark]" min="{{ date('Y-m-d') }}">
                    </div>

                    {{-- Style / Placement --}}
                    <div>
                        <label for="placement" class="block text-xs font-bold text-studio-muted uppercase tracking-wider mb-2">Tattoo Placement</label>
                        <input type="text" id="placement" placeholder="e.g. Forearm, Back" maxlength="100" class="w-full bg-studio-black border border-studio-border/50 rounded-xl px-4 py-3 text-studio-white placeholder-gray-600 focus:outline-none focus:border-verli focus:ring-1 focus:ring-verli transition-colors">
                    </div>
                </div>

                {{-- Idea --}}
                <div>
                    <label for="idea" class="block text-xs font-bold text-studio-muted uppercase tracking-wider mb-2">Tattoo Idea / Description *</label>
                    <textarea id="idea" required rows="4" minlength="10" maxlength="1500" placeholder="Describe your tattoo idea in detail..." class="w-full bg-studio-black border border-studio-border/50 rounded-xl px-4 py-3 text-studio-white placeholder-gray-600 focus:outline-none focus:border-verli focus:ring-1 focus:ring-verli transition-colors"></textarea>
                </div>

                {{-- Submit --}}
                <div class="pt-4">
                    <button type="submit" class="w-full btn-verli py-4 text-sm flex items-center justify-center gap-2 shadow-xl shadow-verli/20 hover:shadow-verli/30 transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        Book via WhatsApp
                    </button>
                    <p class="text-center text-[10px] text-gray-400 mt-3">No payment required until artist confirmation.</p>
                </div>
            </form>
        </div>

        {{-- Success Message (Hidden by default) --}}
        <div id="booking-success" class="hidden bg-studio-darker relative rounded-[32px] p-8 md:p-16 text-center shadow-[0_20px_50px_-12px_rgba(255,193,7,0.15)] border border-verli/10">
            <div class="absolute inset-0 bg-gradient-to-br from-verli/10 via-transparent to-transparent rounded-[32px] pointer-events-none"></div>
            <div class="relative z-10">
                <div class="w-16 h-16 rounded-full bg-verli/10 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-verli" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h2 class="text-2xl font-serif text-studio-white mb-2">Request Sent!</h2>
                <p class="text-studio-gray mb-6 leading-relaxed max-w-md mx-auto">
                    Thank you for your booking request. A new tab has opened in WhatsApp to continue our conversation. Our team will manually review your details and lock in your slot directly via chat.
                </p>
                <button onclick="window.location.reload()" class="btn-outline-verli inline-block">Book Another Appointment</button>
            </div>
        </div>

    </div>
</section>

@push('scripts')
<script>
    document.getElementById('whatsapp-booking-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const name = document.getElementById('name').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const date = document.getElementById('date').value;
        const placement = document.getElementById('placement').value.trim();
        const idea = document.getElementById('idea').value.trim();

        // Build the message
        let message = `Hello Chinhari Tattoo Studio! I would like to request an appointment.\n\n`;
        message += `*Name:* ${name}\n`;
        message += `*Phone:* ${phone}\n`;
        
        if(date) {
            message += `*Preferred Date:* ${date}\n`;
        }
        if(placement) {
            message += `*Tattoo Placement:* ${placement}\n`;
        }
        
        message += `\n*Tattoo Idea:*\n${idea}`;

        // Get WhatsApp number from config
        const waNumber = '{{ config('studio.whatsapp_number') }}';
        
        // Encode message
        const encodedMessage = encodeURIComponent(message);
        
        // Open WhatsApp in new tab
        window.open(`https://wa.me/${waNumber}?text=${encodedMessage}`, '_blank');

        // Hide form and show success message
        document.getElementById('booking-form-container').classList.add('hidden');
        document.getElementById('booking-success').classList.remove('hidden');
    });
</script>
@endpush
@endsection
