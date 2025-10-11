<template>
  <BackButton />
  <div class="tw-container tw-mx-auto tw-py-8">
    <CampaignForm />
  </div>
</template>

<script setup lang="ts">
definePageMeta({
  middleware: ["auth"],
});
</script>
