<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "SearchBar",
})
</script>

<template>
  <input
      v-bind="$attrs"
  />
  <slot/>
</template>

<style scoped>
input {
  height: 40px;
  width: 100%;
  border: none;
  border-radius: 32px;
  background-color: #FEFEFE;
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
  padding: 1em;
  color: v-bind(textColor);
  margin: 0;
  box-sizing: border-box;
}
input::placeholder {
  color: #6B7280 ;
}
input:focus{
  outline-color: #003087;
}
</style>