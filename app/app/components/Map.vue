<template>
  <div>
    <LMap
        use-global-leaflet
        @ready="onMapReady"
        :options="{
          zoomControl: false,
        }"
        @click="pointSelect"
    >
      <LTileLayer
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
          attribution="&amp;copy; <a href=&quot;https://www.openstreetmap.org/&quot;>OpenStreetMap</a> contributors"
          layer-type="base"
          name="OpenStreetMap"
      />
      <LMarker
          v-for="point in $locationStore.points" :key="point.id"
          :lat-lng="[point.latitude, point.longitude]"
      >
        <LPopup
          class="tw-max-w-[250px] tw-max-h-[270px]"
        >
          <NuxtImg
              :src="imagePoint(point?.photo)"
              alt="Foto do local"
              width="200px"
              height="200px"
              class="tw-block tw-mx-auto tw-mt-2"
          />
          <br />
          <Button
              @click="navigateTo(`/location/${point.id}`)"
              class="tw-block tw-mx-auto"
          >
            Ver mais detalhes do local
          </Button>
        </LPopup>
      </LMarker>
    <!-- markers for search results (click to select a result) -->
    <LMarker
      v-for="(pt, idx) in $locationStore.searchPoints"
      :key="`search-${idx}`"
      :lat-lng="pt"
      @click="() => onSearchMarkerClick(pt)"
    />
    </LMap>
  </div>
</template>

<script setup lang="ts">
import L from 'leaflet';
import type { LocationType } from "~/types/Location";

const props = defineProps({
  fullscreen: {
    type: Boolean,
    default: true
  },
  isRegisterPoint: {
    type: Boolean,
    default: false,
  }
});

const emits = defineEmits([
    'pointSelected'
]);

const { $locationStore } = useNuxtApp();
const map = ref<any | null>(null);
let pointSelected: L.Marker | null = null;

const onMapReady = async (leafletObject: any): Promise<void> => {
  map.value = leafletObject;

  leafletObject.locate({
    setView: true,
    maxZoom: 16
  });

  leafletObject.on('locationfound', async (e: any) => {
    $locationStore.current.longitude = e.latlng.lng;
    $locationStore.current.latitude = e.latlng.lat;
    $locationStore.fetchNearbyPoints();

    const radius = e.accuracy;

    L.marker(e.latlng)
        .addTo(leafletObject)
        .bindPopup(`Você está aqui!`)
        .openPopup();

    L.circle(e.latlng, radius)
        .addTo(leafletObject);

  });
}

// Watch searchPoints specifically so we react when address search returns results
watch(() => $locationStore.searchPoints, async ($new) => {
  if ($new && map.value && $new.length > 0) {
    const bounds = L.latLngBounds($new as [number, number][]);
    map.value.fitBounds(bounds, {
      padding: [50, 50],
      maxZoom: 16,
      duration: 1,
      animate: true,
    });
  }
}, {
  deep: true,
  immediate: true,
});

async function pointSelect(event: any): Promise<void> {
  if (
      props.isRegisterPoint &&
      event.latlng &&
      event.latlng.lat &&
      event.latlng.lng &&
      typeof event.latlng.lat === 'number' &&
      typeof event.latlng.lng === 'number'
  ) {
    emits('pointSelected', {
      latitude: event.latlng.lat,
      longitude: event.latlng.lng
    } as LocationType);

    if(pointSelected) {
      pointSelected.remove();
    }

    if(map.value) {
      pointSelected = L.marker(event.latlng)
          .addTo(map.value)
          .bindPopup(`Ponto selecionado`)
          .openPopup();
    }
  }
}

function onSearchMarkerClick(pt: [number, number]) {
  emits('pointSelected', { latitude: pt[0], longitude: pt[1] } as LocationType);
}

function imagePoint(image: string | undefined | null | File): string {
  if(image) {
    return import.meta.env.VITE_API_URL + '/storage/' + String(image);
  }
  return '/Logo.svg';
}

const fullscreenW = computed((): string => props.fullscreen ? '100vw' : '100%');
const fullscreenH = computed((): string => props.fullscreen ? '100vh' : '100%');
</script>

<style scoped lang="scss">
div {
  width: v-bind(fullscreenW);
  height: v-bind(fullscreenH);
  position: relative;
  z-index: 0;
}
</style>