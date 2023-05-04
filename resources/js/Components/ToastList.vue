<template>
    <TransitionGroup tag="div"
        enter-from-class="translate-y-full opacity-0"
        enter-active-class="duration-500"
        leave-active-class="duration-500"
        leave-to-class="translate-y-full opacity-0"
        class="fixed top-20 z-[900] left-1/2 transform -translate-x-1/2 w-full max-w-xs">
        <template v-for="toast in store.toasts" :key="toast.id">
            <ToastListItem
                @removeToast="store.removeToast(toast.id)"
                v-bind="toast"
            />
        </template>
    </TransitionGroup>
</template>

<script setup>
    import ToastListItem from '@/Components/ToastListItem.vue';

    import { useNotification } from '@/Stores/notification.js';

    const store = useNotification();
</script>
