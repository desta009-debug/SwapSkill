import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                serif: ['Fraunces', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                brand: {
                    primary: '#2845D6',
                    dark: '#1A2CA3',
                    darker: '#10206F',
                    accent: '#F68048',
                    accentHover: '#FF8F5A',
                    bg: '#F8FAFC',
                    surface: '#FFFFFF',
                    border: '#E2E8F0',
                },
                text: {
                    primary: '#0F172A',
                    secondary: '#64748B',
                }
            },
            backgroundImage: {
                'brand-gradient': 'linear-gradient(135deg, #2845D6 0%, #1A2CA3 70%, #10206F 100%)',
                'cta-gradient': 'linear-gradient(135deg, #F68048 0%, #FF8F5A 100%)',
            }
        },
    },

    plugins: [forms],
};
