<template>
  <div>
    <LMap
        use-global-leaflet
        @ready="onMapReady"
        :options="{
          zoomControl: false,
        }"
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
        <LTooltip :content="`Distancia: ${point.distance}`" />
      </LMarker>
    </LMap>
  </div>
</template>

<script setup lang="ts">
import L, { type Map } from 'leaflet';

const props = defineProps({
  fullscreen: {
    type: Boolean,
    default: true
  }
});

const { $locationStore } = useNuxtApp();
const map = ref<Map | null>(null);

const onMapReady = (leafletObject: Map): void => {
  map.value = leafletObject;

  leafletObject.locate({
    setView: true,
    maxZoom: 16
  });

  leafletObject.on('locationfound', (e) => {
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

watch($locationStore, ({ searchPoints: $new }) => {
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