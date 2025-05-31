<template>
<form
    v-bind="$attrs"
    class="tw-py-12 tw-mx-14 tw-mb-4"
>
  <slot />
</form>
</template>

<script setup lang="ts">

</script>

<style scoped>
form {
  background-color: #CCD2FF;
  border-radius: 20px;
}
</style>