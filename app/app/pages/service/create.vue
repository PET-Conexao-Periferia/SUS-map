<template>
<Form @submit.prevent="submit">
  <Logo />

  <h2 class="tw-text-xl tw-font-bold tw-text-center tw-mb-6">Serviços</h2>

    <Input label="Nome" v-model="form.name" name="name" type="text" class="tw-mx-6 tw-mb-4" />

    <Button class="tw-block tw-mx-auto tw-mt-8" type="submit">Cadastrar</Button>
</Form>
</template>

<script setup lang="ts">
import ServiceService from '~/services/ServiceService'

const form = ref({
  name: '',
})

async function submit() {
  if (!form.value.name) {
    console.warn('Nome do serviço é obrigatório')
    return
  }

  try {
    const res = await ServiceService.create(form.value)
    if (res) {
      navigateTo("/")
    }
  } catch (e) {
    console.error("Erro ao cadastrar serviço:", e)
  }
}
</script>

<style scoped lang="scss">

</style>