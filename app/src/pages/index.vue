<template>
  <div>
    <ExampleComponent />
  </div>
  <pre v-if="userStore?.data?.id">
    {{userStore.data}}
  </pre>
  <ClientOnly>
    <Map />
  </ClientOnly>
</template>

<script lang="ts">
import useUserStore from "~/stores/use-user-store";

export default defineComponent({
  name: 'index',

  data() {
    return {
      userStore: null as null | useUserStore
    }
  },

  mounted() {
    this.userStore = useUserStore();
  },
});
</script>