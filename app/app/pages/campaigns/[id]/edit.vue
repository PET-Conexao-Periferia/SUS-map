<template>
  <div class="tw-container tw-mx-auto tw-py-8">
    <CampaignForm :campaign-id="Number(id)" />
  </div>
</template>

<script setup lang="ts">
const route = useRoute();
const id = route.params.id;

definePageMeta({
  middleware: ["auth"],
});
</script>
