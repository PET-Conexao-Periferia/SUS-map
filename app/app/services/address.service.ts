import type { AddressType } from "~/types/"

export default new class AddressService {
  async create(descriptionId:number, address: AddressType) {
    const { $axios } = useNuxtApp()
    const id = Number(descriptionId)
    if (!Number.isInteger(id) || id <= 0) {
      console.error('AddressService.create chamado com descriptionId inválido:', descriptionId)
      return null
    }
    try {
      const { data } = await $axios.post(`/api/addresses/description/${id}`, address)
      return data
    } catch (e) {
      console.error('Erro ao criar endereço:', e)
      return null
    }
  }
}

