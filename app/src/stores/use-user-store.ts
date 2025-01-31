import {defineStore} from "pinia";
import User from "~/classes/User";

export default defineStore('user', {
    state() {
        const user: User = new User({});
        return {
            user,
        }
    }
});