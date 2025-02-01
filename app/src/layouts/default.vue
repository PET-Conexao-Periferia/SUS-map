<template>
  <div>
    <AppHeader />
    <slot />
    <AppFooter />
  </div>
</template>

<script lang="ts">
import useUserStore from "~/stores/use-user-store";

export default defineComponent({
  name: 'default',

  data() {
    return {
      userStore: null as null | useUserStore
    }
  },

  mounted() {
    this.userStore = useUserStore();
    this.userStore.data.fetch(this.$axios);
  },
});
</script>
