import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/home/home.js',
                'resources/js/user/user-list.js',
                'resources/js/area/area-list.js',

                'resources/js/tools/axios.js',
                'resources/js/tools/jquery.js',
                'resources/js/tools/import.js',

                'resources/js/client/clientdetails.js',
                'resources/js/client/clientdetail.js'
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            // Alias for jQuery
            jquery: 'jquery/src/jquery'
        },
    },
    optimizeDeps: {
        include: ['jquery'],
    },
});
