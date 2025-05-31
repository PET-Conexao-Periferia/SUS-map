<template>
  <nav
    tabindex="0"
    @click="emit('hideActions')"
  >
    <Button
        @click="async () => navigateTo({
          name: 'location-create',
        })"
        variant-select
    >
      Adicionar local
    </Button>
  </nav>
</template>

<script setup lang="ts">
const emit = defineEmits(['hideActions']);
</script>

<style scoped lang="scss">
nav {
  left: auto;
  right: 1em;
}
</style>