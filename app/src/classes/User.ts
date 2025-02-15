import type {UserType} from "~/types/UserType";
import type { AxiosInstance, AxiosResponse} from "axios";
import ApiModel from './ApiModel';

export default class User extends ApiModel<UserType> implements UserType {
    protected url: string = 'api/users';

    id?: number | undefined;
    name?: string | undefined;
    email?: string | undefined;
    password?: string | undefined;
    password_confirmation?: string | undefined;

    constructor(data: UserType) {
        super();
        this.sync(data);
    }

    protected override async register(axios: AxiosInstance): Promise<void | boolean | AxiosResponse> {
        if(!this.url) {
            throw new Error('url não definida');
        }
        this.loading = true;
        return axios.post('api/register', this as UserType)
            .then((res) => {
                this.loading = false;
                return res;
            });
    }
}