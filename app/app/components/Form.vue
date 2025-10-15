<template>
  <form
      v-bind="$attrs"
      class="tw-py-12 tw-mx-auto tw-mt-0 tw-mb-24"
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
  padding: 2em 1em;
  background-color: #CCD2FF;
  border-radius: 32px;

  @media (min-width: 768px) and (orientation: landscape) {
    min-width: 70vw;
    max-width: 70vw;
    left: 73%;
}
}
</style>