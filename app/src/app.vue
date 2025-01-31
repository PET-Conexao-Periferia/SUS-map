<template>
  <div>
    <NuxtLayout>
      <NuxtPage />
    </NuxtLayout>
  </div>
</template>


<script lang="ts">
export default defineComponent({
  name: 'App',

  mounted() {
    if(localStorage.getItem('token')) {
      this.$axios.defaults
          .headers
          .common['Authorization'] = `Bearer ${localStorage.getItem('token')}`
    }

    this.$axios.get('/sanctum/csrf-cookie');
  }
});
</script>