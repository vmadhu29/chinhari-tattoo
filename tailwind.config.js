import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './app/Livewire/**/*.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            colors: {
                // Primary Light Backgrounds (Inverted)
                'studio-black':   '#FFFFFF',
                'studio-darker':  '#FAF9F6',
                'studio-dark':    '#F2F0EA',
                'studio-charcoal':'#EBE9E2',
                'studio-card':    '#FFFFFF',
                'studio-border':  '#E6E4DD',
                'studio-hover':   '#F7F6F2',

                // Gold Palette
                'gold': {
                    DEFAULT: '#D4AF37',
                    light:   '#E8C84A',
                    dark:    '#B8961E',
                    muted:   '#8B7327',
                    pale:    '#F5E6A3',
                },

                // Red/Crimson Palette
                'crimson': {
                    DEFAULT: '#8B0000',
                    light:   '#B22222',
                    bright:  '#DC143C',
                    dark:    '#5C0000',
                    muted:   '#6B0000',
                },

                // Text Colors (Inverted!)
                'studio-white':    '#111111',
                'studio-gray':     '#2D2D2D',
                'studio-muted':    '#5C5C5C',
                'studio-faint':    '#888888',
            },

            fontFamily: {
                sans:    ['Inter', ...defaultTheme.fontFamily.sans],
                serif:   ['Cormorant Garamond', ...defaultTheme.fontFamily.serif],
                display: ['Bebas Neue', ...defaultTheme.fontFamily.sans],
                mono:    ['JetBrains Mono', ...defaultTheme.fontFamily.mono],
            },

            fontSize: {
                'display-2xl': ['7rem',   { lineHeight: '1',    letterSpacing: '0.02em' }],
                'display-xl':  ['5rem',   { lineHeight: '1.05', letterSpacing: '0.02em' }],
                'display-lg':  ['3.75rem',{ lineHeight: '1.1',  letterSpacing: '0.02em' }],
                'display-md':  ['3rem',   { lineHeight: '1.2',  letterSpacing: '0.02em' }],
                'display-sm':  ['2.25rem',{ lineHeight: '1.25', letterSpacing: '0.01em' }],
            },

            backgroundImage: {
                'gold-gradient':     'linear-gradient(135deg, #D4AF37 0%, #F5E6A3 50%, #D4AF37 100%)',
                'crimson-gradient':  'linear-gradient(135deg, #8B0000 0%, #B22222 100%)',
                'dark-gradient':     'linear-gradient(180deg, #FFFFFF 0%, #FAF9F6 100%)',
                'card-gradient':     'linear-gradient(135deg, #FFFFFF 0%, #FAF9F6 100%)',
                'hero-gradient':     'linear-gradient(180deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.5) 60%, #FFFFFF 100%)',
                'ink-radial':        'radial-gradient(ellipse at center, rgba(212,175,55,0.05) 0%, transparent 70%)',
            },

            boxShadow: {
                'gold':     '0 0 20px rgba(212, 175, 55, 0.2), 0 0 60px rgba(212, 175, 55, 0.05)',
                'gold-sm':  '0 0 10px rgba(212, 175, 55, 0.1)',
                'gold-lg':  '0 0 40px rgba(212, 175, 55, 0.3), 0 0 100px rgba(212, 175, 55, 0.1)',
                'crimson':  '0 0 20px rgba(139, 0, 0, 0.2)',
                'card':     '0 4px 20px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.02)',
                'card-hover': '0 10px 30px rgba(0, 0, 0, 0.08), 0 0 15px rgba(212, 175, 55, 0.1)',
                'glass':    '0 8px 32px rgba(0, 0, 0, 0.04)',
                'inset-gold': 'inset 0 1px 0 rgba(212, 175, 55, 0.1)',
            },

            backdropBlur: {
                'xs': '2px',
            },

            animation: {
                'fade-in':        'fadeIn 0.6s ease-out forwards',
                'fade-up':        'fadeUp 0.6s ease-out forwards',
                'slide-in-left':  'slideInLeft 0.6s ease-out forwards',
                'slide-in-right': 'slideInRight 0.6s ease-out forwards',
                'float':          'float 6s ease-in-out infinite',
                'shimmer':        'shimmer 2s linear infinite',
                'pulse-gold':     'pulseGold 2s ease-in-out infinite',
                'glow-pulse':     'glowPulse 3s ease-in-out infinite',
                'ink-spread':     'inkSpread 1s ease-out forwards',
                'text-flicker':   'textFlicker 3s ease-in-out infinite',
                'border-glow':    'borderGlow 2s ease-in-out infinite',
                'scale-in':       'scaleIn 0.4s ease-out forwards',
                'count-up':       'countUp 2s ease-out forwards',
            },

            keyframes: {
                fadeIn: {
                    from: { opacity: '0' },
                    to:   { opacity: '1' },
                },
                fadeUp: {
                    from: { opacity: '0', transform: 'translateY(30px)' },
                    to:   { opacity: '1', transform: 'translateY(0)' },
                },
                slideInLeft: {
                    from: { opacity: '0', transform: 'translateX(-40px)' },
                    to:   { opacity: '1', transform: 'translateX(0)' },
                },
                slideInRight: {
                    from: { opacity: '0', transform: 'translateX(40px)' },
                    to:   { opacity: '1', transform: 'translateX(0)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%':      { transform: 'translateY(-12px)' },
                },
                shimmer: {
                    '0%':   { backgroundPosition: '-200% center' },
                    '100%': { backgroundPosition: '200% center' },
                },
                pulseGold: {
                    '0%, 100%': { boxShadow: '0 0 10px rgba(212,175,55,0.2)' },
                    '50%':      { boxShadow: '0 0 30px rgba(212,175,55,0.5)' },
                },
                glowPulse: {
                    '0%, 100%': { opacity: '0.6' },
                    '50%':      { opacity: '1' },
                },
                inkSpread: {
                    from: { transform: 'scale(0)', opacity: '0.8' },
                    to:   { transform: 'scale(3)', opacity: '0' },
                },
                textFlicker: {
                    '0%, 19%, 21%, 23%, 25%, 54%, 56%, 100%': { opacity: '1' },
                    '20%, 24%, 55%': { opacity: '0.4' },
                },
                borderGlow: {
                    '0%, 100%': { borderColor: 'rgba(212,175,55,0.3)' },
                    '50%':      { borderColor: 'rgba(212,175,55,0.7)' },
                },
                scaleIn: {
                    from: { transform: 'scale(0.9)', opacity: '0' },
                    to:   { transform: 'scale(1)', opacity: '1' },
                },
                countUp: {
                    from: { opacity: '0', transform: 'translateY(20px)' },
                    to:   { opacity: '1', transform: 'translateY(0)' },
                },
            },

            transitionTimingFunction: {
                'smooth': 'cubic-bezier(0.4, 0, 0.2, 1)',
                'bounce-soft': 'cubic-bezier(0.34, 1.56, 0.64, 1)',
            },

            spacing: {
                '18': '4.5rem',
                '88': '22rem',
                '100': '25rem',
                '112': '28rem',
                '128': '32rem',
            },

            borderRadius: {
                '4xl': '2rem',
                '5xl': '2.5rem',
            },

            zIndex: {
                '60': '60',
                '70': '70',
                '80': '80',
                '90': '90',
            },

            screens: {
                'xs': '475px',
            },
        },
    },

    plugins: [
        forms,
        typography,
    ],
};
