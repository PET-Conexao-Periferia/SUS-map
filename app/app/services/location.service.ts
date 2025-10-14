import type { LocationType } from "~/types/location.type";

export default new (class LocationService {
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
})();
