<template>
  <Form @submit.prevent="submit">
    <h2 class="tw-text-xl tw-font-bold tw-text-center tw-mb-6">Endereço</h2>

    <Input label="Rua" v-model="form.street" name="street" class="tw-mx-6 tw-mb-4" />
    <Input label="Número" v-model="form.number" name="number" class="tw-mx-6 tw-mb-4" />
    <Input label="Bairro" v-model="form.district" name="district" class="tw-mx-6 tw-mb-4" />
    <Input label="CEP" v-model="form.cep" name="cep" class="tw-mx-6 tw-mb-4" />
    <Input label="Referência" v-model="form.reference" name="reference" class="tw-mx-6 tw-mb-4" />

    <Button class="tw-block tw-mx-auto tw-mt-8" type="submit">Próximo: Serviços</Button>
  </Form>
</template>

<script setup lang="ts">
import AddressService from '~/services/AddressService'
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()
const locationId = route.params.id
const descriptionId = Number(route.params.descriptionId)

const form = ref({
  street: '',
  number: '',
  district: '',
  cep: '',
  reference: '',
})

async function submit() {
  if (!descriptionId) return
  const res = await AddressService.create(descriptionId, form.value)

  if (res?.id || res?.description_id) {
    console.log('Endereço criado:', res)
    await router.push('/')
  } else {
    console.warn('Endereço criado, mas sem id retornado:', res)
  }
}
</script>
