<template>
  <Form @submit.prevent="submit">
    <h2 class="tw-text-xl tw-font-bold tw-text-center tw-mb-6">Descrição do Local</h2>

    <Input label="Nome" v-model="form.name" name="name" type="text" class="tw-mx-6 tw-mb-4" />
    <Input label="Contato" v-model="form.contact" name="contact" type="text" class="tw-mx-6 tw-mb-4" />

    <Button class="tw-block tw-mx-auto tw-mt-8" type="submit">Próximo: Endereço</Button>
  </Form>
</template>

<script setup lang="ts">
import DescriptionService from "~/services/DescriptionService";

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
    console.warn('Descrição criadaaa, mas nenhum id retornado:', res)
  }
}
</script>
