<template>
  <!-- Botão de voltar -->
  <BackButton />
  <Form>
    <h2 class="tw-text-center">Serviços Cadastrados</h2>
    <!-- Lista de serviços -->
    <Button @click="navigateTo('/service/create')" class="tw-mx-auto">
      Adicionar novo serviço
    </Button>
    <ul v-if="services.length" class="tw-space-y-2">
      <li v-for="service in services" :key="service.id"
        class="tw-bg-white tw-border tw-rounded-xl tw-p-3 tw-shadow-sm hover:tw-bg-blue-50 tw-transition">
        {{ service.name }}
      </li>
    </ul>

    <p v-else class="tw-text-center tw-text-gray-500 tw-italic">
      Nenhum serviço cadastrado ainda.
    </p>
  </Form>
</template>

<script setup lang="ts">
import { ServiceService } from '~/services/'

interface Service {
  id: number
  name: string
}

const services = ref<Service[]>([])

try {
  const res = await ServiceService.getAll()
  services.value = res || []
} catch (e) {
  console.error('Erro ao buscar serviços:', e)
}
</script>

<style scoped lang="scss">
ul {
  padding: 0;
}

li {
  list-style: none;
}
</style>
