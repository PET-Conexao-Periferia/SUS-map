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
      placeholder="Digite seu nome..."
      class="tw-mx-6 tw-mb-4"
  />

  <Input
      label="E-mail"
      v-model="user.email"
      placeholder="Digite seu e-mail..."
      class="tw-mx-6 tw-mb-4"
  />

  <Input
      label="Senha"
      v-model="user.password"
      placeholder="Digite sua senha..."
      class="tw-mx-6 tw-mb-4"
  />

  <Input
      label="Confirmar Senha"
      v-model="user.password_confirmation"
      placeholder="Confirme sua senha..."
      class="tw-mx-6 tw-mb-4"
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
      await this.user.register(this.$axios)
          .then((res: AxiosResponse) => {
            const token = res.data.token;
            this.$axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            localStorage.setItem('token', token);
          })
          .catch((error: AxiosError) => {
            console.log(error);
          });
      await this.userStore?.data.fetch(this.$axios);
      this.$router.push('/');
    }
  },

  mounted() {
    this.userStore = useUserStore();
  }
})
</script>
