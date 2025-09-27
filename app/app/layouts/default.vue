<template>
  <client-only>
    <LayoutHeader v-if="route.meta.showHeader"/>
  </client-only>
  <main @click="hideMenu">
    <slot />
  </main>
  <LayoutFooter />
</template>

<script setup lang="ts">
const route = useRoute();
const { $userStore } = useNuxtApp();
async function hideMenu() {
  document.dispatchEvent(new Event('hideMenu'));
  if($userStore.is_admin) {
    document.dispatchEvent(new Event('hideActions'));
  }
}
</script>