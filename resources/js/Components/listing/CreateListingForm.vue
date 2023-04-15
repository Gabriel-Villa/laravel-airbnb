<template>
    <DialogModal :show="showModal" @close="$emit('closeLoginForm')" maxWidth="xl">
        <template #title>
            Login
        </template>

        <template #content>
            <h3 class="font-bold text-lg mb-3">Welcome to Airbnb</h3>
            <form @submit.prevent="submit">
                <div class="col-span-6 sm:col-span-4">
                    <TextInput
                        id="email"
                        v-model="form.email"
                        placeholder="Enter your email:"
                        type="text"
                        class="mt-1 block w-full"
                    />

                    <InputError :message="form.errors.email" class="mt-2" />
                </div>

                <button :disabled="form.processing" class="mt-8 w-full bg-[#DB0C63] border-[#243c5a] text-white py-2 px-4 rounded-lg">
                    <div class="text-lg font-semibold">
                        Continue
                    </div>
                </button>
            </form>

            <a :href="route('login.redirect')" :disabled="form.processing" as="button" class="w-full rounded-lg flex justify-between align-middle px-6 py-2.5 bg-white border border-black hover:bg-black hover:text-white transition duration-500 ">
                <font-awesome-icon class="text-lg" icon="fa-brands fa-github" />
                <p class="font-semibold text-md">Continue with Github</p>
                <p></p>
            </a>

        </template>

    </DialogModal>
</template>

<script setup>
    import { defineProps } from 'vue';
    import DialogModal from '@/Components/DialogModal.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { router, useForm, Link } from '@inertiajs/vue3';
    import InputError from '../InputError.vue';

    import { useToast } from '@/Composables/toast.js';

    const { successToast, errorToast } = useToast();

    const emit = defineEmits(['closeLoginForm'])

    const props = defineProps({
        showModal: { default: false, type: Boolean},
        errors: Object
    });

    const form = useForm({
        email: "dev@gmail.com",
        password: "1234",
    });

    const submit = () =>
    {


    };

</script>

