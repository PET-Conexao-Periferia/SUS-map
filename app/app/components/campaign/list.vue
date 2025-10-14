<template>
  <div class="tw-mx-auto">
    <div class="tw-text-center">
      <h2>Campanhas ativas</h2>
    </div>
    <div class="campaign-list">
    <div v-if="loading" class="tw-text-center tw-py-4">
      Carregando campanhas...
    </div>

    <div v-else-if="campaigns.length === 0" class="tw-text-center tw-py-4">
      Não há nenhuma campanha ativa no momento.
    </div>

    <div v-else class="tw-grid tw-gap-4">
      <div
        v-for="campaign in campaigns"
        :key="campaign.id"
        class="campaign-card tw-bg-white tw-rounded-lg tw-shadow-md tw-p-4 tw-cursor-pointer"
        @click="navigateTo(`/campaigns/${campaign.id}`)"
      >
        <h3 class="tw-text-lg tw-font-semibold">{{ campaign.name }}</h3>
        <p class="tw-text-sm tw-text-gray-600">
          {{ formatDate(campaign.startTime) }} até
          {{ formatDate(campaign.endTime) }}
        </p>
        <div class="tw-mt-2">
          <p class="tw-text-sm tw-font-medium">Locais:</p>
          <ul class="tw-pl-4">
            <li
              v-for="location in campaign.locations"
              :key="location.id"
              class="tw-text-sm"
            >
              {{ "Local #" + location.id }}
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div v-if="$userStore.is_admin" class="tw-mt-6 tw-text-center">
    </div>
  </div>
  </div>
</template>

<script setup lang="ts">
import { CampaignService } from "~/services/";
import type { Campaign } from "~/types/";
import { formatDate } from "~/utils/";

const { $userStore } = useNuxtApp();
const loading = ref(true);
const campaigns = ref<Campaign[]>([]);


try {
  console.log("Antes da chamada à API");
  const result = await CampaignService.getActiveCampaigns();

  campaigns.value = result;


  if (campaigns.value.length === 0) {
    console.log("Nenhuma campanha retornada da API");
  } else {
    // Verifica a estrutura do primeiro item para debug
    const firstCampaign = campaigns.value[0];
    console.log("Primeira campanha:", firstCampaign);
    console.log(
      "Propriedades da primeira campanha:",
      Object.keys(firstCampaign ?? {})
    );

    if (firstCampaign?.locations) {
      console.log("Locais da primeira campanha:", firstCampaign.locations);
      console.log("Estrutura do primeiro local:", firstCampaign.locations[0]);
    } else {
      console.log("A campanha não tem a propriedade 'locations'");
    }
  }
} catch (error) {
  console.error("Erro ao carregar campanhas:", error);

  // Detalhes adicionais sobre o erro
  if (error instanceof Error) {
    console.error("Mensagem de erro:", error.message);
    console.error("Stack trace:", error.stack);
  }
} finally {
  loading.value = false;
}
</script>
