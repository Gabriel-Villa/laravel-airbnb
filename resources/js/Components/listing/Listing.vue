<template>
     <Link :href="route('listing.show', props.slug)">
    <div class="col-span-1 cursor-pointer">
        <div class="flex gap-2 w-full">
            <div class="aspect-square w-full relative overflow-hidden rounded-xl">
                <img class="object-cover h-full w-full hover:scale-110 transition"
                    :src="props.image" alt="Image living" height="400" width="400" />
                <font-awesome-icon icon="fa-solid fa-heart" class="fill-white absolute -top[2px] -right-[2px]" />
            </div>
        </div>
        <div class="font-semibold text-lg mt-2">
            {{ props.location }}
        </div>
        <div class="font-light text-neutral-500">
            {{ props.category }}
        </div>
        <div class="flex items-center gap-1 mt-1">
            <div class="font-semibold">
                $ {{ props.price }}
            </div>
            <div class="font-ligth">
                Nigth
            </div>
        </div>
    </div>
</Link>
</template>

<script setup>
    const props = defineProps(['price', 'title', 'slug', 'location', 'category', 'image']);
    import { Link } from '@inertiajs/vue3';
</script>

