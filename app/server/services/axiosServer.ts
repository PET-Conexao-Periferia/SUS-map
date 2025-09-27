import axios from 'axios';

export default function() {
    const axiosConfig = {
        withCredentials: false,
        headers: {
            "Content-Type": "application/json",
        }
    }
    const apiCEP = axios.create({
        baseURL: process.env.NUXT_API_CEP ?? '',
        ...axiosConfig,
    });
    const apiCoordinates = axios.create({
        baseURL: process.env.NUXT_API_COORDINATES ?? '',
        ...axiosConfig,
    });

    return {
        apiCEP,
        apiCoordinates,
    }
}