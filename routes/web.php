<?php

use App\Http\Controllers\Public\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Public\ArtistController;
use App\Http\Controllers\Public\PortfolioController;
use App\Http\Controllers\Public\BlogController;

// ── Public Website Routes ──
Route::name('home')->get('/', [HomeController::class, 'index']);
Route::get('/about', fn() => view('public.about.index'))->name('about');
Route::get('/artists', [ArtistController::class, 'index'])->name('artists');
Route::get('/artists/{slug}', [ArtistController::class, 'show'])->name('artists.show');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/pricing', fn() => view('public.pricing.index'))->name('pricing');
Route::get('/contact', fn() => view('public.contact.index'))->name('contact');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// ── Booking Routes ──
Route::get('/book', fn() => view('public.booking.index'))->name('booking.create');
Route::post('/book', fn() => redirect()->back())->name('booking.store');

// ── Legal Pages ──
Route::get('/privacy-policy', fn() => view('public.legal.privacy'))->name('privacy');
Route::get('/terms-of-service', fn() => view('public.legal.terms'))->name('terms');
Route::get('/sitemap.xml', fn() => response()->view('sitemap')->header('Content-Type', 'text/xml'))->name('sitemap');

// ── Customer Portal (Authenticated) ──
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/profile', fn() => view('profile'))->name('profile');
});

Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('customer.')->group(function () {
    Route::get('/appointments', fn() => view('customer.appointments.index'))->name('appointments');
    Route::get('/invoices', fn() => view('customer.invoices.index'))->name('invoices');
    Route::get('/wishlist', fn() => view('customer.wishlist.index'))->name('wishlist');
    Route::get('/loyalty', fn() => view('customer.loyalty.index'))->name('loyalty');
});

// ── Admin Panel (Authenticated + Role) ──
Route::middleware(['auth', 'role:super-admin|admin|manager|artist|receptionist'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', fn() => view('admin.dashboard.index'))->name('dashboard');
        Route::get('/bookings', fn() => view('admin.bookings.index'))->name('bookings');
        Route::get('/bookings/calendar', fn() => view('admin.bookings.calendar'))->name('bookings.calendar');
        Route::get('/customers', fn() => view('admin.customers.index'))->name('customers');
        Route::get('/artists', fn() => view('admin.artists.index'))->name('artists');
        Route::get('/portfolio', fn() => view('admin.portfolio.index'))->name('portfolio');
        Route::get('/invoices', fn() => view('admin.invoices.index'))->name('invoices');
        Route::get('/inventory', fn() => view('admin.inventory.index'))->name('inventory');
        Route::get('/crm', fn() => view('admin.crm.index'))->name('crm');
        Route::get('/settings', fn() => view('admin.settings.index'))->name('settings');
    });

// ── API: Slot Availability (for Booking Calendar) ──
Route::get('/api/availability/{artistId}', function (int $artistId, \Illuminate\Http\Request $request) {
    $artist = \App\Models\Artist::findOrFail($artistId);
    $date   = \Carbon\Carbon::parse($request->get('date', today()));
    $duration = (int) $request->get('duration', 60);

    return response()->json([
        'date'   => $date->toDateString(),
        'day'    => $date->format('l'),
        'slots'  => $artist->getAvailableSlots($date, $duration),
        'artist' => [
            'id'         => $artist->id,
            'name'       => $artist->display_name,
            'work_start' => $artist->work_start_time,
            'work_end'   => $artist->work_end_time,
        ],
    ]);
})->name('api.availability');

// ── Auth Routes (Breeze) ──
require __DIR__.'/auth.php';
