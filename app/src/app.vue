<template>
  <NuxtLayout>
    <NuxtPage />
  </NuxtLayout>
</template>

<script setup lang="ts">
const token = useCookie('token');
const { $userStore: user } = useNuxtApp();
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