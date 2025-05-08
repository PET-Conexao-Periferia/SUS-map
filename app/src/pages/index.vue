<template>
  <ClientOnly>
    <Map />
  </ClientOnly>
  <Input
      class="search-bar"
      v-model="search"
      placeholder="Pesquisar rua..."
      variant
  />
</template>

<script setup lang="ts">
definePageMeta({
  name: 'home',
});

const search = ref('');

</script>

<style lang="scss" scoped>
.search-bar {
  position: fixed;
  bottom: 2em;
  left: 1em;
  right: 1em;
}
</style>