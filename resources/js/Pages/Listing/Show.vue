
<template>
    <Layout title="Put your space in airbnb">
        <form @submit.prevent="submit">
            <div class="mt-8 w-4/6 mx-auto">
                <div class="text-2xl font-bold capitalize">
                    {{ props.listing.title }}
                </div>
                <div class="text-sm font-bold underline my-2">
                    {{ props?.listing.location?.name }}
                </div>
                <div class="w-full rounded-xl sm:h-[30vh] md:h-[50vh] relative overflow-hidden">
                    <img class="object-cover w-full" alt="image" fetchpriority="high" rel="preload"
                        :src="props.listing.image.url">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 md:gap-6 mt-6 mb-">
                    <div class="col-span-2">
                        <div class="col-span-4 flex flex-col gap-4">
                            <div class="flex flex-col gap-2">
                                <div class="flex gap-2 text-xl font-semibold">
                                    Host by: {{ props.listing.user.name }}
                                </div>
                            </div>
                            <div class="flex flex-row items-center gap-4 text-neutral-600">
                                <div>{{ props.listing.guestCount }} guests</div>
                                <div>{{ props.listing.roomCount }} rooms</div>
                                <div>{{ props.listing.bathroomCount }} bathrooms</div>
                                <div> <font-awesome-icon class="font-sm text-[#595959]" :icon="props.listing.category.icon" />
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <div class="text-md text-neutral-600">
                            About the place: {{ props.listing.description }}
                        </div>
                        <hr class="my-4" />
                        <Map :latlng="props.listing.location.code" />
                    </div>
                    <div class="shadow p-4 h-72">
                        <div class="flex items-center mb-4">
                            <h4 class="font-semibold text-md">$ {{ props.listing.price }}</h4>
                            <span class="text-sm ml-2">nigth</span>
                        </div>
                        <div class="flex gap-2 flex-col">
                            <div class="w-full">
                                <InputLabel for="start_date" value="Start date" />
                                <input v-model="form.startDate" type="date" id="start_date" class="w-full">
                            </div>
                            <div class="w-full">
                                <InputLabel for="end_date" value="End date" />
                                <input v-model="form.endDate" type="date" id="end_date" class="w-full" placeholder="yyyy-mm-dd">
                            </div>
                        </div>

                        <p class="my-4">
                            Total: $ {{ totalAmount }}
                        </p>

                        <DangerButton type="submit" :disabled="form.processing" class="w-full" v-if="$page.props.auth.user">Reserve</DangerButton>
                        <DangerButton class="w-full opacity-25 cursor-not-allowed" v-else>Log in to Reserve</DangerButton>
                    </div>
                </div>

            </div>
        </form>
    </Layout>
</template>

<script setup>
    import { defineProps, ref, watch } from 'vue';
    import moment from 'moment';
    import { useForm } from '@inertiajs/vue3'
    import { useNotification } from '@/Stores/notification.js';

    import DangerButton from '@/Components/DangerButton.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import Layout from '@/Layouts/Layout.vue';
    import Map from '@/Components/Map.vue'

    const store = useNotification();

    const form = useForm({
        startDate: moment().format("YYYY-MM-DD"),
        endDate: moment().format("YYYY-MM-DD"),
    })

    const totalAmount = ref(props.listing.price);

    watch(form, (newValue, oldValue) =>
    {
        const start = new Date(newValue.startDate).getTime()
        const end = new Date(newValue.endDate).getTime()
        const diffInMs = end - start
        let total = Math.floor(diffInMs / 86400000) * props.listing.price;

        if (total <= 0) {
            store.addToast({ message: 'Please select a correct date range' });
            total = 0;
        }

        totalAmount.value = total;
    });

    const props = defineProps({
        listing: {
            type: Object,
            required: true,
        }
    });

    function submit()
    {
        form
            .transform((data) => ({
                ...data,
                listingId: props.listing.id
            }))
            .post(route('reservation.store'), {
            preserveScroll: true,
                onError : (err) => {
                    store.addToast({ message: 'Try again'});
                },
                onSuccess: (res) => {
                    store.addToast({ message: res.props?.flash?.toast});
                    form.reset('');
                },
            })
    }
</script>
