<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Artist;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Booking;
use App\Models\User;
use App\Models\Branch;
use Carbon\Carbon;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingWizard extends Component
{
    use WithFileUploads;

    public $step = 1;

    // Step 1: Artist & Service
    public $categories = [];
    public $services = [];
    public $artists = [];
    public $selectedCategory = null;
    public $selectedService = null;
    public $selectedArtist = null;

    // Step 2: Date & Time
    public $selectedDate = null;
    public $selectedTime = null;
    public $availableSlots = [];

    // Step 3: Details & Consent
    public $name = '';
    public $email = '';
    public $phone = '';
    public $placement = '';
    public $size = '';
    public $color_type = 'black-grey';
    public $description = '';
    public $reference_images = [];
    public $consent_age = false;
    public $consent_health = false;

    // Step 4: Payment & Review
    public $deposit_amount = 0;
    public $razorpay_order_id = null;
    public $razorpay_key = null;

    protected $listeners = ['paymentCompleted'];

    public function mount()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $this->name = $user->name;
            $this->email = $user->email;
            $this->phone = $user->phone;
        }

        $this->categories = ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();
        $this->artists = Artist::where('is_active', true)->orderBy('sort_order')->get();
        
        $preselectedArtist = request()->get('artist');
        if ($preselectedArtist) {
            $this->selectedArtist = $preselectedArtist;
            $artist = Artist::find($preselectedArtist);
            if ($artist && count($artist->specializations ?? []) > 0) {
                // Find a category matching the artist's first specialization
                $firstSpec = $artist->specializations[0];
                $category = ServiceCategory::where('name', 'LIKE', '%' . $firstSpec . '%')->first();
                if ($category) {
                    $this->selectedCategory = $category->id;
                    $this->services = Service::where('category_id', $category->id)->where('is_active', true)->get();
                }
            }
        }
    }

    public function selectCategory($catId)
    {
        $this->selectedCategory = $catId;
        $this->updatedSelectedCategory($catId);
    }

    public function updatedSelectedCategory($catId)
    {
        $this->services = Service::where('category_id', $catId)->where('is_active', true)->get();
        $this->selectedService = null;
        $this->deposit_amount = 0;
        $this->loadSlots();
    }

    public function selectService($serviceId)
    {
        $this->selectedService = $serviceId;
        $this->updatedSelectedService($serviceId);
    }

    public function updatedSelectedService($serviceId)
    {
        $service = Service::find($serviceId);
        if ($service) {
            $this->deposit_amount = $service->deposit_amount ?? config('studio.deposit_amount', 500);
        } else {
            $this->deposit_amount = 0;
        }
        $this->loadSlots();
    }

    public function updatedSelectedArtist()
    {
        $this->loadSlots();
    }

    public function updatedSelectedDate()
    {
        $this->loadSlots();
    }

    public function loadSlots()
    {
        if ($this->selectedArtist && $this->selectedDate) {
            $artist = Artist::find($this->selectedArtist);
            if ($artist) {
                $date = Carbon::parse($this->selectedDate);
                $duration = 60;
                if ($this->selectedService) {
                    $service = Service::find($this->selectedService);
                    if ($service) {
                        $duration = $service->estimated_duration_minutes;
                    }
                }
                $this->availableSlots = $artist->getAvailableSlots($date, $duration);
            }
        } else {
            $this->availableSlots = [];
        }
    }

    public function nextStep()
    {
        $this->validateStep();
        $this->step++;

        if ($this->step === 4) {
            $this->createRazorpayOrder();
        }
    }

    public function previousStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function validateStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'selectedCategory' => 'required',
                'selectedService' => 'required',
                'selectedArtist' => 'required',
            ], [
                'selectedCategory.required' => 'Please select a style category.',
                'selectedService.required' => 'Please select a service option.',
                'selectedArtist.required' => 'Please choose an artist.',
            ]);
        } elseif ($this->step === 2) {
            $this->validate([
                'selectedDate' => 'required|date|after:today',
                'selectedTime' => 'required',
            ], [
                'selectedDate.required' => 'Please select a date for your appointment.',
                'selectedDate.after' => 'Appointments must be booked for future dates.',
                'selectedTime.required' => 'Please choose an available time slot.',
            ]);
        } elseif ($this->step === 3) {
            $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'placement' => 'required|string|max:255',
                'size' => 'required|string|max:255',
                'description' => 'required|string|min:10',
                'consent_age' => 'accepted',
                'consent_health' => 'accepted',
                'reference_images.*' => 'nullable|image|max:5120',
            ], [
                'name.required' => 'Please enter your name.',
                'email.required' => 'Please enter your email.',
                'phone.required' => 'Please enter your phone number.',
                'placement.required' => 'Tell us where you want the tattoo (e.g. Forearm, Shoulder).',
                'size.required' => 'Specify approximate size (e.g. 3x3 inches).',
                'description.required' => 'Please describe your tattoo idea.',
                'consent_age.accepted' => 'You must confirm that you are 18 years of age or older.',
                'consent_health.accepted' => 'You must declare your skin/health conditions.',
            ]);
        }
    }

    public function createRazorpayOrder()
    {
        try {
            $key = config('services.razorpay.key');
            $secret = config('services.razorpay.secret');

            if (empty($key) || empty($secret)) {
                throw new \Exception('Razorpay credentials not configured.');
            }

            $api = new Api($key, $secret);

            $order = $api->order->create([
                'receipt' => 'rec_' . time(),
                'amount' => $this->deposit_amount * 100, // in paise
                'currency' => 'INR',
            ]);

            $this->razorpay_order_id = $order['id'];
            $this->razorpay_key = $key;
        } catch (\Exception $e) {
            Log::error('Razorpay Order Creation Failed: ' . $e->getMessage());
            session()->flash('error', 'Unable to initialize payment gateway. Please contact the studio.');
            $this->step = 3;
        }
    }

    public function paymentCompleted($paymentId, $razorpayOrderId, $signature)
    {
        try {
            $key = config('services.razorpay.key');
            $secret = config('services.razorpay.secret');
            
            $api = new Api($key, $secret);
            $attributes = [
                'razorpay_order_id' => $razorpayOrderId,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signature
            ];
            
            $api->utility->verifyPaymentSignature($attributes);
        } catch (\Exception $e) {
            Log::error('Razorpay Signature Verification Failed: ' . $e->getMessage());
            $this->addError('payment', 'Payment verification failed. Please try again.');
            return;
        }

        DB::beginTransaction();

        try {
            $user = User::where('email', $this->email)->first();
            if (!$user) {
                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'password' => bcrypt('CHN-' . rand(1000, 9999)),
                    'is_active' => true,
                ]);
                $user->assignRole('customer');
            }

            $uploadedImages = [];
            foreach ($this->reference_images as $image) {
                $path = $image->store('bookings/reference', 'public');
                $uploadedImages[] = $path;
            }

            $branch = Branch::first();
            $service = Service::find($this->selectedService);
            $duration = $service ? $service->estimated_duration_minutes : 60;
            $endTime = Carbon::parse($this->selectedDate . ' ' . $this->selectedTime)->addMinutes($duration)->format('H:i:s');

            $booking = Booking::create([
                'user_id' => $user->id,
                'artist_id' => $this->selectedArtist,
                'branch_id' => $branch->id,
                'service_id' => $this->selectedService,
                'appointment_date' => $this->selectedDate,
                'start_time' => $this->selectedTime,
                'end_time' => $endTime,
                'duration_minutes' => $duration,
                'tattoo_placement' => $this->placement,
                'tattoo_size' => $this->size,
                'color_type' => $this->color_type,
                'customer_requirements' => $this->description,
                'reference_images' => $uploadedImages,
                'status' => 'pending',
                'deposit_amount' => $this->deposit_amount,
                'deposit_paid' => true,
                'deposit_payment_id' => $paymentId,
                'payment_status' => 'paid',
                'consent_signed' => true,
                'medical_declaration_signed' => true,
                'age_verified' => true,
            ]);

            $booking->artist->bookingSlots()->create([
                'slot_date' => $this->selectedDate,
                'start_time' => $this->selectedTime,
                'end_time' => $endTime,
                'status' => 'booked',
                'notes' => 'Online Booking ' . $booking->booking_number,
            ]);

            $booking->addTimelineEvent('payment_received', 'Deposit Paid', "Paid deposit of ₹{$this->deposit_amount} via Razorpay.");
            $booking->addTimelineEvent('created', 'Booking Submitted', 'Booking successfully created and awaiting artist confirmation.');

            DB::commit();

            if (!auth()->check()) {
                auth()->login($user);
            }

            session()->flash('success', 'Booking created successfully! Your slot has been reserved.');
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Booking creation failed: ' . $e->getMessage());
            $this->addError('payment', 'An error occurred while finalizing your booking. Please contact support.');
        }
    }

    public function render()
    {
        return view('livewire.booking-wizard');
    }
}
