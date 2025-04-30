<template>
    <div class="tw-container tw-mx-auto tw-px-4 tw-py-8">
      <div class="tw-flex tw-justify-between tw-items-center tw-mb-6">
        <h1 class="tw-text-2xl tw-font-bold">Campanhas de Saúde</h1>
        <NuxtLink to="/campaigns/create">
          <Button>Nova Campanha</Button>
        </NuxtLink>
      </div>
  
      <div v-if="loading" class="tw-flex tw-justify-center tw-my-10">
        <span>Carregando campanhas...</span>
      </div>
  
      <div v-else-if="!campaigns.length" class="tw-text-center tw-my-10">
        <p>Não há campanhas ativas no momento.</p>
      </div>
  
      <div v-else class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-6">
        <div 
          v-for="campaign in campaigns" 
          :key="campaign.id" 
          class="tw-bg-white tw-rounded-lg tw-shadow-md tw-overflow-hidden hover:tw-shadow-lg tw-transition-shadow"
          @click="goToCampaign(campaign)"
        >
          <div class="tw-p-4">
            <h2 class="tw-text-lg tw-font-semibold tw-mb-2">{{ campaign.name }}</h2>
            <p class="tw-text-sm tw-text-gray-600 tw-mb-3">{{ campaign.description }}</p>
            
            <div class="tw-text-xs tw-text-gray-500">
              <div class="tw-flex tw-justify-between">
                <span>Início:</span>
                <span>{{ formatDate(campaign.startTime) }}</span>
              </div>
              <div class="tw-flex tw-justify-between">
                <span>Término:</span>
                <span>{{ formatDate(campaign.endTime) }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script lang="ts">
  import { defineComponent } from 'vue';
  import { useRouter } from 'vue-router'; // Importando useRouter
  import useCampaignsStore from '~/stores/use-campaigns-store';
  import Campaign from '~/classes/Campaign';
  
  export default defineComponent({
    name: 'CampaignsList',
    
    setup() {
      // Inicialização do router aqui na setup function
      const router = useRouter();
      
      return { router }; // Retorna router para ser usado nos methods
    },
    
    data() {
      return {
        loading: true,
        store: null as null | ReturnType<typeof useCampaignsStore>
      };
    },
  
    computed: {
      campaigns(): Campaign[] {
        return this.store?.campaigns || [];
      }
    },
    
    mounted() {
      this.store = useCampaignsStore();
      this.fetchCampaigns();
    },
    
    methods: {
      async fetchCampaigns() {
        this.loading = true;
        try {
          await this.store?.fetchAll(this.$axios);
        } finally {
          this.loading = false;
        }
      },
      
      goToCampaign(campaign: Campaign) {
        // Usando o router da setup function em vez de this.$router
        if (campaign.id !== null) {
          this.router.push(`/campaigns/${campaign.id}`);
        }
      },
      
      formatDate(dateString: string): string {
        const date = new Date(dateString);
        return date.toLocaleDateString('pt-BR');
      }
    }
  });
  </script>