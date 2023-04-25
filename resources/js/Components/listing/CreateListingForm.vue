<template>
    <form @submit.prevent="submit" class="w-4/5">

        <div v-if="currentStep == 1">
            <div class="flex flex-col">
                <Heading title="Which of these best describes your place?" subtitle="Pick a category" />

                <div class="grid grid-cols-5 gap-4 mt-4">
                    <template v-for="cat in $page.props.categories">
                        <div :class="{ 'border-black': cat.id === category }" @click="category = cat.id"
                            class="shadow rounded-xl border-2 p-4 transition cursor-pointer hover:border-black justify-between">
                            <font-awesome-icon class="text-sm" :icon="cat.icon" disabled />
                            <div class="font-semibold">{{ cat.name }}</div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <div v-if="currentStep == 2">
            <Heading title="Where is your place located?" subtitle="Help guest find you!" />
            <!-- <CountrySelect /> -->
            <v-select v-model="location" placeholder="Select a location" label="label" :options="getAll()" value="label"
                :reduce="country => `${country.latlng}`" class="mt-4" />
            <!-- <template #option="{ label, flag }">
                        <div class="flex items-center gap-3">
                            <div>{{ flag }}</div>
                            <span class="text-neutral-800 ml-1">
                                {{ label }}
                            </span>
                        </div>
                    </template> -->
            <!-- </v-select> -->
            <Map :latlng="location" />
        </div>

        <div v-show="currentStep == 3">
            <div class="flex flex-col">
                <Heading title="Share some basics about your place?" subtitle="What amenities do you have?" />

                <br>

                <Counter title="Guests" subtitle="How many guests do you allow?"
                    @countChange="(n) => guestCount = n.value" />

                <Counter title="Rooms" subtitle="How many rooms do you have??" @countChange="(n) => roomCount = n.value" />

                <Counter title="Bathrooms" subtitle="How many bathrooms do you have??"
                    @countChange="(n) => bathroomCount = n.value" />
            </div>
        </div>

        <div v-if="currentStep == 4">
            <div class="flex flex-col">
                <Heading title="How would you describe your place?" subtitle="Short and sweet works best!" />

                <TextInput id="title" v-model="title" placeholder="Title:" type="text" class="my-2 block w-full" />

                <TextInput id="descripcion" v-model="description" placeholder="Description:" type="text"
                    class="my-2 block w-full" />
            </div>
        </div>

        <div v-if="currentStep == 5">
            <div class="flex flex-col">
                <Heading title="Add a photo of your place" subtitle="Show guests what your place looks like!" />
            </div>
        </div>

        <div class="flex justify-between align-middle mt-2">
            <PrimaryButton v-if="currentStep > 1" @click="previousStep">
                Previous
            </PrimaryButton>
            <DangerButton @click="nextStep">
                Continue
            </DangerButton>
        </div>

    </form>
</template>

<script setup>
    import { onMounted, ref } from 'vue';
    import CountrySelect from '@/Components/CountrySelect.vue'
    import TextInput from '@/Components/TextInput.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import { useCountries } from '@/Composables/countries.js';
    import Map from '@/Components/Map.vue'

    import Heading from '@/Components/Heading.vue';
    import Counter from '@/Components/Counter.vue';

    const currentStep = ref(1);
    const category = ref('');
    const location = ref([]);
    const guestCount = ref(1);
    const roomCount = ref(1);
    const bathroomCount = ref(1);
    const title = ref('');
    const description = ref('');

    const { getAll } = useCountries();

    onMounted(() => {
        console.log("MOunted");
    });

    function nextStep() {
        currentStep.value++;
    }

    function previousStep() {
        currentStep.value--;
    }

        // function submit(event)
        // {
        //    const data = Object.fromEntries(new FormData(event.target));
        // }
</script>
