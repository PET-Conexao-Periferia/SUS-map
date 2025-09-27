import { type UserType } from "~/types/User";
import type { AxiosError } from "axios";

export default defineStore('user', () => {
    const user = ref<UserType | null>(null);
    const is_admin = ref(false);

    const { $axios } = useNuxtApp();

    async function fetch() {
        const token = useCookie('token');
        if(token.value) {
            $axios.defaults.headers.common['Authorization'] = `Bearer ${token.value}`;
            fetchIsAdmin();
            try {
                const { data } = await $axios.get('/api/users');
                user.value = data;
            } catch(error: AxiosError | any) {
                if (error.response?.status === 401) {
                    token.value = null;
                    resetData();
                }
            }
        }
    }
    async function fetchIsAdmin() {
        const token = useCookie('token');
        if(token.value) {
            $axios.defaults.headers.common['Authorization'] = `Bearer ${token.value}`;
            try {
                const {data} = await $axios.get('/api/users/is_admin');
                is_admin.value = data.is_admin;
            } catch (error: AxiosError | any) {
                if (error.response?.status === 401) {
                    token.value = null;
                    resetData();
                }
            }
            setTimeout(() => {
                fetchIsAdmin();
            }, 5 * 60 * 1000); //5 min
        }
    }
    function resetData() {
        user.value = null;
        is_admin.value = false;
    }

    return {
        data: user,
        is_admin,
        fetch,
        resetData,
        fetchIsAdmin
    }
});
