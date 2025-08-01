import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/css/form.css', 'resources/js/app.js', 'resources/css/home.css'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
