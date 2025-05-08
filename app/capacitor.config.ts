import type { CapacitorConfig } from '@capacitor/cli';

const config: CapacitorConfig = {
  appId: 'www.periferiasus.com',
  appName: 'Periferia+SUS',
  webDir: '.output/public',
  server: {
    url: 'http://localhost:3000',
    cleartext: true
  }
};

export default config;
