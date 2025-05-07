<template>
  <img
      src="~/assets/img/logo-pet-horizontal.svg"
      alt="logo do PET - Conexão Periferia"
      :class="'tw-block tw-mx-auto tw-mb-14 ' + props.class"
      v-bind="$attrs"
  />
</template>

<script setup lang="ts">
const props = defineProps({
  class: {
    type: String,
    default: '',
  }
})
</script>

<style scoped>

</style>