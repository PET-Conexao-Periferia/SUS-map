import { useUserStore, useLocationStore } from "~/stores";

export default defineNuxtPlugin(() => {
  return {
    provide: {
      userStore: useUserStore(),
      locationStore: useLocationStore(),
    },
  };
});
