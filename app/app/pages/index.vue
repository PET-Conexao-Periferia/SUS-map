<template>
  <client-only>
    <Map />
  </client-only>

  <SearchBar />

  <LayoutFloat />
</template>

<script setup lang="ts">
definePageMeta({
  showHeader: false,
  name: "home",
});
</script>

<style lang="scss" scoped></style>
