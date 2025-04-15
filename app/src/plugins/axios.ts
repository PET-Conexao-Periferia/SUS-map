import axios, { type AxiosInstance } from 'axios';

declare module '@vue/runtime-core' {
    interface ComponentCustomProperties {
        $axios: AxiosInstance;
    }
}

export default defineNuxtPlugin((nuxtApp) => {
    const api: AxiosInstance = axios.create({
        baseURL: import.meta.env.VITE_API_URL ?? 'http://localhost',
        withCredentials: false,
        withXSRFToken: true,
    });
    nuxtApp.vueApp.config.globalProperties.$axios = api;

    return {
        provide: {
            axios: api,
        }
    }
});