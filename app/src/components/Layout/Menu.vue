<template>
  <nav
      tabindex="0"
      @click="emit('hideMenu')"
  >
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
        v-if="!$userStore?.is_admin"
        @click="navigateTo({
            name: 'register'
          })"
        variant-select
    >
      Cadastro
    </Button>
    <Button
        v-if="!$userStore?.is_admin"
        @click="navigateTo({
            name: 'login'
          })"
        variant-select
    >
      Entrar
    </Button>
    <Button
        v-if="$userStore?.is_admin"
        @click="AuthService.logout"
        variant-select
    >
      Sair
    </Button>
  </nav>
</template>

<script setup lang="ts">
import AuthService from "~/services/AuthService";

const { $userStore } = useNuxtApp();

const emit = defineEmits(['hideMenu']);
</script>

<style scoped lang="scss">
nav {
  left: 1em;
  right: auto;
}
</style>