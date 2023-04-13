
<template>
    <Layout title="Home Page">


            <!-- <div v-if="props.users.data.length <= 0" class="h-[60vh] flex flex-col gap-2 justify-center items-center">
                <h1 class="text-2xl first-letter:semibold">No matches</h1>
                <p class="font-light text-neutral-500 mt-2">
                    Try to changeing or remoing some of your filters
                </p>
            </div> -->

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-8">

                <div class="col-span-1 cursor-pointer" v-for="n in Math.floor(Math.random() * 20) + 1"  :key="n">
                    <div class="flex gap-2 w-full">
                        <div class="aspect-square w-full relative overflow-hidden rounded-xl">
                            <img class="object-cover h-full w-full hover:scale-110 transition" src="https://a0.muscache.com/im/pictures/miso/Hosting-29459696/original/d13b86bf-4f1c-43f0-a44e-8a9edfda26f1.jpeg?im_w=720" />
                            <font-awesome-icon icon="fa-solid fa-heart" class="fill-white absolute -top[2px] -right-[2px]" />
                        </div>
                    </div>
                    <div class="font-semibold text-lg mt-2">
                        Peru, Lima
                    </div>
                    <div class="font-light text-neutral-500">
                        Beach
                    </div>
                    <div class="flex items-center gap-1">
                        <div class="font-semibold mt-1">
                            500 S/
                        </div>
                        <div class="font-ligth">
                            nigth
                        </div>
                    </div>
                </div>
                <!-- <img src="https://a0.muscache.com/im/pictures/miso/Hosting-29459696/original/d13b86bf-4f1c-43f0-a44e-8a9edfda26f1.jpeg?im_w=720" /> -->
            </div>

        <!-- <p v-for="(listing, index) in props.users.data" :key="index">
            {{ listing.name }} {{ listing.id }}
        </p> -->
    </Layout>
</template>

<script setup>
    import Layout from '@/Layouts/Layout.vue';
    import { usePage } from '@inertiajs/vue3';
    import { defineProps } from 'vue';

    const props = defineProps({
        users : {
            type : Object,
            required: false,
            default: []
        }
    });

    console.log(usePage().props);

</script>
