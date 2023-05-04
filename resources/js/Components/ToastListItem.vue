<template>
    <div>
        <ToastListContentSuccess v-if="props.type == 'success'" v-bind="props" />
        <ToastListContentError v-if="props.type == 'error'" v-bind="props" />
    </div>
</template>

<script setup>
    import { onMounted } from 'vue';
    import { useNotification } from '@/Stores/notification.js';

    import ToastListContentSuccess from './ToastListContentSuccess.vue';
    import ToastListContentError from './ToastListContentError.vue';

    const store = useNotification();

    const props = defineProps({
        message: String,
        id: Symbol,
        type: {
            default: 'success'
        }
    });

    onMounted(() => {
        setTimeout(() => {
            store.removeToast(props.id)
        }, 2000)
    });
</script>
