// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    compatibilityDate: '2024-11-01',
    devtools: { enabled: false },
    ssr: true,
    srcDir: 'src',
    css: [
        '~/assets/css/main.scss',
        '~/assets/css/tailwind.scss',
    ],
    vite: {
        css:
            {
                preprocessorOptions: {
                    scss: {
                        additionalData: "@use '~/assets/css/variables.scss' as *;",
                    },
                },
            },
    },
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
                    src: '/vlibras.js',
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
