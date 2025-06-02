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
    user.fetch();
  } catch(e) {
    token.value = null;
  }
}

onBeforeMount(async () => {
  const { $axios } = useNuxtApp();
  $axios.get('/sanctum/csrf-cookie');

  const points = localStorage.getItem('points');
  if(points) {
    const { $locationStore } = useNuxtApp();
    $locationStore.points = JSON.parse(points);
  }
});

</script>