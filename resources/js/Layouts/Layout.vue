<template>

    <NavBar></NavBar>

    <main>
        <slot />
    </main>

</template>

<script setup>

    import NavBar from '@/Components/navbar/Navbar.vue'

</script>
