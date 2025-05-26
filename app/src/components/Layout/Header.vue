<template>
  <header>
    <div class="tw-flex tw-justify-between" style="width: 100vw">
      <img
          src="~/assets/img/menu_sanduíche.svg"
          alt="ícone do menu"
          width="32px" height="32px"
          class="tw-m-4"
          @click="() => {
            showMenu = !showMenu;
            showActions = false;
          }"
      >
      <img
        src="~/assets/img/plus.svg"
        alt="ícone de ações do administrador"
        width="32px" height="32px"
        class="tw-m-4"
        @click="() => {
          showActions = !showActions;
          showMenu = false;
        }"
        v-if="$userStore.is_admin"
      >
    </div>
    <Transition>
      <LayoutMenu
          v-show="showMenu"
          @hideMenu="showMenu = false"
      />
    </Transition>
    <Transition>
      <LayoutAdmActions
          v-if="$userStore.is_admin"
          v-show="showActions"
          @hideActions="showActions = false"
      />
    </Transition>
  </header>
</template>

<script setup lang="ts">
const { $userStore } = useNuxtApp();
const showMenu = ref(false);
const showActions = ref(false);

onMounted(() => {
  document.addEventListener('hideMenu', () => {
    showMenu.value = false;
  });
  document.addEventListener('hideActions', () => {
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