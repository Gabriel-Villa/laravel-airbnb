
<template>
    <Layout title="Home Page">

        <NoResults v-if="props.listings.data && props.listings.data.length <= 0" />

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-8">
            <Listing v-for="listing in props.listings.data" :key="listing.id" v-bind="listing" />
        </div>

    </Layout>
</template>

<script setup>
    import { defineProps } from 'vue';

    import Layout from '@/Layouts/Layout.vue';
    import Listing from '@/Components/listing/Listing.vue';
    import NoResults from '@/Components/listing/NoResults.vue';

    const props = defineProps({
        listings: {
            type: Object,
            required: false,
            default: []
        }
    });
</script>
