<template>
      <div v-if="$page.component.includes('Home')" class="
        pt-4
        flex
        items-center
        justify-between
        overflow-x-auto
    ">

        <CategoryBox
            v-for="category in $page.props.categories"
            :key="category.id"
            v-bind="category"
            @querySearch="querySearch"
        />

    </div>

</template>

<script setup>
    import { router } from '@inertiajs/vue3'
    import CategoryBox from '@/Components/navbar/CategoryBox.vue';

    const querySearch = ({id, name}) => router.get(route('home'), { search: name }, { preserveScroll: true })
</script>
