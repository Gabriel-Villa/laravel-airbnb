
<template>
    <Layout title="Dashboard Page">
        <p v-for="(listing, index) in props.users.data" :key="index">
            {{ listing.name }} {{ listing.id }}
        </p>
    </Layout>
</template>

<script setup>
    import Layout from '@/Layouts/Layout.vue';
import { usePage } from '@inertiajs/vue3';
    import { ref, defineProps } from 'vue';

    const props = defineProps({
        users : {
            type : Object,
            required: false
        }
    });

    console.log(usePage().props);

</script>
