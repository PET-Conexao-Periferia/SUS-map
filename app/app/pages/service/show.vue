<template>
  <div class="tw-p-6 tw-text-white">
    <h2 class="tw-text-2xl tw-font-bold tw-text-center tw-mb-6 ">Serviços Cadastrados</h2>

    <ul v-if="services.length" class="tw-space-y-2">
      <li v-for="service in services" :key="service.id" class="tw-border tw-rounded-xl tw-p-1 tw-shadow-sm hover:tw-bg-gray-50">
        {{ service.name }}
      </li>
    </ul>

    <p v-else class="tw-text-center tw-text-gray-500">Nenhum serviço cadastrado ainda.</p>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import ServiceService from '~/services/ServiceService'

interface Service {
  name: string,
  id: number,
  // add other properties if needed
}

const services = ref<Service[]>([])

onMounted(async () => {
  services.value = await ServiceService.getAll()
})
</script>
