<template>
  <BackButton/>
  <Form @submit.prevent="submit">
    <div class="flex justify-center w-full">
      <ProgressBar :steps="steps" :currentStep="currentStep"/>
    </div>

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
          <li><strong>Nome:</strong> Coloque o nome detalhado do local.</li>
          <li><strong>Contato:</strong> Número telefonico do local com DDD, apenas o número.</li>
          <li><strong>Próximo:</strong> Clique em “Próximo” para continuar o cadastro.</li>
        </ol>
      </div>
    </Popup>
    <Input 
    label="Nome" 
    v-model="form.name" 
    name="name" 
    type="text" 
    class="tw-mx-6 tw-mb-4"
    placeholder="Unidade..."
    />
    <Input 
    label="Contato" 
    v-model="form.contact" 
    name="contact" 
    type="text" 
    class="tw-mx-6 tw-mb-4" 
    v-mask="'(##) # ####-####'"
    placeholder="(00) 0 0000-0000"
    />

    <Button class="tw-block tw-mx-auto tw-mt-8" type="submit">Próximo</Button>
  </Form>
</template>

<script setup lang="ts">
import DescriptionService from "~/services/DescriptionService";

const steps = ['Local', 'Descrição', 'Endereço', 'Serviços']; 
const currentStep = 2;

const showPopup = ref(false);

const route = useRoute()
const locationId = route.params.id

const form = ref({ name: '', contact: '' })

async function submit() {
  const id = Number(locationId)
  if (!Number.isInteger(id) || id <= 0) {
    console.error('ID do location inválido ao criar descrição:', locationId)
    return
  }

  const res = await DescriptionService.create(id, form.value)
  console.log('Resposta da API:', res)

    const descriptionId = res?.id ?? res?.location_id ?? res?.description_id
  if (descriptionId) {
      navigateTo(`/location/${id}/description/${descriptionId}/address/create`)
  } else {
    console.warn('Descrição criada, mas nenhum id retornado:', res)
  }
}
</script>
