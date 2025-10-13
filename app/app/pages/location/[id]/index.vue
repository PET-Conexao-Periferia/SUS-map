<template>
  <div class="tw-p-6 tw-bg-[#CCD2FF] tw-rounded-lg tw-shadow-md tw-m-6">
    <BackButton />

    <div v-if="location" class="tw-space-y-4">
      <!-- Foto -->
      <div v-if="location.photo" class="tw-flex tw-justify-center">
        <NuxtImg
          :src="location.photo.startsWith('http') 
          ? location.photo 
          : `http://localhost:8000/storage/${location.photo}`"
          alt="Foto do local"
          width="300"
          height="200"
          class="tw-rounded-lg tw-shadow-md"
        />
      </div>

      <!-- Descrição -->
      <div>
        <h2 class="tw-text-xl tw-font-semibold tw-text-gray-800">
          {{ location.description?.name }}
        </h2>
        <p class="tw-text-gray-600">Contato: {{ location.description?.contact }}</p>
      </div>

      <!-- Endereço -->
      <div v-if="location.description?.address">
        <h3 class="tw-font-semibold tw-mt-4">Endereço</h3>
        <p>
          {{ location.description.address.street }}, nº {{ location.description.address.number }},
          {{ location.description.address.district }} - CEP: {{ location.description.address.cep }}
        </p>
        <p>Referência: {{ location.description.address.reference }}</p>
      </div>

      <!-- Serviços -->
      <div v-if="location.services?.length">
        <h3 class="tw-font-semibold tw-mt-4">Serviços disponíveis</h3>
        <ul class="tw-list-disc tw-list-inside">
          <li v-for="service in location.services" :key="service.id">{{ service.name }}</li>
        </ul>
      </div>

      <!-- Campanhas -->
      <!-- <div v-if="location.campaigns?.length">
        <h3 class="tw-font-semibold tw-mt-4">Campanhas</h3>
        <ul class="tw-list-disc tw-list-inside">
          <li v-for="camp in location.campaigns" :key="camp.id">
            <strong>{{ camp.name }}</strong> — {{ camp.description }}
            <br />
            <small>Início: {{ camp.start_time }} | Fim: {{ camp.end_time }}</small>
          </li>
        </ul>
      </div> -->
    </div>

    <div v-else class="tw-text-center tw-text-gray-600">
      Carregando informações...
    </div>
  </div>
</template>

<script setup lang="ts">
import { useRoute } from 'vue-router';
import LocationService from '~/services/LocationService'

const route = useRoute();
const location = ref<any>(null);

onMounted(async () => {
  location.value = await LocationService.getLocationDetails(Number(route.params.id));
});
</script>
