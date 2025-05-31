<template>
  <client-only>
    <Map />
  </client-only>
  <Input
      class="search-bar"
      v-model="search"
      name="search.street"
      placeholder="Pesquisar rua..."
      variant
  />
</template>

<script setup lang="ts">
definePageMeta({
  name: 'home',
  keepalive: true,
  key: 'home',
});

const search = ref('');
let timeout: NodeJS.Timeout | null = null; //debounce
const { $locationStore } = useNuxtApp();

watch(search, ($new) => {
  if($new) {
    if(timeout) {
      clearTimeout(timeout);
    }
    timeout = setTimeout(() => {
      $locationStore.searchLocation($new);
    }, 500);
  }
});

</script>

<style lang="scss" scoped>
.search-bar {
  position: fixed;
  bottom: 2em;
  left: 1em;
  right: 1em;
}
</style>