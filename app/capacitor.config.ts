import type { CapacitorConfig } from "@capacitor/cli";

const config: CapacitorConfig = {
  appId: "periferia.sus",
  appName: "Periferia+SUS",
  server: {
    url: "https://e10ae8693c7b.ngrok-free.app",
    cleartext: true,
    allowNavigation: ["*.ngrok-free.app"],
    hostname: "ngrok-free.app",
  },
};

export default config;
