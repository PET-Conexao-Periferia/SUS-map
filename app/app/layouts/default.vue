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
    style: '--bg-color: #f0f8ff;'
  }
})
</script>
