<template>
  <BackButton />
  <Form @submit.prevent="submit">
    <h2 class="tw-text-center">Cadastrar Serviços</h2>
    <p>Cadastre um novo serviço oferecido por uma das Unidades SUS Cadastradas!</p>

    <Input label="Nome" v-model="form.name" name="name" type="text" placeholder="Digite o nome do serviço"
      class="tw-mx-6 tw-mb-4" />

    <Button class="tw-block tw-mx-auto tw-mt-8" type="submit">Cadastrar</Button>
  </Form>
</template>

<script setup lang="ts">
import { ServiceService } from '~/services/'

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
      navigateTo("/service/show")
    }
  } catch (e) {
    console.error("Erro ao cadastrar serviço:", e)
  }
}
</script>

<style scoped lang="scss"></style>