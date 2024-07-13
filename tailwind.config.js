import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
      "./resources/**/*.blade.php",
      './vendor/tallstackui/tallstackui/src/**/*.php'
    ],

    presets: [
        require('./vendor/tallstackui/tallstackui/tailwind.config.js')
    ],

    theme: {
        screens: {
            phone: "462px",
            ...defaultTheme.screens
        },
        extend: {
            colors: {
                primary: '#51B9F5',
                secondary: '#111827'
            },
            fontFamily: {
            'questrial': 'Questrial',
            }
        },
    },
    plugins: [forms],
}
