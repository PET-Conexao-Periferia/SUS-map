import { defineStore } from 'pinia';
import Campaign from "~/classes/Campaign";

const useCampaignsStore = defineStore('campaigns', {
  state: () => ({
    campaigns: [] as Campaign[],
    current: null as Campaign | null,
    loading: false
  }),

  actions: {
    async fetchAll(axios: any) {
      this.loading = true;
      try {
        this.campaigns = await Campaign.getAll(axios);
      } finally {
        this.loading = false;
      }
    },
    
    async fetchOne(axios: any, id: number) {
      this.loading = true;
      try {
        const campaign = new Campaign({ id });
        await campaign.fetch(axios);
        this.current = campaign;
        return campaign;
      } finally {
        this.loading = false;
      }
    },
    
    resetCurrent() {
      this.current = null;
    }
  }
});

export default useCampaignsStore;