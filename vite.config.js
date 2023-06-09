import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

/* export default ({ command }) => ({
    base: command === 'serve' ? '' : '/build/',
    publicDir: 'abcd',
    build: {
        manifest: true,
        outDir: 'public/build',
        rollupOptions: {
            input: 'resources/js/app.js',
        },
    },
}); */

export default defineConfig({
	plugins: [		
        laravel({
            input: ['resources/scss/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
