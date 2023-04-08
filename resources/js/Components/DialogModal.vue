<script setup>

import Modal from './Modal.vue';

const emit = defineEmits(['close']);

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const close = () => {
    emit('close');
};
</script>

<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >
        <div class="px-8 py-4">
            <div class="text-lg font-medium text-gray-900 flex justify-between items-center px-4">
                <font-awesome-icon class="text-sm cursor-pointer rounded-full text-my-gray" icon="fa-solid fa-xmark" @click="close" />
                <slot name="title"/>
                <p></p>
            </div>

            <div class="mt-4 text-sm text-gray-600 px-4">
                <slot name="content" />
            </div>
        </div>

        <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
            <slot name="footer" />
        </div>
    </Modal>
</template>
