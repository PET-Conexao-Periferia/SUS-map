<template>
  <main>
  <LayoutFloat/>
    <slot />
  </main>
  <LayoutFooter />
</template>

<script setup>
useHead({
  bodyAttrs: {
    style: '--bg-color: #f9f9fb;'
  }
})
</script>
