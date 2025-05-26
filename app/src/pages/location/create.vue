<template>
  <Form class="tw-mt-14">

    <Logo />

    <label class="tw-grid tw-mb-4 tw-mx-6">
      <span>Como deseja encontrar o local?</span>
      <select v-model="selectViaCep" class="tw-mx-auto" name="selectViaCep">
        <option selected :value="true">via CEP</option>
        <option :value="false">por Rua</option>
      </select>
    </label>

    <keep-alive>
      <Input
          v-if="selectViaCep"
          label="CEP"
          v-model="location.cep_or_street"
          name="location.cep"
          type="text"
          placeholder="Digite o cep..."
          class="tw-mx-6 tw-mb-4"
          v-mask="'#####-###'"
      />
      <Input
        v-else
        label="Rua"
        v-model="location.cep_or_street"
        name="location.street"
        type="text"
        placeholder="Digite a rua..."
        class="tw-mx-6 tw-mb-4"
      />
    </keep-alive>

    <div class="tw-h-96 tw-mx-auto tw-p-6">
      <client-only>
        <LazyMap
            :fullscreen="false"
        />
      </client-only>
    </div>
  </Form>
</template>

<script setup lang="ts">
import { type LocationCreateType } from "~/types/Location";

definePageMeta({
  name: 'location-create',
});

const selectViaCep = ref(true);

const location = ref<LocationCreateType>({
  cep_or_street: '',
  point: {
    latitude: 0,
    longitude: 0,
    photo: ''
  }
});

watch(selectViaCep, ($new) => {
  console.log($new);
});

</script>

<style scoped>

</style>