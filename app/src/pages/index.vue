<template>
  <client-only>
    <Map />
  </client-only>
  <Input
      class="search-bar"
      v-model="search"
      name="search.street"
      placeholder="Pesquisar rua..."
  />
  <LayoutFloat/>
</template>

<script setup lang="ts">
definePageMeta({
  name: 'home',
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
  top: 5vh;
  left: 50%;
  transform: translateX(-50%);
  min-width: 80vw;
  max-width: 80vw;
}
</style>