import axiosServer from "~/server/services/axiosServer";

export default defineEventHandler(async (event) => {
    const { search } = getQuery(event);
    const { apiCoordinates } = axiosServer();

    const { data } = await apiCoordinates.get('', {
        params: {
            q: search,
        },
    });

    return {
        data,
    }
});