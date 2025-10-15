<template>
  <nav class="float-menu">
    <button 
    :class="{isCurrentPage: route.path === '/'}"
    @click="navigateTo('/')"
    >
      <img src="~/assets/img/mapa.svg" alt="Icone de mapa" /><br />
      <span>Mapa</span>
    </button>

    <button 
    :class="{isCurrentPage: route.path === '/campaigns'}"
    @click="navigateTo('campaigns')"
    >
      <img src="~/assets/img/campanhas.svg" alt="Icone de campanhas" /><br />
      <span>Campanhas</span>
    </button>

    <button
    @click="showMoreOptions()" 
    :class="{isCurrentPage: showMore === true}" 
    ref="dropdown"
    >
      <img src="~/assets/img/list.svg" alt="Icone de mais opções" /><br />
      <span>Mais</span>
    </button>

  </nav>
  <!-- menu supenso -->
  <nav class="more-options" v-if="showMore">
    
    <button
      v-if="$userStore.is_admin"
      @click="
        async () =>{
           navigateTo({
            name: 'location-create',
          })
        }
      "
      variant-select
    >
      Adicionar local
    
    </button>
    
    <Separator v-if="$userStore.data !== null && $userStore.is_admin" />
    <button
      v-if="$userStore.is_admin"
      @click="
        async () =>{
           navigateTo('/service/show')
        }
      "
      variant-select
    >
      Adicionar Serviços
    
    </button>
    
    <Separator v-if="$userStore.data !== null && $userStore.is_admin" />

     <button
      v-if="$userStore.is_admin"
      @click="
        async () =>{
           navigateTo('/campaigns/new')
        }
      "
      variant-select
    >
      Nova campanha
    
    </button>
    
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
import { AuthService } from "~/services/";

const { $userStore } = useNuxtApp();
const showMore = ref(false);
const dropdown = ref(false);

const route = useRoute()

function showMoreOptions() {
  showMore.value = !showMore.value;
}
//Fecha o menu quando clica na opção
function selectOption() {
  showMore.value = false
}
//Fecha o menu quando clica fora dele
function handleClickOutside(event) {
  if (dropdown.value && !dropdown.value.contains(event.target)) {
    showMore.value = false
  }
}
onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onBeforeUnmount(() => {
  document.removeEventListener('click', handleClickOutside)
})

</script>

<style scoped>
.float-menu {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  position: fixed;
  left: 50%;
  border-radius: 3em;
  transform: translateX(-50%);
  bottom: 5vh;
  min-width: 90vw;
  max-width: 90vw;
  min-height: 5em;
  max-height: 5em;
  background-color: #ffffff;
  cursor: pointer;
   overflow: hidden;
  z-index: 2147483647; /*isso seria o número maximo que um navegador permite*/
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);

  @media (min-width: 768px) and (orientation: landscape) {
  min-width: 50vw;
  max-width: 50vw;
}
}

.more-options {
  display: flex;
  border-radius: 16px;
  left: 88%;
  transform: translateX(-90%);
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
  bottom: 16vh;
  background-color: #ffffff;
  min-width: 28vw;
  max-width: 28vw;
  padding: 1em;
  z-index: 2147483647;  /*isso seria o número maximo que um navegador permite*/
  flex-flow: column;
  position: fixed;

  @media (min-width: 768px) and (orientation: landscape) {
    min-width: 15vw;
    max-width: 15vw;
    left: 73%;
}
}
button {
  min-height: 5em;
  border: none;
  background-color: transparent;
  cursor: pointer;
  overflow: hidden;
}
.isCurrentPage{
  border-bottom: 3px #003087 solid;
}
button:hover{
  border-bottom: 3px #003087 solid;
}
button:active{
  border-bottom: 3px #003087 solid;
}
img {
  width: 24px;
  height: 24px;
}
</style>
