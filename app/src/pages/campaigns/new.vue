<template>
  <div class="tw-container tw-mx-auto tw-py-8">
    <CampaignForm />
  </div>
</template>

<script setup lang="ts">
import CampaignForm from '~/components/campaign/CampaignForm.vue';
import useUserStore from '~/stores/use-user-store';

definePageMeta({
  layout: 'default',
  middleware: ['auth']
});

// Middleware de autenticação para esta página
const userStore = useUserStore();
const token = useCookie('token');

onMounted(() => {
  if (!token.value || !userStore.is_admin) {
    navigateTo('/auth/login');
  }
});
</script>