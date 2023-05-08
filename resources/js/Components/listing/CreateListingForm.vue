<template>
    <div class="flex justify-center">
        <form @submit.prevent="submit" class="w-4/5">
            <div v-if="currentStep == steps.CATEGORY">
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

            <div v-if="currentStep == steps.LOCATION">
                <Heading title="Where is your place located?" subtitle="Help guest find you!" />

                <v-select
                    v-model="location"
                    placeholder="Select a location"
                    label="label" :options="getAll()"
                    value="label"
                    :reduce="country => `${country.id}`" class="mt-4"
                />

                <Map :latlng="location" />
            </div>

            <div v-show="currentStep == steps.DETAIL_LIVING">
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

            <div v-if="currentStep == steps.DESCRIPTION">
                <div class="flex flex-col">
                    <Heading title="How would you describe your place?" subtitle="Short and sweet works best!" />

                    <TextInput id="title" v-model="title" placeholder="Title:" type="text" class="my-2 block w-full" />

                    <TextInput id="descripcion" v-model="description" placeholder="Description:" type="text"
                        class="my-2 block w-full" />
                </div>
            </div>

            <div v-show="currentStep == steps.IMAGES">
                <div class="flex flex-col">
                    <Heading title="Add a photo of your place" subtitle="Show guests what your place looks like!" />

                    <div id="my-dropzone" class="dropzone"></div>
                    <div id="previews" class="flex justify-center mt-2"></div>
                </div>
            </div>

            <div v-if="currentStep == steps.PRICES">
                <div class="flex flex-col">
                    <Heading title="Now, set your price" subtitle="How much do you charge per night?" />

                    <TextInput id="price" v-model="price" placeholder="Price:" type="number" class="my-2 block w-full" />
                </div>
            </div>

            <div class="flex justify-between align-middle mt-2">
                <PrimaryButton type="button" v-if="currentStep > 1" @click="previousStep">
                    Previous
                </PrimaryButton>
                <DangerButton type="button" @click="nextStep" v-if="currentStep < totalSteps">
                    Continue
                </DangerButton>
                <DangerButton type="submit" v-if="currentStep === totalSteps" :class="{ 'bg-red-300' : processingForm }">
                    Save
                </DangerButton>
            </div>

        </form>
    </div>
</template>

<script setup>
    import { computed, onMounted, reactive, ref } from 'vue';
    import { useForm, router } from "@inertiajs/vue3";
    import { useCountries } from '@/Composables/countries.js';
    import { useNotification } from '@/Stores/notification.js';
    import Dropzone from "dropzone";

    import Counter from '@/Components/Counter.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import Heading from '@/Components/Heading.vue';
    import Map from '@/Components/Map.vue'
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';

    const processingForm = ref(false);

    const currentStep = ref(1);
    const category = ref('');
    const location = ref([]);
    const guestCount = ref(1);
    const roomCount = ref(1);
    const bathroomCount = ref(1);
    const title = ref('');
    const description = ref('');
    const price = ref();

    const store = useNotification();

    const steps = reactive({
        "CATEGORY": 1,
        "LOCATION": 2,
        "DETAIL_LIVING": 3,
        "DESCRIPTION": 4,
        "IMAGES": 5,
        "PRICES": 6,
    });

    const { getAll } = useCountries();

    const totalSteps = computed(() =>
    {
        return Object.keys(steps).length;
    });

    let myDropzone = '';

    onMounted(() => {
        myDropzone = new Dropzone("div.dropzone", {
            autoProcessQueue: false,
            thumbnailWidth: 100,
            thumbnailHeight: 100,
            previewsContainer: "#previews",
            paramName: "file",
            maxFilesize: 4,
            renameFile: function (file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png",
            url: "/listing",
            addRemoveLinks: true,
            clickable: true,
            dictDefaultMessage: "Drag your files here",
            dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
            dictInvalidFileType: "You can't upload files of this type.",
        });
        myDropzone.on("addedfile", function (file) {
            // console.log("Archivo agregado: ", file.name);
        });
    })


    const nextStep = () => currentStep.value++;

    const previousStep = () =>  currentStep.value--;

    function submit()
    {
        processingForm.value = true;

        const form = useForm({
            category: category.value,
            location: location.value,
            guestCount: guestCount.value,
            roomCount: roomCount.value,
            bathroomCount: bathroomCount.value,
            title: title.value,
            description: description.value,
            image: myDropzone.files,
            price: price.value
        });

        form.post(route('listing.store'), {
            preserveScroll: true,
            onSuccess: (res) => {
                console.log("Res", res);
                store.addToast({message: res.props.flash.toast});
                router.visit(route('home'));
            },
            onError: (err) => {
                for (let key in err)
                {
                    store.addToast({message: err[key], type: 'error'});
                }
            },
            onFinish: visit => processingForm.value = false
        });
    }
</script>
