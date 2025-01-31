<template>
<Form @submit.prevent="submit" class="tw-mt-40 tw-mx-14">

  <img
      src="~/assets/img/logo-pet-horizontal.svg"
      alt="logo do PET - Conexão Periferia"
      class="tw-block tw-mx-auto tw-mb-14"
  />

  <Input
      label="E-mail"
      v-model="user.email"
      placeholder="Digite seu e-mail..."
      class="tw-mb-5 tw-mx-6"
  />

  <Input
      label="Senha"
      v-model="user.password"
      placeholder="Digite sua senha..."
      class="tw-mb-14 tw-mx-6"
  />

  <Button
      type="submit"
      class="tw-block tw-mx-auto"
  >
    Login
  </Button>
</Form>
</template>

<script lang="ts">
import {defineComponent} from 'vue'
import User from "~/classes/User";
import useUserStore from "~/stores/use-user-store";
import AuthService from "~/services/AuthService";

export default defineComponent({
  name: "login",

  data() {
    const user = new User({
      email: '',
      password: ''
    });

    return {
      user,
      userStore: null as null | useUserStore
    }
  },

  methods: {
    async submit() {
      const res = await AuthService.login(this.$axios, this.user);

      if(res) {
        this.userStore?.data.fetch(this.$axios);
      }
    }
  },

  mounted() {
    this.userStore = useUserStore();
  }
})
</script>

<style scoped>

</style>