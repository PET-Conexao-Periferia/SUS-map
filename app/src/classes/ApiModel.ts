import type {AxiosInstance, AxiosResponse} from "axios";

export default abstract class ApiModel<ClassType> {
    protected abstract url: string;
    protected loading: boolean = false;
    protected created_at?: Date;
    protected updated_at?: Date;

    protected constructor() {
        return this.disableSetModificationDuringLoading();
    }

    protected sync(data: ClassType) {
        if(data !== null && typeof data === 'object') {
            if('created_at' in data) {
                data.created_at = new Date(String(data.created_at));
            }
            if('updated_at' in data) {
                data.updated_at = new Date(String(data.updated_at));
            }
            Object.assign(this, data);
        }
    }

    protected async fetch(axios: AxiosInstance): Promise<void | boolean | AxiosResponse> {
        if(!this.url) {
            throw new Error('url não definida');
        }
        this.loading = true;
        return axios.get(this.url)
            .then((res: AxiosResponse) => {
                this.loading = false;
                this.sync(res.data);
                return res;
            });
    }

    protected async register(axios: AxiosInstance): Promise<void | boolean | AxiosResponse> {
        if(!this.url) {
            throw new Error('url não definida');
        }
        this.loading = true;
        //@ts-ignore
        return axios.post(this.url, this as ClassType)
            .then((res) => {
                this.loading = false;
                return res;
            });
    }

    protected async update(): Promise<void | boolean | AxiosResponse> {
        throw new Error('Método não implementado!');
    }

    protected async delete(): Promise<void | boolean | AxiosResponse> {
        throw new Error('Método não implementado!');
    }

    protected disableSetModificationDuringLoading() {
        return new Proxy(this, {
            set(target, key, value) {
                if(key === 'loading') {
                    target.loading = value;
                }else if(!target.loading && key in target) {
                    //@ts-ignore
                    target[String(key)] = value;
                }
                return true;
            },
            get(target, key) {
                if(key in target) {
                    //@ts-ignore
                    return target[String(key)];
                }
                return undefined;
            }
        });
    }
}