import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.css',
                'resources/js/app.js',
                'resources/css/shop.css', 'resources/css/favorites.css'
            ],
            refresh: true,
        }),
    ],
});
