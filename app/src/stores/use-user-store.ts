import { defineStore } from "pinia";
import { type UserType } from "~/types/User";

export default defineStore("user", {
    state: () => ({
        data: null as null | UserType,
        is_admin: false,
    }),

    actions: {
        async fetchIsAdmin() {
            const { $axios } = useNuxtApp();
            const { data } = await $axios.get('/api/users/is_admin');
            this.is_admin = data.is_admin;
            setTimeout(async () => {
                this.fetchIsAdmin();
            }, 5 * 60 * 1000); //5 min
        },
        resetDatas() {
            this.data = null;
            this.is_admin = false;
        },
        async fetch() {
            const { $axios } = useNuxtApp();
            const { data } = await $axios.get('/api/users');
            this.data = data;
        },
    },
});