import { type UserType } from "~/types/User";
import type { AxiosError } from "axios";

export default defineStore("user",{
    state: () => ({
        data: null as null | UserType,
        is_admin: false,
    }),

    actions: {
        async fetchIsAdmin() {
            const { $axios } = useNuxtApp();

            const token = useCookie('token');
            if(token.value) {
                $axios.defaults.headers.common['Authorization'] = `Bearer ${token.value}`;
                try {
                    const { data } = await $axios.get('/api/users/is_admin');
                    this.is_admin = data.is_admin;
                } catch(error: AxiosError | any) {
                    if(error.response?.status === 401) {
                        this.resetDatas();
                    }
                }
                setTimeout(() => {
                    this.fetchIsAdmin();
                }, 5 * 60 * 1000); //5 min
            }
        },
        resetDatas() {
            this.data = null;
            this.is_admin = false;
        },
        async fetch() {
            const { $axios } = useNuxtApp();
            const token = useCookie('token');
            if(token.value) {
                $axios.defaults.headers.common['Authorization'] = `Bearer ${token.value}`;
            }
            const { data } = await $axios.get('/api/users');
            this.data = data;
        },
    },
});