<template>
  <LayoutHeader>
    <p>Detalhes da campanha</p>
  </LayoutHeader>
    <CampaignDetail :id="Number(id)" />
</template>

<script setup lang="ts">
const route = useRoute();
const id = route.params.id;
</script>
