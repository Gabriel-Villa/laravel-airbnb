<template>
    <v-select v-model="location" placeholder="Select a location" label="label" :options="getAll()" value="label"
        :reduce="country => `${country.id}`" class="mt-4" />
</template>

<script setup>
    import { useCountries } from '@/Composables/countries.js';
    import { ref } from 'vue';

    const countrySelected = ref('');
    const { getAll } = useCountries();

    const countries = ref(getAll());
</script>


