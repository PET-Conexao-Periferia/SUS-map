<template>
  <div class="tw-max-w-2xl tw-mx-auto tw-p-6">
    <!-- Botão de voltar -->
    <BackButton />

    <!-- Container principal -->
    <div class="tw-bg-[#CCD2FF] tw-rounded-2xl tw-shadow-lg tw-p-6">
      <Logo />
      <div class="tw-flex tw-justify-between tw-items-center tw-mb-6">
        <h2 class="tw-text-2xl tw-font-bold">Serviços Cadastrados</h2>

        <!-- Botão de novo serviço -->
        <button
          @click="navigateTo('/service/create')"
          class="tw-bg-blue-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-lg tw-font-medium hover:tw-bg-blue-700 tw-transition"
        >
          Novo
        </button>
      </div>

      <!-- Lista de serviços -->
      <ul v-if="services.length" class="tw-space-y-2">
        <li
          v-for="service in services"
          :key="service.id"
          class="tw-bg-white tw-border tw-rounded-xl tw-p-3 tw-shadow-sm hover:tw-bg-blue-50 tw-transition"
        >
          {{ service.name }}
        </li>
      </ul>

      <p v-else class="tw-text-center tw-text-gray-500 tw-italic">
        Nenhum serviço cadastrado ainda.
      </p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import ServiceService from '~/services/ServiceService'

interface Service {
  id: number
  name: string
}

const services = ref<Service[]>([])

onMounted(async () => {
  try {
    const res = await ServiceService.getAll()
    services.value = res || []
  } catch (e) {
    console.error('Erro ao buscar serviços:', e)
  }
})
</script>

<style scoped lang="scss">
ul {
  padding: 0;
}
li {
  list-style: none;
}
</style>
