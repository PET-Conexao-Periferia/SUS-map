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
        <li><strong>Adicionar novo:</strong> Clique em “Adicionar novo” para salvar os serviços e continuar adicionando mais serviços.</li>
        <li><strong>Salvar:</strong> Clique em “Salvar Serviços” para concluir o cadastro.</li>
        </ol>
      </div>
    </Popup>

    <h2 class="tw-text-xl tw-font-semibold tw-mb-4">Selecionar Serviços</h2>

    <div class="tw-mb-6">
      <label class="tw-block tw-mb-2">Serviços:</label>
      <select v-model="selectedServices" multiple class="tw-w-full tw-p-2 tw-rounded-md tw-border">
        <option v-for="service in services" :key="service.id" :value="service.id">
          {{ service.name }}
        </option>
      </select>
    </div>

       <div v-if="selectedServiceObjects.length" class="tw-flex tw-flex-wrap tw-gap-2 tw-mb-6">
      <div
        v-for="service in selectedServiceObjects"
        :key="service.id"
        class="tw-bg-indigo-100 tw-text-indigo-700 tw-px-3 tw-py-1 tw-rounded-full tw-flex tw-items-center tw-gap-2 tw-text-sm tw-shadow-sm"
      >
        <span>{{ service.name }}</span>
        <button
          @click="removeService(service.id)"
          type="button"
          class="tw-text-indigo-500 hover:tw-text-red-500 tw-font-bold"
        >
          ×
        </button>
      </div>
    </div>
    
    <Button class="tw-block tw-mx-auto tw-mt-12" type="submit">
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

const selectedServiceObjects = computed(() => {
  return services.value.filter(service => selectedServices.value.includes(service.id))
})

// Remove serviço das tags
function removeService(id: number) {
  selectedServices.value = selectedServices.value.filter(s => s !== id)
}


onMounted(async () => {
  services.value = await ServiceService.getAll()
})

async function submit() {
  const response = await LocationService.attachServices(locationId, selectedServices.value)
  if (response) {
    selectedServices.value = []
    alert('Cadastro Concluido!')
   navigateTo(`/`)
  }
}
</script>
