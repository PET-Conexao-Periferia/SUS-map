import type { AxiosInstance, AxiosResponse } from 'axios';
import type { IApiModel } from '~/interfaces/IApiModel';

export interface CampaignType {
  id?: number;
  name: string;
  description: string;
  startTime: string;
  endTime: string;
}

export default class Campaign implements CampaignType, IApiModel {
  id: number = 0 ;
  name: string = '';
  description: string = '';
  startTime: string = '';
  endTime: string = '';

  constructor(data: Partial<CampaignType> = {}) {
    this.sync(data as CampaignType);
  }

  sync(data: CampaignType) {
    this.id = data.id || 0;
    this.name = data.name || '';
    this.description = data.description || '';
    this.startTime = data.startTime || '';
    this.endTime = data.endTime || '';
  }

  async fetch(axios: AxiosInstance): Promise<void | boolean | AxiosResponse> {
    if (!this.id) return false;
    
    return axios.get(`api/campaigns/${this.id}`)
      .then((res: AxiosResponse) => {
        this.sync(res.data);
        return res;
      });
  }

  async register(axios: AxiosInstance): Promise<void | boolean | AxiosResponse> {
    return axios.post('api/campaigns', this)
      .then((res: AxiosResponse) => {
        this.sync(res.data);
        return res;
      });
  }

  async update(axios: AxiosInstance): Promise<void | boolean | AxiosResponse> {
    if (!this.id) return false;
    
    return axios.put(`api/campaigns/${this.id}`, this)
      .then((res: AxiosResponse) => {
        this.sync(res.data);
        return res;
      });
  }

  async delete(axios: AxiosInstance): Promise<void | boolean | AxiosResponse> {
    if (!this.id) return false;
    
    return axios.delete(`api/campaigns/${this.id}`);
  }

  static async getAll(axios: AxiosInstance): Promise<Campaign[]> {
    return axios.get('api/campaigns')
      .then((res: AxiosResponse) => {
        return res.data.map((item: CampaignType) => new Campaign(item));
      });
  }
}