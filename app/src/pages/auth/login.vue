<template>
<Form @submit.prevent="submit" class="tw-mt-40 tw-mx-14">

  <img
      src="~/assets/img/logo-pet-horizontal.svg"
      alt="logo do PET - Conexão Periferia"
      class="tw-block tw-mx-auto tw-mb-14"
  />

  <Input
      label="E-mail"
      type="email"
      v-model="user.email"
      placeholder="Digite seu e-mail..."
      class="tw-mb-5 tw-mx-6"
      :error="logErrors.email"
  >
    <ErrorMessage message-error="E-mail inválido" />
  </Input>

  <Input
      label="Senha"
      type="password"
      v-model="user.password"
      placeholder="Digite sua senha..."
      class="tw-mb-14 tw-mx-6"
      :error="logErrors.password"
  >
    <ErrorMessage message-error="Senha inválida" />
  </Input>

  <Button
      type="submit"
      class="tw-block tw-mx-auto"
  >
    Login
  </Button>
</Form>
</template>

<script setup lang="ts">
import AuthService from "~/services/AuthService";
import { loginSchema } from "~/validations/userSchemaValidation";

const user = ref({
  email: '',
  password: ''
});
const logErrors = ref({
  email: false,
  password: false,
});
const { $userStore } = useNuxtApp();

watch(user, () => {
  validated();
}, {
  deep: true,
})

async function submit() {
  if(
      user.value.email &&
      user.value.password &&
      validated()
  ) {
    const res = await AuthService.login(user.value);

    if(res) {
      await $userStore.fetch();
      navigateTo('/');
    }
  }
}
function validated() {
  const result = loginSchema.safeParse(user.value);

  logErrors.value.email = false;
  logErrors.value.password = false;

  if(!result.success) {
    const errors = result.error.issues;
    for(const error of errors) {
      //@ts-ignore
      if(typeof logErrors.value[String(error.path[0])] === 'boolean') {
        //@ts-ignore
        logErrors.value[String(error.path[0])] = true;
      }
    }
  }
  return result.success;
}
</script>

<style scoped>

</style>