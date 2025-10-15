export type LocationType = {
  id?: number;
  latitude: number;
  longitude: number;
  address: string;
  photo?: string | File | null;
  distance?: number;
};

export type LocationCreateType = {
  cep_or_street: string;
  point: LocationType;
};
