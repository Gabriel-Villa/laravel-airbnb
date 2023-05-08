
<template>
    <Layout title="Put your space in airbnb">
        <form @submit.prevent="submit">
            <div class="mt-8 w-4/6 mx-auto">
                <div class="text-2xl font-bold capitalize">
                    {{ props.listing.title }}
                </div>
                <div class="text-sm font-bold underline my-2">
                    {{ props?.listing.location?.name }},  {{ props?.listing.location?.code }}
                </div>
                <div class="w-full rounded-xl hover:scale-100">
                    <img class="object-cover w-full h-[500px]" alt="image" fetchpriority="high" rel="preload" :src="props.listing.image.url">
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 md:gap-6 mt-6 mb-">
                    <div class="col-span-1 lg:col-span-2">
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
                            <h4 class="font-semibold text-md">{{ props.listing.price }}</h4>
                            <span class="text-sm ml-1">- nigth</span>
                        </div>
                        <div class="flex gap-2 flex-col">
                            <InputLabel for="start_date" value="Select a range range" />
                            <input type="text" id="date_range" class="w-full">
                            <!-- <div class="w-full">

                                <input v-model="form.startDate" type="date" id="start_date" class="w-full">
                            </div>
                            <div class="w-full">
                                <InputLabel for="end_date" value="End date" />
                                <input v-model="form.endDate" type="date" id="end_date" class="w-full" placeholder="yyyy-mm-dd">
                            </div> -->
                        </div>

                        <p class="my-4">
                            Total: {{ totalAmount }}
                        </p>

                        <DangerButton type="submit" :class="{ 'opacity-25': btnDisabled }" class="w-full" :disabled=btnDisabled v-if="$page.props.auth.user">
                            Reserve
                        </DangerButton>
                        <DangerButton class="w-full opacity-25 cursor-not-allowed" v-else>Log in to Reserve</DangerButton>
                    </div>
                </div>

            </div>
        </form>
    </Layout>
</template>

<script setup>
    import { defineProps, onMounted, ref, watch } from 'vue';
    import { router } from '@inertiajs/vue3';
    import moment from 'moment';
    import { useNotification } from '@/Stores/notification.js';

    import DangerButton from '@/Components/DangerButton.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import Layout from '@/Layouts/Layout.vue';
    import Map from '@/Components/Map.vue'

    import AirDatepicker from 'air-datepicker';
    import 'air-datepicker/air-datepicker.css';
    import localeEn from 'air-datepicker/locale/en';

    const props = defineProps({
        listing: {
            type: Object,
            required: true,
        },
        normalPrice: {
            type: Number
        }
    });

    const store = useNotification();

    const totalAmount = ref(props.normalPrice);
    const startDate = ref(moment().format("DD/MM/YYYY"));
    const endDate = ref(moment().add(2, 'days').format("DD/MM/YYYY"));
    const btnDisabled = ref(false);

    onMounted(() =>
    {
        new AirDatepicker('#date_range', {
                dateFormat: "dd/MM/yyyy",
                selectedDates: [new Date(), new Date().setDate(new Date().getDate() + 2)],
                minDate: new Date(),
                range: true,
                multipleDatesSeparator: ' - ',
                locale: localeEn,
                onSelect({date, formattedDate, datepicker}) {
                    if(formattedDate.length <= 1)
                    {
                        store.addToast({message: 'Please donde forget to select the end date'});
                        btnDisabled.value = true;
                        return false;
                    }

                    btnDisabled.value = false;
                    startDate.value = formattedDate[0];
                    endDate.value = formattedDate[1];
                }
            }
        )
    });

    watch(endDate,  (endNewValue, endOldValue) =>
    {
        let start = moment(startDate.value, "DD/MM/YYYY").toDate();
        let end = moment(endNewValue, "DD/MM/YYYY").toDate();

        const test1 = new Date(start).getTime();
        const test2 = new Date(end).getTime();

        const diffInMs = test2 - test1

        let total = Math.floor(diffInMs / 86400000) * props.normalPrice;

        console.log(total);

        if (total <= 0)
        {
            store.addToast({ message: 'Please select a correct date range', type: 'error' });

            totalAmount.value = 0;

            return false;
        }

        totalAmount.value = Math.round(total);
    });

    function submit()
    {
        btnDisabled.value = true;

        router.visit(route('reservation.store'),
        {
            method: 'post',
            data: {
                startDate: startDate.value,
                endDate: endDate.value,
                listingId: props.listing.id,
            },
            preserveScroll: true,
            onSuccess: (res) => {
                store.addToast({ message: res.props?.flash?.toast});
                // form.reset('');
            },
            onError : (err) =>
            {
                for (let key in err)
                {
                    store.addToast({message: err[key], type: 'error'});
                }
            },
            onFinish: visit => {
                btnDisabled.value = false;
            },
        })
    }
</script>
