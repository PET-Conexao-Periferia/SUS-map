export default defineNuxtPlugin((nuxtApp) => {
    nuxtApp.vueApp.directive('mask', {
        getSSRProps() {
            return {} as Record<string, any>;
        }
    });
});
