import type { UserType } from "~/types/User";

export default class AuthService {
    static async login(user: UserType): Promise<boolean> {
        const { $axios } = useNuxtApp();
        const { data } = await $axios.post('api/users/login', {
            email: user.email,
            password: user.password,
        });
        const { token } = data;
        $axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

        const tokenCookie = useCookie('token');
        tokenCookie.value = token;

        return true;
    }

    static async logout() {
        const { $axios, $userStore } = useNuxtApp();
        await $axios.post('api/users/logout');
        delete $axios.defaults.headers.common['Authorization'];

        const tokenCookie = useCookie('token');
        tokenCookie.value = null;

        $userStore.resetData();
    }

    static async register(user: UserType) {
        const { $axios } = useNuxtApp();
        try {
            const { data } = await $axios.post('api/users/register', user);
            const token = useCookie('token');
            token.value = data.token;
            $axios.defaults.headers.common['Authorization'] = `Bearer ${token.value}`;
            return true;
        } catch(error) {
            return false;
        }
    }

    static async checkEmailCode(code: string) {
        if(code.length !== 8) {
            return;
        }
        const { $axios } = useNuxtApp();
        return $axios.post('api/users/verify-code', {
            code,
        });
    }
}