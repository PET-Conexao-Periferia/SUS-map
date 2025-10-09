<template>
  <div class="tw-container tw-mx-auto tw-py-8">
    <CampaignDetail :id="Number(id)" />
    
    <div class="tw-text-center tw-mt-8">
      <Button @click="navigateTo('/campaigns')" class="tw-bg-blue-500 tw-text-white">
        Voltar para a lista
      </Button>
    </div>
  </div>
</template>

<script setup lang="ts">
import CampaignDetail from '~/components/Campaign/CampaignDetail.vue';

const route = useRoute();
const id = route.params.id;

definePageMeta({
  layout: 'default',
  middleware: []
});
</script>