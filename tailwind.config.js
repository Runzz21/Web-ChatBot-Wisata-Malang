/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                ink: '#0E1D18',
                canvas: '#FDFBF7',
                'canvas-alt': '#F5F0E8',
                leaf: {
                    50: '#f4f7f4',
                    100: '#e3ebe3',
                    200: '#c7d7c7',
                    300: '#a1bba1',
                    400: '#759b75',
                    500: '#557e55',
                    600: '#2D4A3E',
                    700: '#1F362E',
                    800: '#152A23',
                    900: '#0E1D18',
                },
                gold: {
                    400: '#D4A84B',
                    500: '#C9A84C',
                    600: '#B8943A',
                },
                moss: '#557E55',
                bark: '#8B6F47',
                cream: {
                    50: '#FDFBF7',
                    100: '#F5F0E8',
                    200: '#EDE5D8',
                    300: '#E0D4C0',
                },
            },
            fontFamily: {
                sans: ['DM Sans', 'system-ui', '-apple-system', 'sans-serif'],
                display: ['Sora', 'system-ui', 'sans-serif'],
                mono: ['DM Mono', 'JetBrains Mono', 'monospace'],
            },
            backgroundImage: {
                'noise': "url(\"data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E\")",
            },
            boxShadow: {
                'card': '0 2px 16px rgba(14,29,24,0.05)',
                'card-hover': '0 12px 48px rgba(14,29,24,0.1)',
                'dropdown': '0 8px 32px rgba(14,29,24,0.12)',
                'modal': '0 24px 80px rgba(14,29,24,0.2)',
                'warm': '0 4px 24px rgba(45,74,62,0.08)',
                'warm-lg': '0 8px 40px rgba(45,74,62,0.12)',
                'glass': '0 4px 30px rgba(0,0,0,0.08)',
            },
            animation: {
                'fade-up': 'fadeUp 0.7s ease-out forwards',
                'fade-down': 'fadeDown 0.6s ease-out forwards',
                'scale-in': 'scaleIn 0.4s ease-out forwards',
                'float': 'float 6s ease-in-out infinite',
                'gold-pulse': 'goldPulse 3s ease-in-out infinite',
            },
            keyframes: {
                fadeUp: { '0%': { opacity: '0', transform: 'translateY(24px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                fadeDown: { '0%': { opacity: '0', transform: 'translateY(-16px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                scaleIn: { '0%': { opacity: '0', transform: 'scale(0.9)' }, '100%': { opacity: '1', transform: 'scale(1)' } },
                float: { '0%, 100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-12px)' } },
                goldPulse: { '0%, 100%': { opacity: '0.6', transform: 'scale(1)' }, '50%': { opacity: '1', transform: 'scale(1.05)' } },
            },
        },
    },
    plugins: [],
};
