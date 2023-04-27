<template>
    <div id="mapid" style="height:400px; width: 100%;" class="mt-4 rounded-lg"></div>
</template>

<script setup>
    import leaflet from 'leaflet';
    import { useCountries } from '@/Composables/countries.js';
    import { onMounted, onUpdated } from 'vue';

    const props = defineProps(['latlng']);

    onUpdated(() =>
    {
        const latlng = convertLatLgnPropsStringToArray();

        removeMarkers();

        leaflet.marker([latlng[0], latlng[1]]).addTo(mymap);
        mymap.setView([latlng[0], latlng[1]], 5);
    });

    function convertLatLgnPropsStringToArray()
    {
        const data = props.latlng;
        let locationArray;

        locationArray = data.length > 0
            ? useCountries().getByValue(data).latlng
            : ["-10", "50"]

        return locationArray;
    }

    function removeMarkers()
    {
        mymap.eachLayer((layer) => {
            if(layer['_latlng']!=undefined)
                layer.remove();
        });
    }

    let mymap;

    onMounted(() => {

        const latlng = convertLatLgnPropsStringToArray();

        mymap = leaflet.map("mapid").setView(latlng, 5);
        leaflet.marker(latlng).addTo(mymap);
        leaflet
            .tileLayer(
                "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
                {
                    maxZoom: 18,
                    id: "mapbox/streets-v11",
                    accessToken: "pk.eyJ1Ijoib3BvbGV4byIsImEiOiJjbDNmOTM2NG4wMmlnM2pteWJuNHZ6MXZrIn0.4nMQc4L5sAB8pjlVzwzopQ",
                }
            )
            .addTo(mymap);
    });
</script>
