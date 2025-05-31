// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    compatibilityDate: '2024-11-01',
    devtools: {
        enabled: String(process.env?.NUXT_DEVELOPER) === 'true' ? true : undefined,
    },
    debug: String(process.env?.NUXT_DEVELOPER) === 'true' ? true : undefined,
    ssr: true,
    srcDir: 'src',
    css: [
        '~/assets/css/main.scss',
        '~/assets/css/tailwind.scss',
    ],
    vite: {
        css: {
            preprocessorOptions: {
                scss: {
                    additionalData: "@use '~/assets/css/variables.scss' as *;",
                },
            },
        },
	server: {
	    allowedHosts: true,
	},
    },
    modules: [
        '@pinia/nuxt',
        '@nuxtjs/leaflet',
        '@vite-pwa/nuxt'
    ],
    pinia: {
        storesDirs: [
            '~/stores/**/*.ts',
        ],
    },
    pwa: {
        devOptions: {
            enabled: String(process.env?.NUXT_DEVELOPER) === 'true' ? true : undefined,
        },
        manifest: {
            lang: 'pt-BR',
            name: 'Periferia+SUS',
            short_name: 'Periferia+SUS',
            description: 'Mapa do sus no litoral norte',
            theme_color: '#ffffff',
            background_color: '#ffffff',
            display: 'standalone',
            scope: '/',
            start_url: '/',
        },
        workbox: {
            globPatterns: ['**/*.{js,css,html,png,svg,ico}'],
        },
        injectManifest: {
            globPatterns: ['**/*.{js,css,html,png,svg,ico}'],
        },
    },
    app: {
        head: {
            script: [
                {
                    src: '/js/vlibras.js',
                    tagPosition: 'bodyClose',
                }
            ],
            title: 'Periferia+SUS',
            htmlAttrs: {
                lang: 'pt-BR',
            },
        },
    },
    postcss: {
        plugins: {
            tailwindcss: {},
            autoprefixer: {},
        },
    },
});
