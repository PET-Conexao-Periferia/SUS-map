<template>
  <p>Example Component.</p>
</template>

<script setup lang="ts">
onBeforeMount(() => {
  console.log('before mount');
});
onMounted(() => {
  console.log('mounted');
});
onBeforeUpdate(() => {
  console.log('before update');
})
onUpdated(() => {
  console.log('updated');
});
onActivated(() => {
  console.log('activated');
});
onDeactivated(() => {
  console.log('deactivated');
})

</script>