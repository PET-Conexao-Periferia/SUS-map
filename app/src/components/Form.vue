<template>
  <form
      v-bind="$attrs"
      class="tw-py-12 tw-mx-5"
  >
    <slot />
  </form>
</template>

<script setup lang="ts">

</script>

<style scoped>
form {
  display: grid;
  grid-auto-rows: auto;
  padding: 2em;
  background-color: #CCD2FF;
  border-radius: 32px;
}
</style>