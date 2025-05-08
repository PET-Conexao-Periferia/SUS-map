<template>
  <button
    v-bind="$attrs"
    :class="{'variant-select': props.variantSelect}"
  >
    <slot />
  </button>
</template>

<script setup lang="ts">
const props = defineProps({
  variantSelect: {
    type: Boolean,
    default: false,
  }
});

</script>

<style scoped lang="scss">
button {
  background-color: #007FB6;
  color: #FFFFFF;
  border: none;
  line-height: 15px;
  border-radius: 10px;
  width: 145px;
  height: 40px;


  &:active {
    background-color: #FFFFFF;
    color: #007FB6;
  }
}

.variant-select {
  background-color: #FFFFFF;
  color: #000000;

  &:active {
    background-color: #007FB6;
    color: #FFFFFF;
  }
}
</style>