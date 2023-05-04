<template>
    <div id="mapid" style="height:400px; width: 100%;" class="my-4 rounded-lg"></div>
</template>

<script setup>
    import { onMounted, onUpdated } from 'vue';
    import { usePage } from '@inertiajs/vue3';
    import { useCountries } from '@/Composables/countries.js';
    import leaflet from 'leaflet';

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
                    accessToken: usePage().props.leafletAccessToken,
                }
            )
            .addTo(mymap);
    });
</script>
