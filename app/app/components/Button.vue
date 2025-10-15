<template>
  <button
    type="button"
    v-bind="$attrs"
    :class="[`button-${props.variants}`]"
  >
    <slot />
  </button>
</template>

<script setup lang="ts">
const props = defineProps({
  variants: {
    type: String,
    default: "default",
    validator: (value:string)=>["default", "allow", "deny", "navigation"].includes(value)
  }
});
</script>

<style scoped lang="scss">
.button-default {
  display: flex;
  flex-flow: row nowrap;
  justify-content: center;
  align-items: center;
  gap: 1em;
  background-color: #003087;
  color: #FFFFFF;
  border: none;
  border-radius: 3em;
  width: 80%;
  height: 40px;
  box-sizing: border-box;


  &:active {
    background-color: #FFFFFF;
    color: #007FB6;
  }
}

.button-allow {

}

.button-deny {

}

.button-navigation {

}

.variant-select {
  background-color: #FFFFFF;
  color: #000000;

  &:active {
    background-color: #003087;
    color: #FFFFFF;
  }
}
</style>