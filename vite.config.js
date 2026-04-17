import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/scss/core.scss',
                'resources/scss/overrides.scss',
                'resources/assets/scss/style.scss',
                'resources/assets/scss/style-rtl.scss',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~': path.resolve(__dirname, 'node_modules'),
            '@': path.resolve(__dirname, 'resources'),
        },
    },
    css: {
        preprocessorOptions: {
            scss: {
                loadPaths: [
                    path.resolve(__dirname, 'node_modules'),
                    path.resolve(__dirname, 'resources/assets'),
                    path.resolve(__dirname, 'resources'),
                ],
            },
        },
    },
});


