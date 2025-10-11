import VueTheMask from "vue-the-mask";

export default defineNuxtPlugin((nuxtApp) => {
  //@ts-ignore
  nuxtApp.vueApp.use(VueTheMask);
});
