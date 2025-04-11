<template>
  <div :class="'tw-grid ' + $props.class">
    <label class="tw-pl-1">{{label}}</label>
    <input
        v-bind="$attrs"
        @input="validate = true"
        v-model="inputValue"
    />
    <Transition>
      <small v-if="error" class="tw-pl-1 tw-pt-1">{{messageError}}</small>
    </Transition>
  </div>
</template>

<script lang="ts">

export default defineComponent({
  name: "Input",

  data() {
    return {
      validate: false,
      error: false,
    }
  },

  props: {
    label: {
      type: String,
      default: '',
    },
    class: {
      type: String,
      default: '',
    },
    validation: {
      type: Function as PropType<(value: any) => boolean>,
    },
    modelValue: {
      type: null,
      required: true,
    },
    messageError: {
      type: String,
      default: '',
    }
  },

  emits: ['update:modelValue'],

  computed: {
    inputValue: {
      get() {
        return this.modelValue;
      },
      set(value: any) {
        if(this.validation) {
          this.error = !this.validation(value);
        }
        this.$emit('update:modelValue', value);
      }
    },
    textColor() {
      return this.validate && this.error ? '#CD191E' : '';
    },
    borderColor() {
      return this.validate && this.error ? '#CD191E' : '#2D2F46';
    }
  }
});

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
small {
  color: #CD191E;
}
</style>