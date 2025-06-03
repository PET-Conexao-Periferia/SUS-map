<template>
  <client-only>
    <Map />
  </client-only>

  <SearchBar />

  <LayoutFloat/>
</template>

<script setup lang="ts">
definePageMeta({
  showHeader: false,
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

</style>