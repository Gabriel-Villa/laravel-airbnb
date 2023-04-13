<template>
   <div class="
        flex
        flex-col
        items-center
        gap-2
        py-3
        px-0
        border-b-2
        hover:text-neutral-800
        transition
        cursor-pointer
   "
   :class="$page.props.filters.search == name ? 'border-b-neutral-800 text-neutral-800' : 'border-transparent text-neutral-500'"
   @click="$emit('querySearch', { id, name })"
   >
        <font-awesome-icon class="text-sm" :icon="icon" />
        <div class="font-medium text-sm">
            {{ name }}
        </div>
   </div>
</template>

<script setup>
    const props = defineProps({
        id: {
            required: true
        },
        name: {
            type: String,
            required: true
        },
        icon: {
            type: String,
            required: true
        },
    });
</script>
