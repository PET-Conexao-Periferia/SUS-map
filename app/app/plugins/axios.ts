import axios, { type AxiosInstance } from "axios";

export default defineNuxtPlugin(() => {
  const api: AxiosInstance = axios.create({
    baseURL: import.meta.env.VITE_API_URL ?? "http://localhost",
    withCredentials: false,
    withXSRFToken: true,
    headers: {
      "ngrok-skip-browser-warning": true,
    },
  });

  api.interceptors.request.use((config) => {
    const token = useCookie("token").value;
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  });

  return {
    provide: {
      axios: api,
    },
  };
});
