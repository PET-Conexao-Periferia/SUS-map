<template>
  <div style="height:100vh; width:100vw">
    <LMap
        ref="map"
        :use-global-leaflet="true"
        @ready="onMapReady"
    >
      <LTileLayer
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
          attribution="&amp;copy; <a href=&quot;https://www.openstreetmap.org/&quot;>OpenStreetMap</a> contributors"
          layer-type="base"
          name="OpenStreetMap"
      />
    </LMap>
  </div>
</template>

<script setup>
import L from 'leaflet';

const map = ref(null);

const onMapReady = () => {
  map.value.leafletObject.locate({
    setView: true,
    maxZoom: 16
  });

  map.value.leafletObject.on('locationfound', (e) => {
    const radius = e.accuracy;

    L.marker(e.latlng)
        .addTo(map.value.leafletObject)
        .bindPopup("You are within " + radius + " meters from this point")
        .openPopup();

    L.circle(e.latlng, radius)
        .addTo(map.value.leafletObject);
  })
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