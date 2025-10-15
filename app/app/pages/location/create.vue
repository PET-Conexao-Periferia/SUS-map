<template>
    <LayoutHeader>
      <p class="tw-text-center">Adicionar local</p>
       <div class="tw-ml-auto">
        <button
            @click="showPopup = true"
            type="button"
            class="tw-bg-blue-700 tw-text-white tw-rounded-full tw-w-8 tw-h-8 tw-flex tw-items-center tw-justify-center tw-font-bold tw-shadow-md hover:tw-bg-blue-500 tw-transition"
          >
            ?
      </button>
    </div>
    </LayoutHeader>
  <Form @submit.prevent="submit">
     <ProgressBar :steps="steps" :currentStep="currentStep" />


    <!-- Popup de ajuda -->
    <Popup :isVisible="showPopup" @close="showPopup = false">
      <div>
        <h2 class="tw-text-lg tw-font-bold tw-text-center tw-mb-2">Como preencher os campos?</h2>
        <ol class="tw-list-decimal tw-list-inside tw-space-y-2">
          <li><strong>Encontre o local:</strong> Selecione “CEP” ou “Rua”, ou marque o local manualmente no mapa.</li>
          <li><strong>Foto:</strong> Adicione a imagem do local desejado.</li>
          <li><strong>Próximo:</strong> Clique em “Próximo” para continuar o cadastro.</li>
        </ol>
      </div>
    </Popup>
    
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

    <div class="tw-h-80 tw-mb-14 tw-mt-4 tw-mx-0">
      <p>Selecione o local no mapa:</p>
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
    <div>
      <Input
      label="Adicione uma foto do local:"
      name="location.point.photo"
      type="file"
      accept="image/*"
      class="tw-mx-6 tw-mb-4 tw-text-wrap tw-w-[90%]"
      @change="handlePhotoChange"
    />
    </div>

    <div v-if="photoUrl">
      <h3 class="tw-text-center">Imagem selecionada:</h3>
      <img
        :src="photoUrl"
        alt="Imagem selecionada"
        class="tw-max-w-[15rem] tw-block tw-mx-auto"
      />
    </div>

    <Button class="tw-block tw-mx-auto tw-mt-12" type="submit"
    >
    Próximo
    <img 
    src="/assets/img/arrow_right.svg"
    height="20"
    width="20"
    />
    </Button>
  </Form>
</template>

<script setup lang="ts">
import { type LocationCreateType, type LocationType } from "~/types/location.type";
import LocationService from "~/services/LocationService";
import { ref, onUnmounted } from 'vue';
import Popup from '~/components/Popup.vue';
import ProgressBar from '~/components/ProgressBar.vue';

definePageMeta({
  showHeader: true,
  name: "location-create",
});

const showPopup = ref(false);
const steps = ['Local', 'Descrição', 'Endereço', 'Serviços'];
const currentStep = 1;

const selectViaCep = ref(true);

const location = ref<LocationCreateType>({
  cep_or_street: "",
  point: {
    latitude: 0,
    longitude: 0,
    photo: "",
  },
});

let currentObjectUrl: string | null = null;
const photoUrl = ref<string | null>(null);

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
    try {
      URL.revokeObjectURL(currentObjectUrl);
    } catch (e) {
      /* ignore */
    }
    currentObjectUrl = null;
  }

  try {
    const url = URL.createObjectURL(file);
    currentObjectUrl = url;
    photoUrl.value = url;
  } catch (e) {
    photoUrl.value = null;
  }
}

onUnmounted(() => {
  if (currentObjectUrl) {
    try {
      URL.revokeObjectURL(currentObjectUrl);
    } catch (e) {
      /* ignore */
    }
    currentObjectUrl = null;
  }
});

async function submit() {
  if (location.value.point.latitude && location.value.point.longitude) {
    try {
      const res = await LocationService.create(location.value.point)
       console.log('Resposta da API:', res)
      if (res?.id) {
        navigateTo(`/location/${res.id}/description/create`);
      }
    } catch (e) {
      console.error(e);
    }
  }
}
</script>

<style scoped>
</style>
