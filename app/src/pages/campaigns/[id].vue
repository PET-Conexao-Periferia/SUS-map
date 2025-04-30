<template>
    <div class="tw-container tw-mx-auto tw-px-4 tw-py-8">
      <div v-if="loading" class="tw-flex tw-justify-center tw-my-10">
        <span>Carregando detalhes da campanha...</span>
      </div>
      
      <div v-else-if="!campaign" class="tw-text-center tw-my-10">
        <p>Campanha não encontrada.</p>
        <NuxtLink to="/campaigns" class="tw-text-blue-500 hover:tw-underline">
          Voltar para lista de campanhas
        </NuxtLink>
      </div>
      
      <div v-else>
        <div class="tw-flex tw-justify-between tw-items-start tw-mb-6">
          <h1 class="tw-text-2xl tw-font-bold">{{ campaign.name }}</h1>
          
          <div class="tw-flex tw-space-x-2">
            <Button @click="editCampaign">Editar</Button>
            <Button @click="confirmDelete" class="tw-bg-red-600">Excluir</Button>
          </div>
        </div>
        
        <div class="tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6">
          <div class="tw-mb-4">
            <h2 class="tw-text-lg tw-font-semibold tw-mb-2">Descrição:</h2>
            <p>{{ campaign.description }}</p>
          </div>
          
          <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4 tw-mb-4">
            <div>
              <h2 class="tw-text-lg tw-font-semibold tw-mb-2">Período:</h2>
              <p><strong>Início:</strong> {{ formatDate(campaign.startTime) }}</p>
              <p><strong>Término:</strong> {{ formatDate(campaign.endTime) }}</p>
            </div>
          </div>
          
          <NuxtLink to="/campaigns" class="tw-text-blue-500 hover:tw-underline">
            Voltar para lista de campanhas
          </NuxtLink>
        </div>
      </div>
    </div>
  </template>
  
  <script lang="ts">
import { defineComponent } from 'vue';
import { useRouter, useRoute } from 'vue-router'; // Importando composables
import useCampaignsStore from '~/stores/use-campaigns-store';
import Campaign from '~/classes/Campaign';

export default defineComponent({
  name: 'CampaignDetails',
  
  setup() {
    const router = useRouter();
    const route = useRoute();
    
    return { router, route }; // Disponibilizando para template e methods
  },
  
  data() {
    return {
      loading: true,
      store: null as null | ReturnType<typeof useCampaignsStore>
    };
  },

  computed: {
    campaign(): Campaign | null {
      return this.store?.current ?? null;
    }
  },
  
  mounted() {
    this.store = useCampaignsStore();
    this.fetchCampaign();
  },
  
  methods: {
    async fetchCampaign() {
      this.loading = true;
      try {
        const id = parseInt(this.route.params.id as string);
        if (!isNaN(id)) {
          await this.store?.fetchOne(this.$axios, id);
        }
      } finally {
        this.loading = false;
      }
    },
    
    editCampaign() {
      if (this.campaign?.id !== null && this.campaign?.id !== undefined) {
        this.router.push(`/campaigns/edit/${this.campaign.id}`);
      }
    },
    
    async confirmDelete() {
      if (confirm('Tem certeza que deseja excluir esta campanha?')) {
        if (this.campaign) {
          await this.campaign.delete(this.$axios);
          this.router.push('/campaigns');
        }
      }
    },
    
    formatDate(dateString: string): string {
      const date = new Date(dateString);
      return date.toLocaleDateString('pt-BR') + ' ' + date.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
    }
  },
  
  beforeUnmount() {
    this.store?.resetCurrent();
  }
});
</script>
