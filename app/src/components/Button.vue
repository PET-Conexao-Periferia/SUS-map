<template>
  <button
    v-bind="$attrs"
    :class="['button-default',variants[variant]]"
  >
    <slot />
  </button>
</template>

<script setup lang="ts">
const props = defineProps({
  variants: {
    type: String,
    default: "default",
    validator: (value:string)=>["default", "allow", "deny","navigation"].includes(value)
  },
  computed:{
    variants(){
      return{
        default: 'button-default',
        navigation: 'button-navigation',
        allow: 'button-allow',
        deny: 'button-deny'
      }
    }
  }
});

</script>

<style scoped lang="scss">
.button-default {
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

.variant-select {
  background-color: #FFFFFF;
  color: #000000;

  &:active {
    background-color: #003087;
    color: #FFFFFF;
  }
}
</style>