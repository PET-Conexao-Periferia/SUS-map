<script lang="ts" xmlns="http://www.w3.org/1999/html">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "Separator"
})
</script>

<template>
<div></div>
  <slot/>
</template>

<style scoped>
div{
  border-top: 1px solid #6B7280;
  width: 100%;
  margin: 15px 0;
}
</style>