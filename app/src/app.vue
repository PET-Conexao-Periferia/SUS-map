<template>
  <NuxtLayout>
    <NuxtPage />
  </NuxtLayout>
</template>

<script lang="ts">
import useUserStore from "~/stores/use-user-store";

export default defineComponent({
  name: 'App',

  async setup() {
    const token = useCookie('token');
    const user = useUserStore();
    if(token.value) {
      try {
        await user.fetch();
      } catch(e) {
        console.log(e);
        token.value = null;
      }
    }

    return {
      user,
      token,
    }
  },

  async mounted() {
    if(this.token) {
      this.user.fetchIsAdmin();
    }
    this.$axios.get('/sanctum/csrf-cookie');
  }
});
</script>