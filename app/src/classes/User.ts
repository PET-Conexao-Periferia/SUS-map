import type {IApiModel} from "~/interfaces/IApiModel";
import type {UserType} from "~/types/UserType";
import type {AxiosInstance, AxiosResponse} from "axios";

export default class User implements UserType, IApiModel {
    id?: number | undefined;
    name?: string | undefined;
    email?: string | undefined;
    password?: string | undefined;
    password_confirmation?: string | undefined;

    constructor(data: UserType) {
        this.id = data.id;
        this.name = data.name;
        this.email = data.email;
        this.password = data.password;
        this.password_confirmation = data.password_confirmation;
    }

    sync(data: UserType) {
        this.id = data.id;
        this.name = data.name;
        this.email = data.email;
        this.password = data.password;
        this.password_confirmation = data.password_confirmation;
    }

    async fetch(axios: AxiosInstance): Promise<void | boolean | AxiosResponse> {
        return axios.get('api/user')
            .then((res: AxiosResponse) => {
                this.sync(res.data);
            });
    }
    async register(axios: AxiosInstance): Promise<void | boolean | AxiosResponse> {
        return axios.post('api/register', this as UserType) as AxiosResponse;
    }
    update(): Promise<void | boolean | AxiosResponse> {
        throw new Error('Método não implementado!');
    }
    delete(): Promise<void | boolean | AxiosResponse> {
        throw new Error('Método não implementado!');
    }
}