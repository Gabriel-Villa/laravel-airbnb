
<template>
    <Layout title="Home Page">

        <div v-if="props.listings.data && props.listings.data.length <= 0" class="h-[60vh] flex flex-col gap-2 justify-center items-center">
            <h1 class="text-3xl first-letter:semibold">No Results</h1>
            <p class="font-light text-neutral-500 mt-2 underline">
                Try to changeing or remoing some of your filters
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-8">
            <Listing v-for="listing in props.listings.data" :key="listing.id" v-bind="listing" />
        </div>

    </Layout>
</template>

<script setup>
    import Layout from '@/Layouts/Layout.vue';
    import { defineProps } from 'vue';

    import Listing from '@/Components/listing/Listing.vue';

    const props = defineProps({
        listings: {
            type: Object,
            required: false,
            default: []
        }
    });

</script>
