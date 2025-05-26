export type LocationType = {
    id?: number,
    latitude: number,
    longitude: number,
    photo?: string | File,
    distance?: number
}

export type LocationCreateType = {
    cep_or_street: string,
    point: LocationType
}