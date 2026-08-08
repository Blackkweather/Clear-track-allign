import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            // animations.css / animations.js = couche « version animée ».
            // Les retirer d'ici (ou passer CLEARTRACK_ANIMATIONS=false) rend la
            // version « statique de base », copie conforme du PowerPoint.
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/animations.css',
                'resources/js/animations.js',
            ],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
