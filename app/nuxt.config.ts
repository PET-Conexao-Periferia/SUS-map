// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    compatibilityDate: '2024-11-01',
    devtools: { enabled: false },
    srcDir: 'src',
    css: [
        '~/assets/css/main.scss',
        '~/assets/css/variables.scss',
        '~/assets/css/tailwind.scss',
    ],
    plugins: [
        '~/plugins/axios',
    ],
    modules: [
        '@pinia/nuxt',
        '@nuxtjs/leaflet',
    ],
    pinia: {
        storesDirs: [
            './stores/**'
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
                    src: import.meta.env.VITE_API_BASE_URL + '/vlibras-plugin.js',
                    tagPosition: 'bodyClose',
                }
            ],
            htmlAttrs: {
                lang: 'pt-BR',
            },
        },
    },
});
