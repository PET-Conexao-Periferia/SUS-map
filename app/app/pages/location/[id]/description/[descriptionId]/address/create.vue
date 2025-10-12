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
         <li><strong>Rua:</strong> Coloque o nome completo da rua do local.</li>
          <li><strong>Número:</strong> Número do local na rua.</li>
          <li><strong>Bairro:</strong> Bairro onde o local está situado.</li>
          <li><strong>CEP:</strong> Código de Endereçamento Postal do local.</li>
          <li><strong>Referência:</strong> Ponto de referência próximo ao local (opcional).</li>
          <li><strong>Próximo:</strong> Clique em “Próximo” para continuar o cadastro.</li>
        </ol>
      </div>
    </Popup>

    <h2 class="tw-text-xl tw-font-bold tw-text-center tw-mb-6">Endereço</h2>

    <Input label="Rua" v-model="form.street" name="street" class="tw-mx-6 tw-mb-4" />
    <Input label="Número" v-model="form.number" name="number" type="number" class="tw-mx-6 tw-mb-4" />
    <Input label="Bairro" v-model="form.district" name="district" class="tw-mx-6 tw-mb-4" />
    <Input label="CEP" v-model="form.cep" name="cep" v-mask="'#####-###'" class="tw-mx-6 tw-mb-4" />
    <Input label="Referência" v-model="form.reference" name="reference" class="tw-mx-6 tw-mb-4" />

    <Button class="tw-block tw-mx-auto tw-mt-8" type="submit">Proximo</Button>
  </Form>
</template>

<script setup lang="ts">
import AddressService from '~/services/AddressService'
import { useRoute, useRouter } from 'vue-router'

const steps = ref(['Local', 'Descrição', 'Endereço', 'Serviços'])
const currentStep = ref(3)

const showPopup = ref(false);

const route = useRoute()
const router = useRouter()
const locationId = route.params.id
const descriptionId = Number(route.params.descriptionId)

const form = ref({
  street: '',
  number: 0,
  district: '',
  cep: '',
  reference: '',
})

async function submit() {
  if (descriptionId) {
  try {
      const res = await AddressService.create(descriptionId, form.value)

  if (res?.id || res?.description_id) {
    console.log('Endereço criado:', res)
    navigateTo(`/location/${locationId}/service/create`)
    } 
    } catch (e) {
      console.error('Erro ao criar endereço:', e)
    }
  }
  
}
</script>
