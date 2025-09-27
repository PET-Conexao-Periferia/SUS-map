<template>
  <img
      src="~/assets/img/Logo.svg"
      alt="Logo do Periferia + Saúde"
      :class="'tw-block tw-mx-auto tw-mb-8 ' + props.class"
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