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

  mounted() {
    useUserStore().data.fetch(this.$axios);
  },
});
</script>
