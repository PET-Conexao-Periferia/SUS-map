import useUserStore from "~/stores/useUserStore";
import useLocationStore from "~/stores/useLocationStore";

export default defineNuxtPlugin(() => {
    return {
        provide: {
            userStore: useUserStore(),
            locationStore: useLocationStore(),
        }
    }
});