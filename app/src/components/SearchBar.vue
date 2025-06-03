<template>
  <input
      v-model="search"
      name="search.street"
      placeholder="Pesquisar rua..."
  />
</template>

<script setup lang="ts">
const search = ref('');
const { $locationStore } = useNuxtApp();
let timeout: NodeJS.Timeout | null = null; //debounce

watch(search, ($new) => {
  if($new) {
    if(timeout) {
      clearTimeout(timeout);
    }
    timeout = setTimeout(() => {
      $locationStore.searchLocation($new);
    }, 500);
  }
});
</script>

<style scoped lang="scss">
input {
  height: 50px;
  width: 100%;
  border: none;
  border-radius: 32px;
  background-color: #FEFEFE;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  padding: 1em;
  color: #6B7280;
  margin: 0;
  box-sizing: border-box;

  position: fixed;
  top: 5vh;
  left: 50%;
  right: 50%;
  transform: translateX(-50%);
  min-width: 80vw;
  max-width: 80vw;
}
input::placeholder {
  color: #6B7280 ;
}
input:focus{
  outline-color: #003087;
}
</style>