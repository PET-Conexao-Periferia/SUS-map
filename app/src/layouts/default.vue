<template>
  <client-only>
    <LayoutHeader />
  </client-only>
  <main @click="hideMenu">
    <slot />
  </main>
  <LayoutFooter />
</template>

<script setup lang="ts">
const { $userStore } = useNuxtApp();
function hideMenu() {
  document.dispatchEvent(new Event('hideMenu'));
  if($userStore.is_admin) {
    document.dispatchEvent(new Event('hideActions'));
  }
}
</script>