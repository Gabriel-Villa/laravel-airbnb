<template>
    <div class="fixed top-20 right-4 z-50 w-full max-w-xs">
        <ToastListItem @removeToast="removeToast" message="Custom message"/>
    </div>
</template>

<script setup>

    import ToastListItem from '@/Components/ToastListItem.vue';

    const props = defineProps({
        message: String
    });

    function removeToast()
    {
        console.log("Remove");
    }

</script>
