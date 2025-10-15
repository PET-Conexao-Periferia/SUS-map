<template>
  <LayoutHeader>
      <p class="tw-text-center">
      {{ isEditing ? "Editar Campanha" : "Nova Campanha" }}
      </p>
    </LayoutHeader>
    <CampaignForm />

</template>

<script setup lang="ts">
definePageMeta({
  middleware: ["auth"],
});
</script>
