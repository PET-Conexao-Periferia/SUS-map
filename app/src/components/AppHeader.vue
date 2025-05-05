<template>
  <header>
    <img
        src="~/assets/img/menu_sanduíche.svg"
        alt="icone do menu"
        width="32px" height="32px"
        class="tw-m-4"
        @click="showMenu = !showMenu"
    >
    <nav v-show="showMenu" class="menu-container" tabindex="0">
      <Button
          @click="navigateTo('/')"
          variant-select
      >
        Mapa
      </Button>
      <Button
        variant-select
      >
        Campanhas
      </Button>
      <Button
          @click="navigateTo('/auth/register')"
          variant-select
      >
        Cadastro
      </Button>
      <Button
          @click="navigateTo('/auth/login')"
          variant-select
      >
        Entrar
      </Button>
    </nav>
  </header>
</template>

<script setup lang="ts">
const showMenu = ref(false);

</script>

<style scoped lang="scss">
header {
  position: fixed;
  top: 0;
  left: 4px;
  z-index: 10;
}
.menu-container {
  background-color: #CCD2FF;
  border-radius: 10px;

  display:flex;
  flex-direction: column;
  flex-wrap: nowrap;
  align-self: flex-start;
  align-items: center;
  justify-content: flex-start;
  gap: 1em;

  position: absolute;
  width: 15em;
  margin: 0;
  padding: 2em 0em;
  left: 1em;

  box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
}
</style>