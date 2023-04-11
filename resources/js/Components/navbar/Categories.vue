<template>

    <div class="
        pt-4
        px-4
        flex
        items-center
        justify-between
        overflow-x-auto
    ">

        <CategoryBox
            v-for="category in categories"
            :key="category.id"
            v-bind="category"
            @querySearch="querySearch"
        />

    </div>

</template>

<script setup>
    import { reactive } from 'vue';
    import { router } from '@inertiajs/vue3'
    import CategoryBox from '@/Components/navbar/CategoryBox.vue';

    const categories = reactive([
        {id: 1, name: 'f', icon: 'fa-solid fa-house'},
        {id: 2, name: 'g', icon: 'fa-solid fa-fire'},
        {id: 3, name: 'd', icon: 'fa-solid fa-umbrella-beach'},
    ]);

    function querySearch({id, name})
    {
        router.get(route('home'), { search: name }, { preserveScroll: true })
    }

</script>
