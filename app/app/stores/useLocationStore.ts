import type {LocationType} from "~/types/Location";

export default defineStore('location', () => {
    const current = ref<LocationType>({
        latitude: 0,
        longitude: 0
    });
    const points = ref<LocationType[]>([]);
    const searchPoints = ref<[number, number][]>([]);

    const fetchNearbyPoints = async () => {
        const { $axios } = useNuxtApp();
        try {
            const { data } = await $axios.get('/api/locations', {
                params: {
                    latitude: current.value.latitude,
                    longitude: current.value.longitude
                }
            });

            if(Array.isArray(data) && data.length > 0) {
                for(const value of data) {
                    if(points.value.find(point => point.id === value.id)) {
                        continue;
                    }
                    points.value.push(value);
                }
            }
            localStorage.setItem('points', JSON.stringify(points.value));
        } catch(error) {
            return;
        }
    }

    const searchLocation = async (search: string) => {
        const { data }: { data: any[] } = await $fetch('/api/location_by_street', {
            params: {
                search,
            },
        });

        // debug: log the returned data so we can confirm keys and values
        // (remove this log in production)
        // eslint-disable-next-line no-console
        console.log('searchLocation response:', data);

        if (data && Array.isArray(data) && data.length > 0) {
            // ensure we map to [lat, lon] — adjust keys if your backend uses different names
            searchPoints.value = data.map(point => [point.lat ?? point.latitude ?? 0, point.lon ?? point.longitude ?? 0]);
        } else {
            searchPoints.value = [];
        }
    }

    return {
        current,
        points,
        fetchNearbyPoints,
        searchLocation,
        searchPoints,
    }
});