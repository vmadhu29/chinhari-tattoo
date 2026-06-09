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
                // Dark Backgrounds
                'studio-black':   '#0A0A0A',
                'studio-darker':  '#121212',
                'studio-dark':    '#1A1A1A',
                'studio-charcoal':'#242424',
                'studio-card':    '#1E1E1E',
                'studio-border':  'rgba(245, 176, 65, 0.15)',
                'studio-hover':   'rgba(245, 176, 65, 0.05)',

                // Gold Palette (Matched to logo)
                'verli': {
                    DEFAULT: '#FFC107',
                    light:   '#FFD54F',
                    bright:  '#FFECB3',
                    dark:    '#FFA000',
                    muted:   '#FF8F00',
                    pale:    '#FFF8E1',
                    faint:   '#FFFCF4',
                },

                // Aliases
                'crimson': {
                    DEFAULT: '#FFC107',
                    light:   '#FFD54F',
                    bright:  '#FFECB3',
                    dark:    '#FFA000',
                    muted:   '#FF8F00',
                },

                'gold': {
                    DEFAULT: '#FFC107',
                    light:   '#FFD54F',
                    dark:    '#FFA000',
                    muted:   '#FF8F00',
                    pale:    '#FFF8E1',
                },

                // Text Colors
                'studio-white':    '#FFFFFF',
                'studio-gray':     '#D1D5DB', // Gray-300
                'studio-muted':    'rgba(255, 255, 255, 0.7)',
                'studio-faint':    'rgba(255, 255, 255, 0.45)',
            },

            fontFamily: {
                sans:    ['Inter', 'Poppins', ...defaultTheme.fontFamily.sans],
                serif:   ['Cormorant Garamond', ...defaultTheme.fontFamily.serif],
                display: ['Cormorant Garamond', ...defaultTheme.fontFamily.serif],
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
                'verli-gradient':    'linear-gradient(135deg, #FFC107 0%, #FFD54F 50%, #FFC107 100%)',
                'gold-gradient':     'linear-gradient(135deg, #FFC107 0%, #FFD54F 50%, #FFC107 100%)',
                'crimson-gradient':  'linear-gradient(135deg, #FFA000 0%, #FFC107 100%)',
                'dark-gradient':     'linear-gradient(180deg, #0A0A0A 0%, #121212 100%)',
                'card-gradient':     'linear-gradient(135deg, #1A1A1A 0%, #242424 100%)',
                'hero-gradient':     'linear-gradient(180deg, rgba(10,10,10,0.1) 0%, rgba(10,10,10,0.8) 60%, #0A0A0A 100%)',
                'ink-radial':        'radial-gradient(ellipse at center, rgba(255,193,7,0.15) 0%, transparent 70%)',
                'tribal-fade':       'linear-gradient(180deg, rgba(255,193,7,0.08) 0%, transparent 100%)',
            },

            boxShadow: {
                'verli':      '0 0 20px rgba(255, 193, 7, 0.15), 0 0 60px rgba(255, 193, 7, 0.05)',
                'verli-sm':   '0 0 10px rgba(255, 193, 7, 0.1)',
                'verli-lg':   '0 0 40px rgba(255, 193, 7, 0.25), 0 0 100px rgba(255, 193, 7, 0.08)',
                'gold':       '0 0 20px rgba(255, 193, 7, 0.15), 0 0 60px rgba(255, 193, 7, 0.05)',
                'gold-sm':    '0 0 10px rgba(255, 193, 7, 0.1)',
                'gold-lg':    '0 0 40px rgba(255, 193, 7, 0.25)',
                'crimson':    '0 0 20px rgba(255, 193, 7, 0.2)',
                'card':       '0 4px 20px rgba(0, 0, 0, 0.4), 0 1px 3px rgba(0, 0, 0, 0.2)',
                'card-hover': '0 10px 30px rgba(255, 193, 7, 0.12), 0 0 20px rgba(0, 0, 0, 0.5)',
                'glass':      '0 8px 32px rgba(0, 0, 0, 0.3)',
                'inset-verli':'inset 0 1px 0 rgba(255, 193, 7, 0.2)',
                'inset-gold': 'inset 0 1px 0 rgba(255, 193, 7, 0.2)',
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
                'pulse-verli':    'pulseVerli 2s ease-in-out infinite',
                'pulse-gold':     'pulseVerli 2s ease-in-out infinite',
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
                pulseVerli: {
                    '0%, 100%': { boxShadow: '0 0 10px rgba(255,193,7,0.2)' },
                    '50%':      { boxShadow: '0 0 30px rgba(255,193,7,0.45)' },
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
                    '0%, 100%': { borderColor: 'rgba(255,193,7,0.3)' },
                    '50%':      { borderColor: 'rgba(255,193,7,0.65)' },
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
