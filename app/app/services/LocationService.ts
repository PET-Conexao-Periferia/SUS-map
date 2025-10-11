import type {LocationType} from "~/types/Location";

export default class LocationService {
    static async create(location: LocationType) {
        const { $axios } = useNuxtApp();
        try {
            const { data } = await $axios.post('/api/locations', location, {
                headers: {
                    'Content-Type': location.photo ? 'multipart/form-data' : 'application/json',
                }
            });
        return data 
    } catch (e) {
      console.error('Erro ao criar localização:', e)
      return null
    }

    
}

    // services/LocationService.ts
    static async attachServices(locationId: number, services: number[]) {
    const { $axios } = useNuxtApp()
    try {
        const { data } = await $axios.post(`/api/locations/locations/${locationId}/services`, {
        services
        })
        return data
    } catch (e) {
        console.error('Erro ao associar serviços ao local:', e)
        return null
    }
    }

}