
<template>
    <Layout title="Dashboard Page">
        <p v-for="(listing, index) in listings.data" :key="index">
            {{ listing.name }} {{ listing.id }}
        </p>
    </Layout>
</template>

<script setup>
    import Layout from '@/Layouts/Layout.vue';
    import { ref, defineProps } from 'vue';

    const props = defineProps({
        users : {
            type : Object,
            required: false
        }
    });

    const listings = ref(props.users);

</script>
