<template>
<form v-bind="$attrs">
  <div class="tw-pt-12"></div>
  <slot />
  <div class="tw-pb-12"></div>
</form>
</template>

<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "Form"
})
</script>

<style scoped>
form {
  background-color: #CCD2FF;
  border-radius: 20px;
}
</style>