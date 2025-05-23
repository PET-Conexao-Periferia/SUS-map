<template>
  <div class="campaign-detail tw-max-w-3xl tw-mx-auto tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6">
    <div v-if="loading" class="tw-text-center tw-py-4">
      Carregando detalhes da campanha...
    </div>
    
    <div v-else-if="!campaign" class="tw-text-center tw-py-4">
      Campanha não encontrada.
    </div>
    
    <div v-else>
      <h2 class="tw-text-2xl tw-font-bold tw-mb-4">{{ campaign.name }}</h2>
      
      <div class="tw-mb-4">
        <h3 class="tw-text-lg tw-font-semibold">Período</h3>
        <p>{{ formatDate(campaign.startTime) }} até {{ formatDate(campaign.endTime) }}</p>
      </div>
      
      <div class="tw-mb-4">
        <h3 class="tw-text-lg tw-font-semibold">Descrição</h3>
        <p class="tw-whitespace-pre-line">{{ campaign.description }}</p>
      </div>
      
      <div class="tw-mb-4">
        <h3 class="tw-text-lg tw-font-semibold">Locais</h3>
        <ul class="tw-pl-4">
          <li v-for="location in campaign.locations" :key="location.id" class="tw-mb-2">
            <strong>{{ location.description ? location.description.name : 'Local sem nome' }}</strong>
            <p v-if="location.description">{{ location.description.contact }}</p>
          </li>
        </ul>
      </div>
      
      <div v-if="isAdmin" class="tw-flex tw-justify-end tw-gap-4 tw-mt-6">
        <Button 
          @click="navigateTo(`/campaigns/${campaign.id}/edit`)" 
          class="tw-bg-yellow-500 tw-text-white"
        >
          Editar
        </Button>
        
        <Button 
          @click="confirmDelete" 
          class="tw-bg-red-500 tw-text-white"
        >
          Excluir
        </Button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from 'vue';
import CampaignService from '~/services/CampaignService';
import useUserStore from '~/stores/use-user-store';
import type { Campaign } from '~/types/Campaign';

const props = defineProps<{
  id: number;
}>();

const campaign = ref<Campaign | null>(null);
const loading = ref(true);
const userStore = useUserStore();

const isAdmin = computed(() => userStore.is_admin);

onMounted(async () => {
  try {
    campaign.value = await CampaignService.getCampaignById(props.id);
  } catch (error) {
    console.error(`Erro ao carregar campanha ${props.id}:`, error);
  } finally {
    loading.value = false;
  }
});

const formatDate = (dateString: string) => {
  return new Date(dateString).toLocaleDateString('pt-BR');
};

const confirmDelete = async () => {
  if (confirm('Tem certeza que deseja excluir esta campanha?')) {
    try {
      await CampaignService.deleteCampaign(props.id);
      navigateTo('/campaigns');
    } catch (error) {
      console.error('Erro ao excluir campanha:', error);
      alert('Erro ao excluir campanha');
    }
  }
};
</script>