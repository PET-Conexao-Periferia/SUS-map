export default class AddressService {
  static async create(descriptionId: any, address: Record<string, any>) {
    const { $axios } = useNuxtApp()
    try {
      const { data } = await $axios.post(`/api/addresses/descriptions/${descriptionId}`, address)
      return data
    } catch (e) {
      console.error('Erro ao criar endereço:', e)
      return null
    }
  }
}