<template>
<Form @submit.prevent="submit">
    <Logo /> 
     <ProgressBar :steps="steps" :currentStep="currentStep" />

      <div class="tw-absolute tw-top-4 tw-right-4">
          <button
            @click="showPopup = true"
            type="button"
            class="tw-bg-blue-300 tw-text-white tw-rounded-full tw-w-8 tw-h-8 tw-flex tw-items-center tw-justify-center tw-font-bold tw-shadow-md hover:tw-bg-blue-400 tw-transition"
          >
            ?
      </button>
      </div>

    <!-- Popup de ajuda -->
    <Popup :isVisible="showPopup" @close="showPopup = false">
      <div>
        <h2 class="tw-text-lg tw-font-bold tw-text-center tw-mb-2">Como preencher os campos?</h2>
        <ol class="tw-list-decimal tw-list-inside tw-space-y-2">
        <li><strong>Serviço:</strong> Selecione 1 (um) ou mais Serviços que o Local oferece.</li>
        <li><strong>Salvar:</strong> Clique em “Salvar Serviços” para concluir o cadastro.</li>
        </ol>
      </div>
    </Popup>

    <h2 class="tw-text-xl tw-font-semibold tw-mb-4">Selecionar serviços disponíveis</h2>

    <div class="tw-mb-6">
      <label class="tw-block tw-mb-2">Serviços:</label>
      <select v-model="selectedServices" multiple class="tw-w-full tw-p-2 tw-rounded-md tw-border">
        <option v-for="service in services" :key="service.id" :value="service.id">
          {{ service.name }}
        </option>
      </select>
    </div>

    <Button
      type="submit"
      class="tw-bg-[#4F46E5] tw-text-white tw-px-4 tw-py-2 tw-rounded-md hover:tw-bg-[#4338CA]"
    >
      Salvar
    </Button>
 
  </Form>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import ServiceService from '~/services/ServiceService'
import LocationService from '~/services/LocationService'

const route = useRoute()
const router = useRouter()

const steps = ref(['Local', 'Descrição', 'Endereço', 'Serviços'])
const currentStep = ref(4)

const showPopup = ref(false);

interface Service {
  id: number
  name: string
}

const locationId = Number(route.params.id)
// const services = ref([])

const services = ref<Service[]>([])
const selectedServices = ref<number[]>([])

onMounted(async () => {
  services.value = await ServiceService.getAll()
})

async function submit() {
  const response = await LocationService.attachServices(locationId, selectedServices.value)
  if (response) {
    alert('Cadastro Concluido!')
   navigateTo(`/`)
  }
}
</script>
