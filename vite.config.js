import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // Path to your CSS file
                'resources/js/app.js',  // Path to your JS file
            ],
            refresh: true,
        }),
    ],
});