<template>
  <div>
    <ExampleComponent />
  </div>
  <pre v-if="userStore?.data?.id">
    {{userStore.data}}
  </pre>
</template>

<script lang="ts">
import useUserStore from "~/stores/use-user-store";

export default defineComponent({
  name: 'IndexPage',

  data() {
    return {
      userStore: null as null | useUserStore
    }
  },

  mounted() {
    this.userStore = useUserStore();
    this.userStore.data.fetch(this.$axios);
  }
});
</script>
