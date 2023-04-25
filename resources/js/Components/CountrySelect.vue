<template>
    <v-select placeholder="Choose a country" label="label" :options="countries" v-model="countrySelected" class="mt-4">
        <template #option="{ label, flag }">
            <div class="flex items-center gap-3">
                <div>{{ flag }}</div>
                <span class="text-neutral-800 ml-1">
                    {{ label }}
                </span>
            </div>
        </template>
    </v-select>
</template>

<script setup>
    import { useCountries } from '@/Composables/countries.js';
    import { ref } from 'vue';

    const countrySelected = ref('');
    const { getAll } = useCountries();

    const countries = ref(getAll());
</script>


