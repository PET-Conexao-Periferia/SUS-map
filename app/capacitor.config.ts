import type { CapacitorConfig } from '@capacitor/cli';

const config: CapacitorConfig = {
  appId: 'periferia.sus',
  appName: 'Periferia+SUS',
  server: {
    url: 'https://192.168.0.10:3000',
    cleartext: true
  },
  plugins: {
    CapacitorHttp: {
      enabled: true
    },
    CapacitorGeolocation: {
      enabled: true
    },
    CapacitorCookies: {
      enabled: true
    },
    CapacitorBrowser: {
      enabled: true
    },
    CapacitorApp: {
      enabled: true
    },
    CapacitorDevice: {
      enabled: true
    },
  }
};

export default config;
