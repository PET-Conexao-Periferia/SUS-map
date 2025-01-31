<template>
<form @submit.prevent="submit">
  <input v-model="user.name" placeholder="Name" />
  <br />
  <input v-model="user.email" placeholder="Email" />
  <br />
  <input v-model="user.password" placeholder="Password" />
  <br />
  <input v-model="user.password_confirmation" placeholder="Password Confirmation" />
  <br />
  <button type="submit">Register</button>
</form>
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
      this.user.register(this.$axios)
          .then((res: AxiosResponse) => {
            const token = res.data.token;
            this.$axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            localStorage.setItem('token', token);
            this.userStore?.data.fetch();
          })
          .catch((error: AxiosError) => {
            console.log(error);
          });
    }
  },

  mounted() {
    this.userStore = useUserStore();
  }
})
</script>
