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
        <LTooltip
            class="tw-max-w-40 tw-max-h-40"
            v-show="point.photo"
        >
          <!--
          parece estranho um v-show e um v-if, explicação:
          o v-show é apenas para na exibição não aparecer um quadrado grande totalmente em branco
          e o v-if para exibir a imagem apenas se houver uma foto
          caso utilizar o v-if direto no tooltip a lib fica bugada e não exibi os pontos no mapa
          -->
          <div v-if="point.photo">
            <img
              :src="imagePoint(String(point.photo))"
              alt="Foto do local"
              width="100%"
            />
          </div>
        </LTooltip>
      </LMarker>
    </LMap>
  </div>
</template>

<script setup lang="ts">
import L, { type Map } from 'leaflet';
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
const map = ref<Map | null>(null);
let pointSelected: L.Marker | null = null;

const onMapReady = async (leafletObject: Map): Promise<void> => {
  map.value = leafletObject;

  leafletObject.locate({
    setView: true,
    maxZoom: 16
  });

  leafletObject.on('locationfound', async (e) => {
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

watch($locationStore, async ({ searchPoints: $new }) => {
  if($new) {
    if(map.value && $new.length > 0) {
      const bounds = L.latLngBounds($new);
      map.value.fitBounds(bounds, {
        padding: [50, 50],
        maxZoom: 16,
        duration: 1,
        animate: true
      });
    }
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

function imagePoint(image: string): string {
  console.log(import.meta.env.VITE_API_URL + '/storage/' + image);
  return import.meta.env.VITE_API_URL + '/storage/' + image;
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