import type {AxiosInstance, AxiosResponse} from "axios";

export interface IApiModel {
    fetch(axios?: AxiosInstance): Promise<void | boolean | AxiosResponse>;
    register(axios?: AxiosInstance): Promise<void | boolean | AxiosResponse>;
    update(axios?: AxiosInstance): Promise<void | boolean | AxiosResponse>;
    delete(axios?: AxiosInstance): Promise<void | boolean | AxiosResponse>;
}