<template>
  <div class="tw-container tw-mx-auto tw-py-8">
    <h1 class="tw-text-2xl tw-font-bold tw-mb-6 tw-text-center">Campanhas de Saúde</h1>
    <CampaignList />
  </div>
</template>

<script setup lang="ts">
import CampaignList from '~/components/Campaign/CampaignList.vue';

definePageMeta({
  layout: 'default',
  middleware: []
});
</script>