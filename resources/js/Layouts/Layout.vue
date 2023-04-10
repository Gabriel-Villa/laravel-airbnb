<template>

    <Head :title="title" />

    <ToastList />

    <NavBar></NavBar>

    <main>
        <slot />
    </main>

</template>

<script setup>

    import { Head, usePage } from '@inertiajs/vue3';

    import NavBar from '@/Components/navbar/Navbar.vue'

    import ToastList from '@/Components/ToastList.vue';
    import { onUpdated, onMounted } from 'vue';

    defineProps({
        title: {
            type: String,
            required: true
        },
    });

    // console.log("Use page layout", usePage());

    // onUpdated(() => {

    //     console.log("Updated layout");

    // });

    // onMounted(() => {

    //     console.log("onMounted layout");

    // });

</script>
