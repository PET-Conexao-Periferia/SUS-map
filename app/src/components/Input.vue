<template>
  <div :class="'tw-grid ' + $props.class">
    <label class="tw-pl-1">{{ label }}</label>
    <input
        v-bind="$attrs"
        @input="validate = true"
        v-model="inputValue"
        :class="{'variant-select': props.variant}"
    />
    <slot v-if="validate && props.error" />
  </div>
</template>

<script setup lang="ts">
const props = defineProps({
  label: {
    type: String,
    default: '',
  },
  class: {
    type: String,
    default: '',
  },
  modelValue: {
    type: null,
    required: true,
  },
  messageError: {
    type: String,
    default: '',
  },
  error: {
    type: Boolean,
    default: false,
  },
  variant: {
    type: Boolean,
    default: false,
  }
});
const emit = defineEmits(['update:modelValue']);

const validate = ref(false);

const inputValue = computed({
  get() {
    return props.modelValue;
  },
  set(value: any) {
    emit('update:modelValue', value);
  }
});
const textColor = computed(() => validate.value && props.error ? '#CD191E' : '');
const borderColor = computed(() => validate.value && props.error ? '#CD191E' : '#2D2F46');
</script>

<style scoped>
input {
  height: 35px;
  border-width: 0.5px;
  border-color: v-bind(borderColor);
  border-style: solid;
  border-radius: 10px;
  background-color: #FEFEFE;
  box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
  padding-left: 10px;
  color: v-bind(textColor);
}
input::placeholder {
  color: v-bind(textColor);
}
label {
  color: v-bind(textColor);
}
.variant-select {
  background-color: #CCD2FF;
}
</style>