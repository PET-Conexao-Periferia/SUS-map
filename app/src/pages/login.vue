<template>
<form @submit.prevent="submit">
  <input v-model="user.email" placeholder="Email" />
  <br />
  <input v-model="user.password" placeholder="Password" />
  <br />
  <button type="submit">Login</button>
</form>
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