<template>
  <Transition>
    <small class="tw-pl-1 tw-pt-1">{{ props.messageError }}</small>
  </Transition>
</template>

<script setup lang="ts">
const props = defineProps({
  messageError: {
    type: String,
    required: true,
  }
});
</script>

<style scoped>
small {
  color: #CD191E;
}
</style>