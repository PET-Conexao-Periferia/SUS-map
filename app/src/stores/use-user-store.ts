import {defineStore} from "pinia";
import User from "~/classes/User";

export default defineStore('user', {
    state() {
        const data: User = new User({});
        return {
            data,
        }
    }
});