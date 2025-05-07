// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    compatibilityDate: '2024-11-01',
    devtools: { enabled: true },
    debug: true,
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
    },
    modules: ['@pinia/nuxt', '@nuxtjs/leaflet'],
    pinia: {
        storesDirs: [
            '~/stores/**/*.ts',
        ],
    },
    postcss: {
        plugins: {
            tailwindcss: {},
            autoprefixer: {},
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
            title: 'SUS Map',
            htmlAttrs: {
                lang: 'pt-BR',
            },
        },
    },
});