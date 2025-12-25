import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        cors: true,
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
    build: {
        cssCodeSplit: true,
        minify: 'esbuild',
        reportCompressedSize: false,
        chunkSizeWarningLimit: 1000,
        assetsInlineLimit: 4096,
        rollupOptions: {
            output: {
                manualChunks: undefined,
            },
        },
    },
});
