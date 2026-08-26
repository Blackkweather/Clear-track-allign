import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
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
            // La déclaration `fonts: [bunny('Instrument Sans')]` a été retirée :
            // elle téléchargeait et embarquait six fichiers de police (116 Ko)
            // pour une famille que le site n'utilise NULLE PART — la maquette
            // est en Poppins. Le fonts-*.css produit n'était d'ailleurs jamais
            // chargé par le layout : 116 Ko construits et déployés pour rien.
            // Poppins, elle, est désormais auto-hébergée via des @font-face
            // écrits à la main dans app.css (D66).
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
