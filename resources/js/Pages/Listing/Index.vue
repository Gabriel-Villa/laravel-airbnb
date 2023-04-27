<template>
    <Container>

        <ToastList />

        <div class="w-full py-4">
            <div class="flex justify-between align-center">
                <Logo />
            </div>
        </div>

        <!-- <div class="text-center mt-20 flex justify-center w-3/6 mx-auto">
            <div class="w-7/12 mt-12">
                <div v-show="!showModalListing">
                    <h1 class="text-6xl font-bold text-[#FF385C]">
                        Put in Airbnb.
                    </h1>

                    <h5 class="text-6xl font-bold mt-2">Can we earn</h5>
                    <p class="text-7xl font-bold mt-5">S/ {{ totalPrice }}</p>
                    <p class="mt-8">
                        <span class="font-bold underline">{{ currentValue }} nights</span>
                        at an stimateprice of S/ {{ price }} per night
                    </p>

                    <input id="minmax-range" type="range" min="1" :max="lastDayOfMonth" v-model="currentValue"
                        @input="updateCurrentValue" @change="showcurrentValue = false"
                        class="w-full mt-8 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">

                    <button
                        @click="showModalListing = true"
                        class="my-4 rounded-lg bg-gradient-to-r from-[#e61e4d] via-[#d70466] to-[#bd1e59] text-white px-4 py-3">
                        <p class="font-semibold">
                            <font-awesome-icon icon="fa-solid fa-house" /> Start
                        </p>
                    </button>
                </div>
            </div>
        </div> -->

        <transition>
            <div class="mt-20 flex justify-center" >
                <CreateListingForm  />
            </div>
        </transition>

    </Container>
</template>

<script setup>

    import Container from '@/Components/Container.vue';
    import Logo from '@/Components/navbar/Logo.vue';
    import ToastList from '@/Components/ToastList.vue';
    import CreateListingForm from '@/Components/listing/CreateListingForm.vue'
    import { computed, ref } from 'vue';

    import moment from 'moment';

    const currentValue = ref(7);
    const price = ref(181);
    const showcurrentValue = ref(false);
    const lastDayOfMonth = ref(moment().endOf('month').format('D'));

    const totalPrice = computed(() => {
        return price.value * currentValue.value
    });

</script>

<style scoped>
    .v-enter-active,
    .v-leave-active {
        transition: opacity 0.5s ease;
    }

    .v-enter-from,
    .v-leave-to {
        opacity: 0;
    }
</style>
