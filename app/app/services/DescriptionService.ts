import type { DescriptionType } from "~/types/Description";
import type { LocationType } from "~/types/Location";

export default class DescriptionService {
  static async create(locationId: number , description: DescriptionType) {
    const { $axios } = useNuxtApp()
    const id = Number(locationId)

    if (!Number.isInteger(id) || id <= 0) {
      console.error('DescriptionService.create chamado com locationId inválido:', locationId)
      return null
    }

    try {
      
      const { data } = await $axios.post(`/api/descriptions/location/${id}`, description)
      return data
    } catch (e) {
      console.error('Erro ao criar descrição:', e)
      return null
    }
  }
}

