import axios, { type AxiosInstance } from 'axios';

declare module '@vue/runtime-core' {
    interface ComponentCustomProperties {
        $axios: AxiosInstance;
    }
}

export default defineNuxtPlugin((nuxtApp) => {
    nuxtApp.vueApp.config.globalProperties.$axios = axios.create({
        baseURL: import.meta.env.VITE_API_BASE_URL ?? 'http://localhost',
        withCredentials: true,
        withXSRFToken: true,
    });
});