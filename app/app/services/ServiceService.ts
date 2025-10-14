import type {ServiceType} from "~/types/Service";

export default class ServiceService {
    static async create(service: ServiceType) {
        const { $axios } = useNuxtApp();
            try {
                const { data } = await $axios.post(`/api/services`, service) //api/services/location/{location} 
                return data
            } catch (e) {
                console.error('Erro ao criar Serviço:', e)
                return null
            }
        }

        static async getAll(service?: ServiceType) {
        const { $axios } = useNuxtApp();
        try {
        const { data } = await $axios.get(`/api/services`, { params: service });
        return data;
        } catch (e) {
        console.error('Erro ao buscar serviços:', e);
        return [];
        }
  }

}