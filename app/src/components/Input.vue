<template>
  <label
      :class="'tw-grid ' + $attrs.class + paiInput"
      :for="$attrs.id ? String($attrs.id) : undefined"
  >
    <span>{{ label }}</span>
    <input
        v-bind="$attrs"
        @input="validate = true"
        v-model="inputValue"
        :class="[
            {'variant-select': props.variant},
            $attrs?.['input.class'] ?? '',
        ]"
    />
    <slot v-if="validate && props.error" />
  </label>
</template>

<script setup lang="ts">

const props = defineProps({
  label: {
    type: String,
    default: '',
  },
  modelValue: {
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
  },
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
const labelColor = computed(() => validate.value && props.error ? '#CD191E' : '');
const textColor = computed(() => validate.value && props.error ? '#CD191E' : '#6B7280');
const borderColor = computed(() => validate.value && props.error ? '#CD191E' : '#2D2F46');
</script>

<style scoped>
input {
  height: 40px;
  width: 100%;
  border: none;
  border-radius: 32px;
  background-color: #FEFEFE;
  padding: 1em;
  color: v-bind(textColor);
  margin: 0;
  box-sizing: border-box;
}
input::placeholder {
  color: v-bind(textColor);
}
input:focus{
  outline-color: #003087;
}

label {
  margin: 0.5em;
  color: v-bind(labelColor);
}
.variant-select {
  background-color:  #FEFEFE;
}
</style>