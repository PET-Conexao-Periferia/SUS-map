<template>
  <NuxtLayout>
    <NuxtPage />
  </NuxtLayout>
</template>

<script setup lang="ts">
import useUserStore from "~/stores/useUserStore";

const token = useCookie('token');
const user = useUserStore();
if(token.value) {
  try {
    await user.fetch();
  } catch(e) {
    console.log(e);
    token.value = null;
  }
}

onMounted(() => {
  if(token) {
    user.fetchIsAdmin();
  }
  const { $axios } = useNuxtApp();
  $axios.get('/sanctum/csrf-cookie');
})
</script>