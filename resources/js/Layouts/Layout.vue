<template>

    <Head :title="title" />

    <ToastList />

    <NavBar></NavBar>

    <main>
        <slot />
    </main>

</template>

<script setup>

    import { Head } from '@inertiajs/vue3';

    import NavBar from '@/Components/navbar/Navbar.vue'

    import ToastList from '@/Components/ToastList.vue';

    defineProps({
        title: {
            type: String,
            required: true
        },
    });

</script>
