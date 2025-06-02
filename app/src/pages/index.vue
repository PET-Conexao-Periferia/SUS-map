<template>
  <client-only>
    <Map />
  </client-only>

  <SearchBar />

  <LayoutFloat/>
</template>

<script setup lang="ts">
definePageMeta({
  name: 'home',
  keepalive: true,
  key: 'home',
});

</script>

<style lang="scss" scoped>

</style>