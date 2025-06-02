<template>
  <nav class="float-menu">
    <button @click="navigateTo('/')">
      <img src="../../assets/img/mapa.svg"><br>
      <span>Mapa</span>
    </button>
    <button>
      <img src="../../assets/img/campanhas.svg"><br>
      <span>Campanhas</span>
    </button>
    <button @click="showMoreOptions()">
      <img src="../../assets/img/list.svg"><br>
      <span>Mais</span>
    </button>
  </nav>
  <nav class="more-options" v-if="showMore" ref="moreContent">
    <button
        @click="navigateTo('/account/login')"
        v-if="$userStore.data == null"
    >
      Fazer login
    </button>
    <Separator v-if="$userStore.data !== null"/>
    <button
        v-if="$userStore.data !== null"
        @click="AuthService.logout; selectOptions()"

    >
      Sair
    </button>
  </nav>
  <slot/>
</template>

<script lang="ts">
import AuthService from "~/services/AuthService";

export default {
  name:"Float",
  computed: {
    AuthService() {
      return AuthService
    }
  },
  data(){
    return{
      showMore: false,
    }
  },
  methods:{
    showMoreOptions(){
      this.showMore = !this.showMore
    }
  },
  hideMoreOptions(event: MouseEvent){
    const menu= this.$refs.moreContent as HTMLElement;
    if (menu && !menu.contains(event.target as Node)){
      this.showMore = false
    }
  },
  selectOptions(){
    this.showMore = !this.showMore
  },
  mounted() {
    document.addEventListener("click",this.hideMoreOptions);
    document.addEventListener("click",this.hideMoreOptions);
  },
  beforeUpdate() {
    document.removeEventListener("click",this.hideMoreOptions);
  }
}
</script>

<style scoped>
.float-menu{
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  position:fixed;
  left:50%;
  padding: 1em;
  border-radius: 3em;
  transform: translateX(-50%);
  bottom: 5vh;
  min-width: 80vw;
  max-width: 80vw;
  background-color: #FFFFFF;
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
}
.more-options{
  display: flex;
  border-radius: 16px;
  left:90%;
  transform: translateX(-90%);
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
  bottom: 16vh;
  background-color: #FFFFFF;
  min-width: 25vw;
  max-width: 25vw;
  padding: 1em;
  flex-flow: column;
  position:fixed;
}
button{
  border: none;
  background-color: transparent;
}
img{
  width: 24px;
  height: 24px;
}
</style>