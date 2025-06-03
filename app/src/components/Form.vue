<template>
  <form
      v-bind="$attrs"
      class="tw-py-12 tw-mx-5 tw-mt-14"
  >
    <slot />
  </form>
</template>

<script setup lang="ts">

</script>

<style scoped lang="scss">
form {
  display: grid;
  grid-auto-rows: auto;
  padding: 2em;
  background-color: #CCD2FF;
  border-radius: 32px;
}
</style>