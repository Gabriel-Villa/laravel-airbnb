<template>
    <TransitionGroup tag="div"
        enter-from-class="translate-x-full opacity-0"
        enter-active-class="duration-500"
        leave-active-class="duration-500"
        leave-to-class="translate-x-full opacity-0"
        class="fixed top-20 right-4 z-50 w-full max-w-xs">
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
