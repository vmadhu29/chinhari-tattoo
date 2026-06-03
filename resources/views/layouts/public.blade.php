<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta Tags --}}
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}

    {{-- Preconnects --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.jpg') }}">
    <meta name="theme-color" content="#D4AF37">

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    {{-- FullCalendar --}}
    @stack('head-scripts')

    {{-- Canonical & Robots --}}
    @isset($canonical)
        <link rel="canonical" href="{{ $canonical }}">
    @endisset

    {{-- Schema: LocalBusiness --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": ["LocalBusiness", "TattooParlor"],
        "name": "Chinhari Tattoo Studio",
        "description": "Premium tattoo studio in Raipur, Chhattisgarh offering custom tattoo designs by award-winning artists.",
        "url": "{{ config('app.url') }}",
        "telephone": "{{ config('studio.phone') }}",
        "email": "{{ config('studio.email') }}",
        "address": {
            "@@type": "PostalAddress",
            "streetAddress": "Chinhari Tattoo Studio",
            "addressLocality": "Raipur",
            "addressRegion": "Chhattisgarh",
            "postalCode": "492001",
            "addressCountry": "IN"
        },
        "geo": { "@@type": "GeoCoordinates", "latitude": 21.2514, "longitude": 81.6296 },
        "openingHours": "Mo-Su 10:00-21:00",
        "priceRange": "₹₹₹",
        "image": "{{ asset('images/og-default.jpg') }}",
        "sameAs": [
            "{{ config('studio.instagram') }}",
            "{{ config('studio.facebook') }}",
            "{{ config('studio.youtube') }}"
        ]
    }
    </script>

    <style>
        /* Critical CSS for above-the-fold */
        #page-loader {
            position: fixed; inset: 0; z-index: 9999;
            background: #FFFFFF;
            display: flex; align-items: center; justify-content: center;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }
        #page-loader.hidden { opacity: 0; visibility: hidden; }
        .loader-logo {
            animation: loaderPulse 1.5s ease-in-out infinite;
        }
        @@keyframes loaderPulse {
            0%, 100% { opacity: 0.4; transform: scale(0.98); }
            50%       { opacity: 1; transform: scale(1); }
        }
    </style>
</head>

<body class="bg-studio-black text-studio-gray min-h-screen overflow-x-hidden">

    {{-- Cinematic Page Loader --}}
    <div id="page-loader" role="status" aria-label="Loading">
        <div class="text-center">
            <div class="loader-logo w-24 h-24 mx-auto mb-4 rounded-xl overflow-hidden border border-gold/30 shadow-gold bg-black flex items-center justify-center">
                <img src="{{ asset('images/logo.jpg') }}" alt="Chinhari Tattoo Logo" class="w-full h-full object-cover">
            </div>
            <div class="w-32 h-px bg-gradient-to-r from-transparent via-gold to-transparent mx-auto animate-pulse"></div>
            <p class="text-studio-muted text-xs tracking-widest uppercase mt-3 font-semibold">Chinhari Tattoo</p>
        </div>
    </div>

    {{-- Background ambient glow --}}
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-gold/3 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-crimson/3 rounded-full blur-3xl"></div>
    </div>

    {{-- ═══════════════════════ NAVIGATION ═══════════════════════ --}}
    <header
        id="main-nav"
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
        x-data="{ mobileOpen: false, scrolled: false }"
        x-init="
            window.addEventListener('scroll', () => {
                scrolled = window.scrollY > 50;
            })
        "
        :class="scrolled ? 'glass-nav py-3' : 'py-5 bg-transparent'"
        role="navigation"
        aria-label="Main navigation"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group" aria-label="Chinhari Tattoo Studio">
                    <div class="relative">
                        <div class="w-12 h-12 rounded-xl overflow-hidden border border-gold/30 flex items-center justify-center group-hover:shadow-gold-sm transition-all duration-300 shadow-sm bg-black">
                            <img src="{{ asset('images/logo.jpg') }}" alt="Chinhari Tattoo Logo" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div>
                        <div class="font-display text-xl tracking-[0.15em] transition-colors duration-300 leading-none font-bold group-hover:text-gold"
                             :class="(scrolled || !@json(request()->routeIs('home'))) ? 'text-studio-white' : 'text-white'">CHINHARI</div>
                        <div class="text-[9px] tracking-[0.35em] uppercase leading-none mt-1 transition-colors duration-300"
                             :class="(scrolled || !@json(request()->routeIs('home'))) ? 'text-studio-muted' : 'text-white/60'">Tattoo Studio · Raipur</div>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <nav class="hidden lg:flex items-center gap-1" aria-label="Primary">
                    @php
                        $navItems = [
                            ['route' => 'home',      'label' => 'Home'],
                            ['route' => 'about',     'label' => 'About'],
                            ['route' => 'artists',   'label' => 'Artists'],
                            ['route' => 'portfolio', 'label' => 'Portfolio'],
                            ['route' => 'pricing',   'label' => 'Pricing'],
                            ['route' => 'blog',      'label' => 'Blog'],
                            ['route' => 'contact',   'label' => 'Contact'],
                        ];
                    @endphp

                    @foreach($navItems as $item)
                        <a
                            href="{{ route($item['route']) }}"
                            class="px-4 py-2 text-sm font-medium tracking-wide rounded-lg transition-all duration-200 link-underline"
                            :class="[
                                @json(request()->routeIs($item['route'])) ? 'text-gold' : '',
                                !@json(request()->routeIs($item['route'])) ? ((scrolled || !@json(request()->routeIs('home'))) ? 'text-studio-gray hover:text-studio-white' : 'text-white/80 hover:text-white') : ''
                            ]"
                        >
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>

                {{-- CTA Group --}}
                <div class="hidden lg:flex items-center gap-3">
                    @auth
                        <a href="{{ route('customer.dashboard') }}" class="btn-ghost text-sm px-4 py-2" :class="(scrolled || !@json(request()->routeIs('home'))) ? 'text-studio-gray hover:text-studio-white' : 'text-white/80 hover:text-white'">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-ghost text-sm px-4 py-2" :class="(scrolled || !@json(request()->routeIs('home'))) ? 'text-studio-gray hover:text-studio-white' : 'text-white/80 hover:text-white'">Login</a>
                    @endauth

                    <a
                        href="{{ route('booking.create') }}"
                        id="nav-book-btn"
                        class="btn-gold btn-sm group"
                    >
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Book Appointment
                    </a>
                </div>

                {{-- Mobile Hamburger --}}
                <button
                    @click="mobileOpen = !mobileOpen"
                    class="lg:hidden w-10 h-10 flex flex-col items-center justify-center gap-1.5 group"
                    :aria-expanded="mobileOpen"
                    aria-controls="mobile-menu"
                    aria-label="Toggle menu"
                >
                    <span class="w-6 h-0.5 group-hover:bg-gold transition-all duration-300"
                          :class="[
                              mobileOpen ? 'rotate-45 translate-y-2' : '',
                              (!mobileOpen && (scrolled || !@json(request()->routeIs('home')))) ? 'bg-studio-gray' : 'bg-white'
                          ]"></span>
                    <span class="w-6 h-0.5 group-hover:bg-gold transition-all duration-300"
                          :class="[
                              mobileOpen ? 'opacity-0' : '',
                              (!mobileOpen && (scrolled || !@json(request()->routeIs('home')))) ? 'bg-studio-gray' : 'bg-white'
                          ]"></span>
                    <span class="w-6 h-0.5 group-hover:bg-gold transition-all duration-300"
                          :class="[
                              mobileOpen ? '-rotate-45 -translate-y-2' : '',
                              (!mobileOpen && (scrolled || !@json(request()->routeIs('home')))) ? 'bg-studio-gray' : 'bg-white'
                          ]"></span>
                </button>
            </div>

            {{-- Mobile Menu --}}
            <div
                id="mobile-menu"
                x-show="mobileOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-4"
                class="lg:hidden mt-4 pb-4 border-t border-studio-border"
            >
                <nav class="flex flex-col gap-1 mt-4" aria-label="Mobile">
                    @foreach($navItems as $item)
                        <a
                            href="{{ route($item['route']) }}"
                            class="px-4 py-3 text-sm font-medium rounded-xl transition-colors duration-200
                                   {{ request()->routeIs($item['route']) ? 'text-gold bg-gold/5' : 'text-studio-gray hover:text-white hover:bg-studio-card' }}"
                            @click="mobileOpen = false"
                        >
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>
                <div class="flex flex-col gap-3 mt-6 px-4">
                    <a href="{{ route('booking.create') }}" class="btn-gold w-full text-center">Book Appointment</a>
                    <a href="https://wa.me/{{ config('studio.whatsapp_number') }}" class="btn-whatsapp w-full text-center" target="_blank" rel="noopener">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        WhatsApp Us
                    </a>
                </div>
            </div>
        </div>
    </header>

    {{-- ═══════════════════════ MAIN CONTENT ═══════════════════════ --}}
    <main id="main-content" role="main">
        @yield('content')
    </main>

    {{-- ═══════════════════════ FOOTER ═══════════════════════ --}}
    <footer class="bg-studio-darker border-t border-studio-border mt-0" role="contentinfo">

        {{-- Pre-footer CTA --}}
        <div class="bg-studio-black py-16 px-4 text-center relative overflow-hidden">
            <div class="absolute inset-0 bg-ink-radial pointer-events-none" aria-hidden="true"></div>
            <div class="relative max-w-3xl mx-auto">
                <div class="section-eyebrow justify-center mb-6">Ready to get inked?</div>
                <h2 class="font-display text-display-md md:text-display-lg text-studio-white mb-6 leading-none tracking-wider">
                    YOUR STORY<br>
                    <span class="text-gold-gradient">DESERVES INK</span>
                </h2>
                <p class="text-studio-muted mb-10 max-w-xl mx-auto">
                    Book a free consultation with our award-winning artists in Raipur and bring your vision to life.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('booking.create') }}" class="btn-gold btn-lg">
                        Book Free Consultation
                    </a>
                    <a href="https://wa.me/{{ config('studio.whatsapp_number') }}?text=Hi! I'd like to book a tattoo appointment." class="btn-outline-gold btn-lg" target="_blank" rel="noopener">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        Chat on WhatsApp
                    </a>
                </div>
            </div>
        </div>

        {{-- Footer Main --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

                {{-- Brand Column --}}
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-xl overflow-hidden border border-gold/30 flex items-center justify-center bg-black">
                            <img src="{{ asset('images/logo.jpg') }}" alt="Chinhari Tattoo Logo" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <div class="font-display text-2xl tracking-[0.15em] text-studio-white leading-none font-bold">CHINHARI</div>
                            <div class="text-[9px] tracking-[0.3em] text-gold uppercase leading-none mt-1">Tattoo Studio</div>
                        </div>
                    </div>
                    <p class="text-studio-muted text-sm leading-relaxed mb-8">
                        Raipur's premium tattoo studio. Custom designs, expert artists, hygienic environment. Your tattoo journey starts here.
                    </p>

                    {{-- Social Links --}}
                    <div class="flex gap-3">
                        @php
                            $socials = [
                                ['href' => config('studio.instagram'), 'label' => 'Instagram', 'icon' => '<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>'],
                                ['href' => config('studio.facebook'),  'label' => 'Facebook',  'icon' => '<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>'],
                                ['href' => config('studio.youtube'),   'label' => 'YouTube',   'icon' => '<path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/>'],
                            ];
                        @endphp
                        @foreach($socials as $social)
                            <a href="{{ $social['href'] }}" target="_blank" rel="noopener noreferrer"
                               aria-label="{{ $social['label'] }}"
                               class="w-10 h-10 rounded-full bg-studio-card border border-studio-border
                                      flex items-center justify-center text-studio-muted
                                      hover:text-gold hover:border-gold/50 hover:bg-gold/5
                                      transition-all duration-300">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">{!! $social['icon'] !!}</svg>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h3 class="text-sm font-semibold tracking-widest uppercase text-studio-white mb-6">Quick Links</h3>
                    <ul class="space-y-3">
                        @foreach([
                            ['route' => 'about',     'label' => 'About Us'],
                            ['route' => 'artists',   'label' => 'Our Artists'],
                            ['route' => 'portfolio', 'label' => 'Portfolio'],
                            ['route' => 'pricing',   'label' => 'Pricing'],
                            ['route' => 'blog',      'label' => 'Blog'],
                            ['route' => 'contact',   'label' => 'Contact Us'],
                        ] as $link)
                            <li>
                                <a href="{{ route($link['route']) }}"
                                   class="text-sm text-studio-muted hover:text-gold transition-colors duration-200 link-underline">
                                    {{ $link['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Tattoo Styles --}}
                <div>
                    <h3 class="text-sm font-semibold tracking-widest uppercase text-studio-white mb-6">Tattoo Styles</h3>
                    <ul class="space-y-3">
                        @foreach(['Realism', 'Portrait', 'Blackwork', 'Tribal', 'Geometric', 'Mandala', 'Neo Traditional', 'Cover Up'] as $style)
                            <li>
                                <a href="{{ route('portfolio', ['style' => Str::slug($style)]) }}"
                                   class="text-sm text-studio-muted hover:text-gold transition-colors duration-200 link-underline">
                                    {{ $style }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Contact & Hours --}}
                <div>
                    <h3 class="text-sm font-semibold tracking-widest uppercase text-studio-white mb-6">Visit Us</h3>
                    <address class="not-italic space-y-4">
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-gold flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <div>
                                <p class="text-sm text-studio-muted leading-relaxed">Chinhari Tattoo Studio<br>Raipur, Chhattisgarh 492001</p>
                                <a href="{{ config('studio.google_maps_url') }}" class="text-xs text-gold hover:text-gold-light mt-1 inline-block" target="_blank" rel="noopener">Get Directions →</a>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-gold flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <div>
                                <a href="tel:{{ config('studio.phone') }}" class="text-sm text-studio-muted hover:text-gold transition-colors">{{ config('studio.phone') }}</a>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-gold flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <div class="text-sm text-studio-muted">
                                <p>Mon – Sunday</p>
                                <p class="text-gold">10:00 AM – 9:00 PM</p>
                            </div>
                        </div>
                    </address>
                </div>
            </div>
        </div>

        {{-- Footer Bottom --}}
        <div class="border-t border-studio-border py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs text-studio-faint">
                    © {{ date('Y') }} Chinhari Tattoo Studio. All rights reserved. Raipur, Chhattisgarh.
                </p>
                <div class="flex gap-6">
                    <a href="{{ route('privacy') }}" class="text-xs text-studio-faint hover:text-gold transition-colors">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="text-xs text-studio-faint hover:text-gold transition-colors">Terms of Service</a>
                    <a href="{{ route('sitemap') }}" class="text-xs text-studio-faint hover:text-gold transition-colors">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    {{-- ═══════════════════════ FLOATING ELEMENTS ═══════════════════════ --}}

    {{-- WhatsApp Float Button --}}
    <a
        href="https://wa.me/{{ config('studio.whatsapp_number') }}?text=Hi! I'd like to know more about tattoo services."
        class="whatsapp-float"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Chat on WhatsApp"
        id="whatsapp-float"
    >
        <svg class="w-7 h-7 text-white fill-current" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
        </svg>
    </a>

    {{-- Back to Top --}}
    <button
        id="back-to-top"
        class="fixed bottom-24 right-6 z-40 w-10 h-10 rounded-full bg-studio-card border border-studio-border
               text-studio-muted hover:text-gold hover:border-gold/50
               flex items-center justify-center transition-all duration-300
               opacity-0 invisible translate-y-4"
        aria-label="Back to top"
    >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
    </button>

    {{-- Flash Messages --}}
    @if(session('success') || session('error') || session('warning'))
        <div
            id="flash-message"
            class="fixed top-24 right-4 z-50 max-w-sm"
            x-data="{ show: true }"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-8"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-8"
            x-init="setTimeout(() => show = false, 5000)"
            role="alert"
            aria-live="polite"
        >
            @if(session('success'))
                <div class="card border-green-500/30 p-4 flex items-start gap-3">
                    <div class="w-5 h-5 rounded-full bg-green-500/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <p class="text-sm text-studio-gray">{{ session('success') }}</p>
                    <button @click="show = false" class="ml-auto text-studio-faint hover:text-studio-white flex-shrink-0" aria-label="Dismiss">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="card border-crimson/30 p-4 flex items-start gap-3">
                    <div class="w-5 h-5 rounded-full bg-crimson/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-crimson-light" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <p class="text-sm text-studio-gray">{{ session('error') }}</p>
                    <button @click="show = false" class="ml-auto text-studio-faint hover:text-studio-white flex-shrink-0" aria-label="Dismiss">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif
        </div>
    @endif

    @livewireScripts
    @stack('scripts')

    <script>
        // ── Page Loader ──
        window.addEventListener('load', () => {
            const loader = document.getElementById('page-loader');
            if (loader) {
                setTimeout(() => loader.classList.add('hidden'), 400);
            }
        });

        // ── Back to Top ──
        const backToTop = document.getElementById('back-to-top');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                backToTop.classList.remove('opacity-0', 'invisible', 'translate-y-4');
            } else {
                backToTop.classList.add('opacity-0', 'invisible', 'translate-y-4');
            }
        });
        backToTop?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

        // ── Scroll Reveal (IntersectionObserver) ──
        const reveals = document.querySelectorAll('[data-reveal]');
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const delay = entry.target.dataset.delay || 0;
                    setTimeout(() => {
                        entry.target.classList.add('animate-fade-up', 'animate-fill-forwards');
                        entry.target.style.opacity = '1';
                    }, parseInt(delay));
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        reveals.forEach(el => {
            el.style.opacity = '0';
            revealObserver.observe(el);
        });

        // ── Counter Animation ──
        function animateCounter(el) {
            const target = parseInt(el.dataset.target);
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;
            const timer = setInterval(() => {
                current = Math.min(current + step, target);
                el.textContent = Math.floor(current).toLocaleString('en-IN');
                if (current >= target) clearInterval(timer);
            }, 16);
        }

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('[data-counter]').forEach(el => counterObserver.observe(el));
    </script>
</body>
</html>
