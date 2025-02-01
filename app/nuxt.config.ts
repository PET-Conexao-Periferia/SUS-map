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
        {
            src: '~/plugins/vlibras',
            mode: 'client',
        }
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
    // runtimeConfig: {
    //     public: {
    //         imageDomains: ['https://vlibras.gov.br', 'cdn.jsdelivr.net', 'https://www.vlibras.gov.br', 'https://vlibras.gov.br/app'],
    //     },
    // },
    app: {
        head: {
            script: [
                // {
                //     src: "https://vlibras.gov.br/app/vlibras-plugin.js",
                //     tagPosition: 'bodyOpen',
                // },
            ],
            htmlAttrs: {
                lang: 'pt-BR',
            },
        },
    },
});
