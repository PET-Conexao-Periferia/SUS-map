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
      :validation="validationEmail"
      message-error="E-mail inválido"
  />

  <Input
      label="Senha"
      type="password"
      v-model="user.password"
      placeholder="Digite sua senha..."
      class="tw-mb-14 tw-mx-6"
      :validation="validationPassword"
      message-error="Senha inválida"
  />

  <Button
      type="submit"
      class="tw-block tw-mx-auto"
  >
    Login
  </Button>
</Form>
  <pre>
    {{user}}
  </pre>
</template>

<script lang="ts">
import {defineComponent} from 'vue'
import User from "~/classes/User";
import useUserStore from "~/stores/use-user-store";
import AuthService from "~/services/AuthService";
import { z } from "zod";

export default defineComponent({
  name: "login",

  data() {
    const user = new User({
      email: '',
      password: ''
    });

    return {
      user,
      userStore: null as null | useUserStore,
    }
  },

  methods: {
    async submit() {
      if(
          this.user.email &&
          this.user.password &&
          this.validationEmail(this.user.email) &&
          this.validationPassword(this.user.password)
      ) {
        const res = await AuthService.login(this.$axios, this.user);

        if(res) {
          await this.userStore?.data.fetch(this.$axios);
          this.$router.push('/');
        }
      }
    },
    validationEmail(value: string): boolean {
      const emailSchema = z.string().email();
      return emailSchema.safeParse(value).success;
    },
    validationPassword(value: string): boolean {
      const passwordSchema = z.string().min(6);
      return passwordSchema.safeParse(value).success;
    }
  },

  mounted() {
    this.userStore = useUserStore();
  },
})
</script>

<style scoped>

</style>