<template>
  <Form @submit.prevent="submit">
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

    <div class="tw-h-96 tw-my-4">
      <client-only>
        <LazyMap
          :fullscreen="false"
          isRegisterPoint
          @pointSelected="(data: LocationType) => {
              location.point.latitude = data.latitude;
              location.point.longitude = data.longitude;
            }"
        />
      </client-only>
    </div>
    <Input
      label="Foto"
      name="location.point.photo"
      type="file"
      accept="image/*"
      class="tw-mx-6 tw-mb-4 tw-text-wrap tw-w-[90%]"
      @change="handlePhotoChange"
    />
    <div v-if="photoUrl">
      <h3 class="tw-text-center">Imagem selecionada:</h3>
      <img
        :src="photoUrl"
        alt="Imagem selecionada"
        class="tw-max-w-[15rem] tw-block tw-mx-auto"
      />
    </div>

    <Button class="tw-block tw-mx-auto tw-mt-12" type="submit">
      Cadastrar local
    </Button>
  </Form>
</template>

<script setup lang="ts">
import { type LocationCreateType, type LocationType } from "~/types/Location";
import LocationService from "~/services/LocationService";
import { ref, onUnmounted } from 'vue';

definePageMeta({
  showHeader: true,
  name: "location-create",
});

const selectViaCep = ref(true);

const location = ref<LocationCreateType>({
  cep_or_street: "",
  point: {
    latitude: 0,
    longitude: 0,
    photo: "",
  },
});

let currentObjectUrl: string | null = null
const photoUrl = ref<string | null>(null)

function handlePhotoChange(event: Event) {
  const target = event.target as HTMLInputElement;
  const file = target.files?.[0];

  if (!file) return;

  location.value = {
    ...location.value,
    point: {
      ...location.value.point,
      photo: file,
    },
  };

  if (currentObjectUrl) {
    try { URL.revokeObjectURL(currentObjectUrl) } catch (e) { /* ignore */ }
    currentObjectUrl = null
  }

  try {
    const url = URL.createObjectURL(file)
    currentObjectUrl = url
    photoUrl.value = url
  } catch (e) {
    photoUrl.value = null
  }
}

onUnmounted(() => {
  if (currentObjectUrl) {
    try { URL.revokeObjectURL(currentObjectUrl) } catch (e) { /* ignore */ }
    currentObjectUrl = null
  }
})

async function submit() {
  if (location.value.point.latitude && location.value.point.longitude) {
    try {
      const res = await LocationService.create(location.value.point);
      if (res) {
        navigateTo("/");
      }
    } catch (e) {
       console.error(e);
    }
  }
}
</script>

<style scoped></style>
