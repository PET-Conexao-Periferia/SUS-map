<template>
    <main>
         <slot />
    </main>
  <LayoutFooter />
</template>
<script setup>
useHead({
  bodyAttrs: {
    style: '--bg-color: #003087;'
  }
})
</script>