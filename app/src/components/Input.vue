<template>
<div :class="'tw-grid ' + $props.class">
  <label>{{label}}</label>
  <input v-bind="$attrs" />
</div>
</template>

<script lang="ts">

export default defineComponent({
  name: "Input",

  props: {
    label: {
      type: String,
      default: '',
    },
    class: {
      type: String,
      default: '',
    }
  }
});

</script>

<style scoped>
input {
  height: 35px;
  border-width: 0.5px;
  border-color: #2D2F46;
  border-style: solid;
  border-radius: 10px;
  background-color: #FEFEFE;
  box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
  padding-left: 10px;
}
</style>