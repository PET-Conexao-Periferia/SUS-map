import type {AxiosInstance} from "axios";
import type {UserType} from "~/types/UserType";

export default class AuthService {
    static async login(axios: AxiosInstance, user: UserType) {
        return axios.post('api/login', {
            email: user.email,
            password: user.password,
        })
            .then((response) => {
                const token = response.data.token;
                axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                localStorage.setItem('token', token);
                return true;
            });
    }

    static async logout(axios: AxiosInstance) {

    }
}