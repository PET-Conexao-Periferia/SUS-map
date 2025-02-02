<template>
<Form @submit.prevent="submit" class="tw-mx-12 tw-mt-24">
  <img
      src="~/assets/img/logo-pet-horizontal.svg"
      alt="logo do PET - Conexão Periferia"
      class="tw-block tw-mx-auto"
  />
  <p
      class="tw-px-3 tw-mt-12 tw-mb-9"
  >
    Faça seu cadastro e receba notificações sobra campanhas de vacinação!
  </p>

  <Input
      label="Nome"
      v-model="user.name"
      type="text"
      placeholder="Digite seu nome..."
      class="tw-mx-6 tw-mb-4"
      :validation="validationName"
      message-error="Nome inválido"
  />

  <Input
      label="E-mail"
      v-model="user.email"
      type="email"
      placeholder="Digite seu e-mail..."
      class="tw-mx-6 tw-mb-4"
      :validation="validationEmail"
      message-error="E-mail inválido"
  />

  <Input
      label="Senha"
      v-model="user.password"
      type="password"
      placeholder="Digite sua senha..."
      class="tw-mx-6 tw-mb-4"
      :validation="validationPassword"
      message-error="Senha inválida"
  />

  <Input
      label="Confirmar Senha"
      v-model="user.password_confirmation"
      type="password"
      placeholder="Confirme sua senha..."
      class="tw-mx-6 tw-mb-4"
      :validation="validationPasswordConfirmation"
      message-error="Senhas diferentes"
  />

  <Button type="submit" class="tw-block tw-mx-auto tw-mt-12">
    Cadastro
  </Button>
</Form>
</template>

<script lang="ts">
import {defineComponent} from 'vue'
import User from '~/classes/User';
import {type AxiosError, type AxiosResponse} from "axios";
import useUserStore from "~/stores/use-user-store";
import { z } from 'zod';

export default defineComponent({
  name: "register",

  data() {
    const user = new User({
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
    });

    return {
      user,
      userStore: null as null | useUserStore
    }
  },

  methods: {
    async submit() {
      if(
        this.user.name &&
        this.user.email &&
        this.user.password &&
        this.user.password_confirmation &&
        this.validationName(this.user.name) &&
        this.validationEmail(this.user.email) &&
        this.validationPassword(this.user.password) &&
        this.validationPasswordConfirmation(this.user.password_confirmation)
      ) {
        try {
          const res = await this.user.register(this.$axios);
          if(typeof res === 'object' && 'data' in res) {
            const token = res.data.token;
            this.$axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            localStorage.setItem('token', token);

            await this.userStore?.data.fetch(this.$axios);
            this.$router.push('/');
          }
        } catch (e: AxiosResponse | AxiosError | any) {
          console.log(e);
        }
      }
    },
    validationName(value: any) {
      if(!value) return false;
      return value.length > 0;
    },
    validationEmail(value: any) {
      if(!value) return false;
      const emailSchema = z.string().email();
      return emailSchema.safeParse(value).success;
    },
    validationPassword(value: any) {
      if(!value) return false;
      const passwordSchema = z.string().min(6);
      return passwordSchema.safeParse(value).success;
    },
    validationPasswordConfirmation(value: any) {
      if(!value) return false;
      return value === this.user.password;
    }
  },

  mounted() {
    this.userStore = useUserStore();
  }
})
</script>
