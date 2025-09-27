<template>
<Form @submit.prevent="submit" class="tw-mt-24">
  <Logo />
  <p
      class="tw-px-3 tw-mt-0 tw-mb-9"
  >
    Faça seu cadastro para receber notificações sobre campanhas de vacinação!
  </p>

  <Input
      label="Nome"
      v-model="user.name"
      name="user.name"
      type="text"
      placeholder="Digite seu nome..."
      class="tw-mx-6 tw-mb-4"
      :error="logErrors.name"
  >
    <ErrorMessage message-error="Nome inválido" />
  </Input>

  <Input
      label="E-mail"
      v-model="user.email"
      name="user.email"
      type="email"
      placeholder="Digite seu e-mail..."
      class="tw-mx-6 tw-mb-4"
      :error="logErrors.email"
  >
    <ErrorMessage message-error="Email inválido" />
  </Input>

  <Input
      label="Senha"
      v-model="user.password"
      name="user.password"
      type="password"
      placeholder="Digite sua senha..."
      class="tw-mx-6 tw-mb-4"
      :error="logErrors.password"
  >
    <ErrorMessage message-error="Senha inválida" />
  </Input>

  <Input
      label="Confirmar Senha"
      v-model="user.password_confirmation"
      name="user.password_confirmation"
      type="password"
      placeholder="Confirme sua senha..."
      class="tw-mx-6 tw-mb-4"
      :error="logErrors.password_confirmation"
  >
    <ErrorMessage message-error="Senha não corresponde" />
  </Input>

  <Button type="submit" class="tw-block tw-mx-auto tw-mt-5">
    Cadastro
  </Button>

  <NuxtLink
      to="/account/login"
      class="tw-block tw-mx-auto tw-mt-5"
  >
    Fazer login
  </NuxtLink>
</Form>
</template>

<script setup lang="ts">
import { type AxiosError, type AxiosResponse } from "axios";
import AuthService from "~/services/AuthService";
import { registerSchema } from "~/validations/userSchemaValidation";

definePageMeta({
  showHeader: true,
  name: 'register',
});

const user = ref({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});
const logErrors = ref({
  name: false,
  email: false,
  password: false,
  password_confirmation: false,
});

watch(user, () => {
  validated();
}, {
  deep: true,
})

const { $userStore } = useNuxtApp();

async function submit() {
  if(
      user.value.name &&
      user.value.email &&
      user.value.password &&
      user.value.password_confirmation &&
      validated()
  ) {
    try {
      const res = await AuthService.register(user.value);
      if(res) {
        await $userStore.fetch();
        navigateTo('/');
      }
    } catch (e: AxiosResponse | AxiosError | any) {
      //
    }
  }
}
function validated() {
  const result = registerSchema.safeParse(user.value);

  logErrors.value.name = false;
  logErrors.value.email = false;
  logErrors.value.password = false;
  logErrors.value.password_confirmation = false;

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
<style scoped lang="scss">
Form{
  transform: translateY(-10%);
}
</style>
