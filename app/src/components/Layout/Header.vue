<template>
  <header>
    <div
        class="tw-flex tw-justify-between"
        style="width: 100vw"
    >
      <img
          src="~/assets/img/menu_sanduíche.svg"
          alt="ícone do menu"
          width="32px" height="32px"
          class="tw-m-4"
          @click="async () => {
            showMenu = !showMenu;
            showActions = false;
          }"
      >
      <img
        src="~/assets/img/plus.svg"
        alt="ícone de ações do administrador"
        width="32px" height="32px"
        class="tw-m-4"
        @click="async () => {
          showActions = !showActions;
          showMenu = false;
        }"
        v-if="$userStore.is_admin"
      >
    </div>
    <Transition>
      <LayoutMenu
          v-show="showMenu"
          @hideMenu="async () => showMenu = false"
      />
    </Transition>
    <Transition>
      <LayoutAdmActions
          v-if="$userStore.is_admin"
          v-show="showActions"
          @hideActions="async () => showActions = false"
      />
    </Transition>
  </header>
</template>

<script setup lang="ts">
const { $userStore } = useNuxtApp();
const showMenu = ref(false);
const showActions = ref(false);

onBeforeMount(async () => {
  document.addEventListener('hideMenu', async () => {
    showMenu.value = false;
  });
  document.addEventListener('hideActions', async () => {
    showActions.value = false;
  });
});
</script>

<style scoped lang="scss">
header {
  position: fixed;
  top: 0;
  left: 4px;
  z-index: 10;
}

</style>