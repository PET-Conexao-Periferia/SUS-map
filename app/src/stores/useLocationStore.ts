import type {LocationType} from "~/types/Location";

export default defineStore('location', () => {
    const current = ref<LocationType>({
        latitude: 0,
        longitude: 0
    });
    const points = ref<LocationType[]>([]);

    const fetchNearbyPoints = async () => {
        const { $axios } = useNuxtApp();
        try {
            const { data } = await $axios.get('/api/locations', {
                params: {
                    latitude: current.value.latitude,
                    longitude: current.value.longitude
                }
            });

            points.value = data;
        } catch(error) {
            return;
        }
    }

    return {
        current,
        points,
        fetchNearbyPoints
    }
});