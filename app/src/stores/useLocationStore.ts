import type {LocationType} from "~/types/Location";

export default defineStore('location', () => {
    const current = ref<LocationType>({
        latitude: 0,
        longitude: 0
    });
    const points = ref<LocationType[]>([]);

    const fetchNearbyPoints = async (page: number = 1) => {
        const { $axios } = useNuxtApp();
        try {
            const { data } = await $axios.get('/api/locations', {
                params: {
                    page,
                    latitude: current.value.latitude,
                    longitude: current.value.longitude
                }
            });

            points.value.push(...data.data);
            if(page < 3) {
                fetchNearbyPoints(page + 1);
            }
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