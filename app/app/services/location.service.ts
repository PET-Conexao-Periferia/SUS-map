import type { LocationType } from "~/types/";

export default new class LocationService {
  async create(location: LocationType) {
    const { $axios } = useNuxtApp();
    try {
      const { data } = await $axios.post("/api/locations", location, {
        headers: {
          "Content-Type": location.photo
            ? "multipart/form-data"
            : "application/json",
        },
      });
      return true;
    } catch (e) {
      return false;
    }
  }

  async attachServices(locationId: number, services: number[]) {
    const { $axios } = useNuxtApp();
    try {
      const { data } = await $axios.post(
        `/api/locations/locations/${locationId}/services`,
        {
          services,
        }
      );
      return data;
    } catch (e) {
      console.error("Erro ao associar serviços ao local:", e);
      return null;
    }
  }

  // export const getLocationDetails = async (id: number) => {
  async getLocationDetails(locationId: number) {
    const { $axios } = useNuxtApp();
    const { data } = await $axios.get(`/api/locations/${locationId}`);
    return data;
  }
};
