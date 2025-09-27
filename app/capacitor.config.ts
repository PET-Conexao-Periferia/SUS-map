import type { CapacitorConfig } from '@capacitor/cli';

const config: CapacitorConfig = {
  appId: 'periferia.sus',
  appName: 'Periferia+SUS',
  server: {
    url: 'https://6626-2804-29b8-5127-a100-a718-60d6-bf0c-6876.ngrok-free.app/redirect_test',
    cleartext: true,
    allowNavigation: [
        '*.ngrok-free.app',
    ],
    hostname: 'ngrok-free.app',
  },
};

export default config;
