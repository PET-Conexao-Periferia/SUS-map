<template>
  <nav class="float-menu">
    <button @click="navigateTo('/')">
      <img src="~/assets/img/mapa.svg" alt="Icone de mapa" /><br />
      <span>Mapa</span>
    </button>
    <button @click="navigateTo('campaigns')">
      <img src="~/assets/img/campanhas.svg" alt="Icone de campanhas" /><br />
      <span>Campanhas</span>
    </button>
    <button @click="showMoreOptions()">
      <img src="~/assets/img/list.svg" alt="Icone de mais opções" /><br />
      <span>Mais</span>
    </button>
  </nav>
  <nav class="more-options" v-if="showMore" :ref="moreContent">
    <button
      v-if="$userStore.is_admin"
      @click="
        async () =>
          navigateTo({
            name: 'location-create',
          })
      "
      variant-select
    >
      Adicionar local
    </button>
    <Separator v-if="$userStore.data == null && $userStore.is_admin" />
    <button
      @click="navigateTo('/account/login')"
      v-if="$userStore.data == null"
    >
      Fazer login
    </button>
    <Separator v-if="$userStore.data !== null" />
    <button v-if="$userStore.data !== null" @click="AuthService.logout">
      Sair
    </button>
  </nav>
</template>

<script setup lang="ts">
import AuthService from "~/services/AuthService";

const { $userStore } = useNuxtApp();
const showMore = ref(false);
const moreContent = ref<HTMLElement | null>(null);

onMounted(() => {
  document.addEventListener("click", hideMoreOptions);
});

onBeforeUnmount(() => {
  document.removeEventListener("click", hideMoreOptions);
});

function showMoreOptions() {
  showMore.value = !showMore.value;
}

function hideMoreOptions(event: MouseEvent) {
  const menu = moreContent.value as HTMLElement;
  if (menu && !menu.contains(event.target as Node)) {
    showMore.value = false;
  }
}
</script>

<style scoped>
.float-menu {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  position: fixed;
  left: 50%;
  padding: 1em;
  border-radius: 3em;
  transform: translateX(-50%);
  bottom: 5vh;
  min-width: 80vw;
  max-width: 80vw;
  background-color: #ffffff;
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
}
.more-options {
  display: flex;
  border-radius: 16px;
  left: 90%;
  transform: translateX(-90%);
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
  bottom: 16vh;
  background-color: #ffffff;
  min-width: 25vw;
  max-width: 25vw;
  padding: 1em;
  flex-flow: column;
  position: fixed;
}
button {
  border: none;
  background-color: transparent;
}
img {
  width: 24px;
  height: 24px;
}
</style>
