<template>
    <h1 class="text-2xl font-semibold text-start">
        {{ title }}
    </h1>
    <p class="font-light text-start text-slate-600 mt-2">
        {{ subtitle }}
    </p>
</template>

<script setup>
defineProps({
    title: {
        required: true,
        type: String,
        default: 'Default title'
    },
    subtitle: {
        required: true,
        type: String,
        default: 'Default subtitle'
    },
});
</script>
