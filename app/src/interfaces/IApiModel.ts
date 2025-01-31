export interface IApiModel<T> {
    fetch(): Promise<void | boolean>;
    register(): Promise<void | boolean>;
    update(): Promise<void | boolean>;
    delete(): Promise<void | boolean>;
}