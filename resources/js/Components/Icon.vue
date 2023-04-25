<template>
    <font-awesome-icon class="text-sm" :class="props.class" :icon="icon" disabled />
</template>

<script setup>
    import { defineProps } from 'vue';

    const props = defineProps({
        iconClass: { type: String, default: '' },
        icon: { type: String, required: true },
    });
</script>
