export interface Location {
  id: number;
  name: string;
  address: string;
  latitude: number;
  longitude: number;
  photo?: string;
}

export interface Campaign {
  id?: number;
  name: string;
  description: string;
  startTime: string;
  endTime: string;
  locationIds?: number[];
  locations?: Location[];
}