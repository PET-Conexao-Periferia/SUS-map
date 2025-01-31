<template>
  <button
    v-bind="$attrs"
  >
    <slot />
  </button>
</template>

<script lang="ts">

export default defineComponent({
  name: 'Button',

  data() {

    const variantSelect = false;

    return {
      variantSelect,
    }
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
</style>