<template>
  <ClientOnly>
    <Map />
  </ClientOnly>
</template>

<script lang="ts">
import useUserStore from "~/stores/use-user-store";

export default defineComponent({
  name: 'index',
});
</script>