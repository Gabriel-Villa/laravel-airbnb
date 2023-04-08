<template>
    <DialogModal :show="showModal" @close="$emit('closeLoginForm')" maxWidth="xl">
        <template #title>
            Login
        </template>

        <template #content>
            <h3 class="font-bold text-lg mb-3">Welcome to Airbnb</h3>

            <div class="col-span-6 sm:col-span-4">
                <TextInput
                    id="email"
                    placeholder="Enter your email:"
                    type="text"
                    class="mt-1 block w-full"
                />
                <!-- <InputError :message="form.errors.name" class="mt-2" /> -->
            </div>

            <div class="col-span-6 sm:col-span-4 mt-3">
                <TextInput
                    type="password"
                    id="password"
                    placeholder="Password:"
                    class="mt-1 block w-full"
                />
                <!-- <InputError :message="form.errors.name" class="mt-2" /> -->
            </div>

            <button class="mt-8 w-full bg-[#DB0C63] border-[#243c5a] text-white py-2 px-4 rounded-lg">
                <div class="text-lg font-semibold">
                    Continue
                </div>
            </button>

            <div class="inline-flex items-center justify-center w-full">
                <hr class="w-full h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                <span
                    class="absolute px-3 font-medium text-gray-900 -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-gray-900">o</span>
            </div>

            <button class="w-full rounded-lg flex justify-between align-middle px-6 py-2.5 bg-white border border-black hover:bg-black hover:text-white transition duration-500 ">
                <font-awesome-icon class="text-lg" icon="fa-brands fa-github" />
                <p class="font-semibold text-md">Continue with Github</p>
                <p></p>
            </button>

        </template>

    </DialogModal>
</template>

<script setup>
    import { defineProps } from 'vue';
    import DialogModal from '@/Components/DialogModal.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputLabel from '@/Components/InputLabel.vue';

    defineEmits(['closeLoginForm'])

    const props = defineProps({ showModal: { default: false, type: Boolean} });
</script>
