import type { Campaign } from "~/types/campaign.type";
import { AxiosError } from "axios";

export default new (class CampaignService {
  async getActiveCampaigns() {
    const { $axios } = useNuxtApp();
    try {
      const { data } = await $axios.get("/api/campaigns");
      return data;
    } catch (error) {
      if (error instanceof AxiosError) {
        // Agora podemos acessar as propriedades específicas do AxiosError
        if (error.response) {
          console.error(
            "CampaignService: Resposta de erro:",
            error.response.data
          );
          console.error("CampaignService: Status:", error.response.status);
          console.error("CampaignService: Headers:", error.response.headers);
        } else if (error.request) {
          console.error("CampaignService: Sem resposta:", error.request);
        } else {
          console.error(
            "CampaignService: Erro de configuração:",
            error.message
          );
        }
      } else {
        console.error("CampaignService: Erro desconhecido:", error);
      }

      return [];
    }
  }

  async getCampaignById(id: number) {
    const { $axios } = useNuxtApp();
    try {
      const { data } = await $axios.get(`/api/campaigns/${id}`);
      return data;
    } catch (error) {
      if (error instanceof AxiosError) {
        console.error(
          `Erro ao buscar campanha ${id}:`,
          error.response?.data || error.message
        );
      } else {
        console.error(`Erro ao buscar campanha ${id}:`, error);
      }
      return null;
    }
  }

  async createCampaign(campaign: Campaign) {
    const { $axios } = useNuxtApp();
    try {
      const { data } = await $axios.post("/api/campaigns", campaign);
      return data;
    } catch (error) {
      console.error("Erro ao criar campanha:", error);
      throw error;
    }
  }

  async updateCampaign(id: number, campaign: Campaign) {
    const { $axios } = useNuxtApp();
    try {
      const { data } = await $axios.put(`/api/campaigns/${id}`, campaign);
      return data;
    } catch (error) {
      console.error(`Erro ao atualizar campanha ${id}:`, error);
      throw error;
    }
  }

  async deleteCampaign(id: number) {
    const { $axios } = useNuxtApp();
    try {
      await $axios.delete(`/api/campaigns/${id}`);
      return true;
    } catch (error) {
      console.error(`Erro ao excluir campanha ${id}:`, error);
      return false;
    }
  }

  async getLocations() {
    const { $axios } = useNuxtApp();
    try {
      const { data } = await $axios.get("/api/campaigns/locations");
      return data;
    } catch (error) {
      console.error("Erro ao buscar locais:", error);
      return [];
    }
  }
})();
