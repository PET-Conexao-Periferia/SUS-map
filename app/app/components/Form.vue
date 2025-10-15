<template>
  <form
      v-bind="$attrs"
      class="tw-mx-auto tw-py-12 tw-mt-0 tw-mb-24"
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
  min-width: 85vw;
  max-width: 85vw;
  padding: 2em 1em;
  background-color: #dfe6ec;
  border-radius: 32px;
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);

  @media (min-width: 768px) and (orientation: landscape) {
    min-width: 70vw;
    max-width: 70vw;
}
}
</style>