import type { LocationType } from "./location.type";

export type Campaign = {
  id?: number;
  name: string;
  description: string;
  startTime: string;
  endTime: string;
  locationIds?: number[];
  locations?: LocationType[];
};
