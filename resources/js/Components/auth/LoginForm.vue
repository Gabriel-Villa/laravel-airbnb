<template>
    <DialogModal :show="showModal" @close="$emit('closeLoginForm')" maxWidth="xl">
        <template #title>
            Login
        </template>

        <template #content>
            <h3 class="font-bold text-lg">Welcome to Airbnb</h3>

            <div class="mt-4">
                <select class="select-airbn">
                    <option selected>Choose a country</option>
                        <template v-for="country in countries.list" :key="country.id">
                            <option :value="country.id">{{ country.name }}</option>
                        </template>
                </select>

                <!-- <InputError :message="form.errors.password" class="mt-2" /> -->
            </div>

            <p class="text-normal my-4">
                We are going to confirm the number by phone or text message.
                Subject to the standard messages and data rates

                Privacity Policy
            </p>

            <button class="w-full bg-[#DB0C63] border-[#243c5a] text-white py-2 px-4 rounded-lg">
                <div class="text-lg font-semibold">
                    Continue
                </div>
            </button>

            <div class="inline-flex items-center justify-center w-full">
                <hr class="w-full h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                <span
                    class="absolute px-3 font-medium text-gray-900 -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-gray-900">o</span>
            </div>

            <button class=" w-full rounded-lg flex justify-between align-middle px-6 py-2.5 bg-white border border-black">
                <font-awesome-icon class="text-lg" icon="fa-brands fa-github" />
                <p class="font-semibold text-md">Continue with Github</p>
                <p></p>
            </button>

        </template>

    </DialogModal>
</template>

<script setup>
    import { onMounted, ref, defineProps, onUnmounted, watch, reactive } from 'vue';
    import DialogModal from '@/Components/DialogModal.vue';

    import { useHttp } from '@/Composables/helpHttp.js';
    const { get } = useHttp();

    defineEmits(['closeLoginForm'])

    const props = defineProps({ showModal: { default: false, type: Boolean} });

    const countries = reactive({ list: [] });

    onMounted(async() =>
    {
        let res = await get("api/v1/countries");

        countries.list = res.data?.countries;
    });
</script>
