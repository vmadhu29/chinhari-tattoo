<div class="max-w-4xl mx-auto px-4 py-8 relative">

    {{-- Progress Indicators --}}
    <div class="mb-12" aria-label="Booking Progress">
        <div class="flex items-center justify-between relative">
            {{-- Background track line --}}
            <div class="absolute left-0 right-0 top-1/2 -translate-y-1/2 h-0.5 bg-studio-border z-0" aria-hidden="true"></div>
            {{-- Active track line --}}
            <div class="absolute left-0 top-1/2 -translate-y-1/2 h-0.5 bg-verli transition-all duration-500 z-0" 
                 style="width: {{ (($step - 1) / 3) * 100 }}%" aria-hidden="true"></div>

            @foreach([
                1 => ['label' => 'Artist & Style', 'icon' => '🎨'],
                2 => ['label' => 'Schedule', 'icon' => '🗓️'],
                3 => ['label' => 'Consultation Details', 'icon' => '✏️'],
                4 => ['label' => 'Reserve Slot', 'icon' => '💳']
            ] as $s => $info)
                <div class="flex flex-col items-center relative z-10">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 transition-all duration-300
                                {{ $step === $s ? 'bg-verli border-verli text-studio-black shadow-verli-sm font-semibold' : ($step > $s ? 'bg-white border-verli text-verli font-medium' : 'bg-white border-studio-border text-studio-muted') }}">
                        <span class="text-sm">{{ $info['icon'] }}</span>
                    </div>
                    <span class="text-[10px] uppercase tracking-wider mt-2 font-medium hidden sm:block
                                 {{ $step === $s ? 'text-verli' : ($step > $s ? 'text-studio-white' : 'text-studio-faint') }}">
                        {{ $info['label'] }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Form Content Card --}}
    <div class="card bg-studio-darker border border-studio-border p-6 sm:p-10 rounded-2xl shadow-card min-h-[400px] flex flex-col justify-between">
        
        <div>
            @if(session()->has('error'))
                <div class="mb-6 p-4 bg-crimson/10 border border-crimson/30 rounded-xl text-crimson-light text-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{-- ════════════════════════ STEP 1 ════════════════════════ --}}
            @if($step === 1)
                <div class="space-y-8 animate-fade-in">
                    <div>
                        <h2 class="font-display text-2xl sm:text-3xl text-studio-white tracking-wider mb-2">CHOOSE YOUR STYLE & ARTIST</h2>
                        <p class="text-studio-muted text-sm">Select the tattoo category, specific service, and preferred artist for your custom tattoo.</p>
                    </div>

                    {{-- Category Selection --}}
                    <div class="space-y-3">
                        <label class="block text-xs uppercase tracking-widest text-studio-faint font-semibold">1. Select Style Category</label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            @foreach($categories as $cat)
                                <button 
                                    type="button"
                                    wire:click="selectCategory({{ $cat->id }})"
                                    class="p-4 rounded-xl border text-center flex flex-col items-center justify-center gap-2 transition-all duration-300
                                           {{ $selectedCategory == $cat->id ? 'border-verli bg-verli/5 text-verli shadow-verli-sm' : 'border-studio-border bg-white text-studio-gray hover:border-studio-muted hover:text-studio-white' }}"
                                >
                                    <span class="text-2xl">{{ $cat->icon }}</span>
                                    <span class="text-xs font-medium tracking-wide leading-tight">{{ $cat->name }}</span>
                                </button>
                            @endforeach
                        </div>
                        @error('selectedCategory') <span class="text-xs text-crimson-light">{{ $message }}</span> @enderror
                    </div>

                    {{-- Service Option Selection --}}
                    @if(!empty($services))
                        <div class="space-y-3">
                            <label class="block text-xs uppercase tracking-widest text-studio-faint font-semibold">2. Select Service Option</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($services as $serv)
                                    <button 
                                        type="button"
                                        wire:click="selectService({{ $serv->id }})"
                                        class="p-4 rounded-xl border text-left flex flex-col justify-between gap-2 transition-all duration-300 bg-studio-black
                                               {{ $selectedService == $serv->id ? 'border-verli bg-verli/5 text-verli' : 'border-studio-border text-studio-gray hover:border-studio-muted hover:text-studio-white' }}"
                                    >
                                        <div>
                                            <h4 class="font-semibold text-sm {{ $selectedService == $serv->id ? 'text-verli' : 'text-studio-white' }}">{{ $serv->name }}</h4>
                                            <p class="text-xs text-studio-muted mt-1 leading-relaxed">{{ $serv->short_description }}</p>
                                        </div>
                                        <div class="flex justify-between items-center w-full pt-3 border-t border-studio-border/20 text-xs">
                                            <span class="text-studio-faint">Deposit: ₹{{ number_format($serv->deposit_amount) }}</span>
                                            <span class="font-semibold text-verli">Est. {{ $serv->estimated_duration_minutes }} mins</span>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                            @error('selectedService') <span class="text-xs text-crimson-light">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    {{-- Artist Selection --}}
                    <div class="space-y-3">
                        <label class="block text-xs uppercase tracking-widest text-studio-faint font-semibold">3. Select Tattoo Artist</label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            @foreach($artists as $art)
                                <button 
                                    type="button"
                                    wire:click="$set('selectedArtist', {{ $art->id }})"
                                    wire:click.after="loadSlots"
                                    class="p-4 rounded-xl border text-left flex items-center gap-4 transition-all duration-300 bg-studio-black
                                           {{ $selectedArtist == $art->id ? 'border-verli bg-verli/5 text-verli' : 'border-studio-border text-studio-gray hover:border-studio-muted hover:text-studio-white' }}"
                                >
                                    <img src="{{ $art->profile_photo_url }}" alt="{{ $art->display_name }}" class="w-12 h-12 rounded-full object-cover border border-studio-border">
                                    <div>
                                        <h4 class="font-semibold text-sm {{ $selectedArtist == $art->id ? 'text-verli' : 'text-studio-white' }}">{{ $art->display_name }}</h4>
                                        <p class="text-[10px] text-studio-muted uppercase mt-0.5 tracking-wider">{{ $art->experience_years }}+ Yrs Exp</p>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                        @error('selectedArtist') <span class="text-xs text-crimson-light">{{ $message }}</span> @enderror
                    </div>
                </div>
            @endif

            {{-- ════════════════════════ STEP 2 ════════════════════════ --}}
            @if($step === 2)
                <div class="space-y-8 animate-fade-in">
                    <div>
                        <h2 class="font-display text-2xl sm:text-3xl text-studio-white tracking-wider mb-2">CHOOSE DATE & TIME</h2>
                        <p class="text-studio-muted text-sm">Select an available date and preferred session slot from your chosen artist's calendar.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Date Selection --}}
                        <div class="space-y-3">
                            <label for="date-picker" class="block text-xs uppercase tracking-widest text-studio-faint font-semibold">1. Select Appointment Date</label>
                            <input 
                                type="date" 
                                id="date-picker"
                                wire:model.live="selectedDate" 
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                max="{{ date('Y-m-d', strtotime('+60 days')) }}"
                                class="w-full bg-white border border-studio-border rounded-xl px-4 py-3.5 text-sm text-studio-white focus:outline-none focus:border-verli"
                            >
                            @error('selectedDate') <span class="text-xs text-crimson-light">{{ $message }}</span> @enderror
                        </div>

                        {{-- Time Slot Selection --}}
                        <div class="space-y-3">
                            <label class="block text-xs uppercase tracking-widest text-studio-faint font-semibold">2. Choose Time Slot</label>
                            
                            @if(empty($selectedDate) || empty($selectedArtist))
                                <div class="p-6 border border-dashed border-studio-border rounded-xl text-center text-xs text-studio-faint bg-studio-black">
                                    Please select a date and artist to load available slots.
                                </div>
                            @elseif(empty($availableSlots))
                                <div class="p-6 border border-dashed border-studio-border rounded-xl text-center text-xs text-crimson-light bg-studio-black">
                                    No available slots on this date. Try another date.
                                </div>
                            @else
                                <div class="grid grid-cols-2 gap-2 max-h-60 overflow-y-auto pr-1">
                                    @foreach($availableSlots as $slot)
                                        <button 
                                            type="button"
                                            wire:click="$set('selectedTime', '{{ $slot['start'] }}')"
                                            class="py-3.5 text-center text-xs font-semibold rounded-lg border transition-all duration-200 bg-studio-black
                                                   {{ $selectedTime === $slot['start'] ? 'border-verli bg-verli text-studio-black font-bold' : 'border-studio-border text-studio-gray hover:border-studio-muted hover:text-studio-white' }}"
                                        >
                                            {{ date('h:i A', strtotime($slot['start'])) }}
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                            @error('selectedTime') <span class="text-xs text-crimson-light">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            @endif

            {{-- ════════════════════════ STEP 3 ════════════════════════ --}}
            @if($step === 3)
                <div class="space-y-8 animate-fade-in">
                    <div>
                        <h2 class="font-display text-2xl sm:text-3xl text-studio-white tracking-wider mb-2">TATTOO DETAILS & DECLARATIONS</h2>
                        <p class="text-studio-muted text-sm">Provide details about your custom design concept and accept our safety consent forms.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Left Column: Contact & Sizing --}}
                        <div class="space-y-4">
                            <div>
                                <label for="form-name" class="block text-xs uppercase tracking-wider text-studio-muted mb-2 font-semibold">Your Name</label>
                                <input type="text" id="form-name" wire:model.blur="name" required class="w-full bg-white border border-studio-border rounded-lg px-4 py-3 text-sm text-studio-white focus:outline-none focus:border-verli">
                                @error('name') <span class="text-xs text-crimson-light">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="form-email" class="block text-xs uppercase tracking-wider text-studio-muted mb-2 font-semibold">Email</label>
                                    <input type="email" id="form-email" wire:model.blur="email" required class="w-full bg-white border border-studio-border rounded-lg px-4 py-3 text-sm text-studio-white focus:outline-none focus:border-verli">
                                    @error('email') <span class="text-xs text-crimson-light">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="form-phone" class="block text-xs uppercase tracking-wider text-studio-muted mb-2 font-semibold">Phone</label>
                                    <input type="tel" id="form-phone" wire:model.blur="phone" required class="w-full bg-white border border-studio-border rounded-lg px-4 py-3 text-sm text-studio-white focus:outline-none focus:border-verli">
                                    @error('phone') <span class="text-xs text-crimson-light">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="form-placement" class="block text-xs uppercase tracking-wider text-studio-muted mb-2 font-semibold">Placement</label>
                                    <input type="text" id="form-placement" wire:model.blur="placement" placeholder="e.g. Forearm, Chest" required class="w-full bg-white border border-studio-border rounded-lg px-4 py-3 text-sm text-studio-white focus:outline-none focus:border-verli">
                                    @error('placement') <span class="text-xs text-crimson-light">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="form-size" class="block text-xs uppercase tracking-wider text-studio-muted mb-2 font-semibold">Est. Size (Inches)</label>
                                    <input type="text" id="form-size" wire:model.blur="size" placeholder="e.g. 4x4 inches" required class="w-full bg-white border border-studio-border rounded-lg px-4 py-3 text-sm text-studio-white focus:outline-none focus:border-verli">
                                    @error('size') <span class="text-xs text-crimson-light">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs uppercase tracking-wider text-studio-muted mb-2 font-semibold">Color Style</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <button type="button" wire:click="$set('color_type', 'black-grey')" class="py-2.5 rounded-lg border text-xs font-semibold transition-all duration-200 bg-studio-black {{ $color_type === 'black-grey' ? 'border-verli bg-verli/5 text-verli' : 'border-studio-border text-studio-muted' }}">Black & Grey</button>
                                    <button type="button" wire:click="$set('color_type', 'color')" class="py-2.5 rounded-lg border text-xs font-semibold transition-all duration-200 bg-studio-black {{ $color_type === 'color' ? 'border-verli bg-verli/5 text-verli' : 'border-studio-border text-studio-muted' }}">Colored Ink</button>
                                </div>
                            </div>
                        </div>

                        {{-- Right Column: Concept Description & Image Upload --}}
                        <div class="space-y-4">
                            <div>
                                <label for="form-desc" class="block text-xs uppercase tracking-wider text-studio-muted mb-2 font-semibold">Tattoo Concept Description</label>
                                <textarea id="form-desc" wire:model.blur="description" rows="3" required placeholder="Tell us the story behind it, reference details, style modifications..." class="w-full bg-white border border-studio-border rounded-lg px-4 py-3 text-sm text-studio-white focus:outline-none focus:border-verli"></textarea>
                                @error('description') <span class="text-xs text-crimson-light">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs uppercase tracking-wider text-studio-muted mb-2 font-semibold">Reference Images (Max 3)</label>
                                <input type="file" wire:model.live="reference_images" multiple accept="image/*" class="w-full text-xs text-studio-muted border border-dashed border-studio-border rounded-lg p-3 bg-studio-black file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-verli file:text-studio-black hover:file:bg-verli-light file:cursor-pointer">
                                <div class="text-[10px] text-studio-faint mt-1">Accepts PNG, JPG up to 5MB each.</div>
                                
                                {{-- Image Upload Progress & Previews --}}
                                <div wire:loading wire:target="reference_images" class="text-xs text-verli mt-2">Uploading image...</div>
                                @if(!empty($reference_images))
                                    <div class="flex gap-2 mt-3">
                                        @foreach($reference_images as $image)
                                            @if($image->isPreviewable())
                                                <div class="relative w-14 h-14 border border-studio-border rounded overflow-hidden">
                                                    <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                                @error('reference_images.*') <span class="text-xs text-crimson-light">{{ $message }}</span> @enderror
                            </div>

                            {{-- Consent Declarations --}}
                            <div class="space-y-3 pt-3">
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" wire:model.live="consent_age" class="mt-1 border-studio-border rounded text-verli focus:ring-0 focus:ring-offset-0 bg-studio-black">
                                    <span class="text-xs text-studio-muted leading-relaxed">I confirm that I am <strong>18 years of age or older</strong> and possess a valid photo ID.</span>
                                </label>
                                @error('consent_age') <div class="text-[11px] text-crimson-light">{{ $message }}</div> @enderror

                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" wire:model.live="consent_health" class="mt-1 border-studio-border rounded text-verli focus:ring-0 focus:ring-offset-0 bg-studio-black">
                                    <span class="text-xs text-studio-muted leading-relaxed">I declare I do not have active skin conditions (psoriasis, eczema in tattoo zone), hemophilia, or communicable diseases.</span>
                                </label>
                                @error('consent_health') <div class="text-[11px] text-crimson-light">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- ════════════════════════ STEP 4 ════════════════════════ --}}
            @if($step === 4)
                <div class="space-y-8 animate-fade-in" x-data="{
                    initRazorpay() {
                        const options = {
                            key: '{{ $razorpay_key }}',
                            amount: '{{ $deposit_amount * 100 }}',
                            currency: 'INR',
                            name: 'Chinhari Tattoo Studio',
                            description: 'Tattoo Slot Reservation Deposit',
                            order_id: '{{ $razorpay_order_id }}',
                            handler: function (response) {
                                $wire.paymentCompleted(response.razorpay_payment_id, response.razorpay_order_id, response.razorpay_signature);
                            },
                            prefill: {
                                name: '{{ $name }}',
                                email: '{{ $email }}',
                                contact: '{{ $phone }}'
                            },
                            theme: {
                                color: '#D4AF37'
                            }
                        };
                        const rzp = new Razorpay(options);
                        rzp.open();
                    }
                }">
                    <div>
                        <h2 class="font-display text-2xl sm:text-3xl text-studio-white tracking-wider mb-2">REVIEW & CONFIRM</h2>
                        <p class="text-studio-muted text-sm">Review your session outline and complete the slot reservation payment via Razorpay.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Booking Outline --}}
                        <div class="space-y-4">
                            <h3 class="text-studio-white font-semibold text-base border-b border-studio-border/30 pb-2">Session Outline</h3>
                            <table class="w-full text-sm">
                                <tr class="border-b border-studio-border/10">
                                    <td class="py-3 text-studio-faint">Artist</td>
                                    <td class="py-3 text-studio-white text-right font-medium">
                                        {{ \App\Models\Artist::find($selectedArtist)->display_name ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr class="border-b border-studio-border/10">
                                    <td class="py-3 text-studio-faint">Service Category</td>
                                    <td class="py-3 text-studio-white text-right font-medium">
                                        {{ \App\Models\ServiceCategory::find($selectedCategory)->name ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr class="border-b border-studio-border/10">
                                    <td class="py-3 text-studio-faint">Date & Time</td>
                                    <td class="py-3 text-studio-white text-right font-medium">
                                        {{ date('M d, Y', strtotime($selectedDate)) }} at {{ date('h:i A', strtotime($selectedTime)) }}
                                    </td>
                                </tr>
                                <tr class="border-b border-studio-border/10">
                                    <td class="py-3 text-studio-faint">Tattoo Size & Spot</td>
                                    <td class="py-3 text-studio-white text-right font-medium">
                                        {{ $size }} on {{ $placement }}
                                    </td>
                                </tr>
                            </table>
                        </div>

                        {{-- Payment Summary card --}}
                        <div class="card p-6 bg-white border border-studio-border rounded-2xl flex flex-col justify-between text-center">
                            <div>
                                <span class="text-verli text-2xl font-bold uppercase block tracking-wider mb-2">Slot Reservation</span>
                                <p class="text-studio-muted text-xs leading-relaxed max-w-xs mx-auto mb-6">
                                    This deposit secures your slot, booking materials, and planning consultation. The deposit is fully credited to your final bill.
                                </p>
                            </div>
                            <div class="space-y-4">
                                <div class="text-studio-faint text-xs uppercase tracking-widest font-semibold">Reservation Deposit</div>
                                <div class="text-verli font-display text-5xl font-semibold">₹{{ number_format($deposit_amount) }}</div>
                                <div class="text-[10px] text-studio-muted mt-2">* Handled securely via Razorpay</div>
                                
                                @if($razorpay_order_id)
                                    <button 
                                        type="button" 
                                        @click="initRazorpay()" 
                                        class="btn-verli w-full py-4 text-center text-sm font-semibold rounded-xl mt-4 flex items-center justify-center gap-3"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                        Pay Deposit & Book
                                    </button>
                                @else
                                    <div class="py-3 text-center text-xs text-verli animate-pulse">Initializing Payment Order...</div>
                                @endif
                                @error('payment') <div class="text-xs text-crimson-light mt-2">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        {{-- Step Navigation Buttons --}}
        <div class="flex justify-between items-center pt-8 border-t border-studio-border/30 mt-10">
            @if($step > 1 && $step < 4)
                <button 
                    type="button" 
                    wire:click="previousStep" 
                    class="btn-ghost text-sm px-6 py-2.5 flex items-center gap-2"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Previous Step
                </button>
            @else
                <div></div>
            @endif

            @if($step < 4)
                <button 
                    type="button" 
                    wire:click="nextStep" 
                    class="btn-verli px-8 py-3 flex items-center gap-2 text-sm"
                >
                    Continue
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            @endif
        </div>

    </div>

    {{-- Razorpay Checkout script load --}}
    @if($step === 4)
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    @endif
</div>
