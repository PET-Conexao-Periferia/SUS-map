<template>
  <div style="height:100vh; width:100vw">
    <LMap
        ref="map"
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
          v-for="point in $locationStore.points"
          :key="point.id"
          :lat-lng="[point.latitude, point.longitude]"
      >
        <LTooltip :content="`Distancia: ${point.distance}`" />
      </LMarker>
    </LMap>
  </div>
</template>

<script setup lang="ts">
import L, { type Map } from 'leaflet';

const map = ref(null);
const { $locationStore } = useNuxtApp();

const onMapReady = (leafletObject: Map): void => {
  leafletObject.locate({
    setView: true,
    maxZoom: 16
  });

  leafletObject.on('locationfound', (e) => {
    const radius = e.accuracy;

    $locationStore.current.longitude = e.latlng.lng;
    $locationStore.current.latitude = e.latlng.lat;
    $locationStore.fetchNearbyPoints();

    L.marker(e.latlng)
        .addTo(leafletObject)
        .bindPopup("Você está aqui")
        .openPopup();

    L.circle(e.latlng, radius)
        .addTo(leafletObject);

  });
}
</script>

<style scoped lang="scss">
div {
  width: 100vw;
  height: 100vh;
  position: relative;
  z-index: 0;
}
</style>