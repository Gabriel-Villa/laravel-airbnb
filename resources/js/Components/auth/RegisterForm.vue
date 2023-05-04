<template>
    <DialogModal :show="showModal" @close="$emit('closeRegisterForm')" maxWidth="xl">
        <template #title>
            Register
        </template>

        <template #content>
            <h3 class="font-bold text-lg mb-3">Welcome to Airbnb</h3>
            <form @submit.prevent="submit">
                <div class="col-span-6 sm:col-span-4">
                    <TextInput
                        id="name"
                        v-model="form.name"
                        autocomplete="off"
                        placeholder="Enter your name:"
                        type="text"
                        class="mt-1 block w-full"
                    />

                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4 mt-3">
                    <TextInput
                        type="email"
                        id="email"
                        v-model="form.email"
                        autocomplete="off"
                        placeholder="Email:"
                        class="mt-1 block w-full"
                    />

                    <InputError :message="form.errors.email" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4 mt-3">
                    <TextInput
                        type="password"
                        id="password"
                        v-model="form.password"
                        autocomplete="off"
                        placeholder="Password:"
                        class="mt-1 block w-full"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <button :disabled="form.processing" class="mt-8 w-full bg-[#DB0C63] border-[#243c5a] text-white py-2 px-4 rounded-lg">
                    <div class="text-lg font-semibold">
                        Continue
                    </div>
                </button>
            </form>

        </template>

    </DialogModal>
</template>

<script setup>
    import { defineProps } from 'vue';
    import DialogModal from '@/Components/DialogModal.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { router, useForm } from '@inertiajs/vue3';
    import InputError from '../InputError.vue';

    import { useNotification } from '@/Stores/notification.js';

    const store = useNotification();

    const emit = defineEmits(['closeRegisterForm'])

    const props = defineProps({
        showModal: { default: false, type: Boolean},
        errors: Object
    });

    const form = useForm({name: "", email: "",password: ""});

    const submit = () =>
    {
        let url = route('app.register');

        form.post(url, {
            onSuccess: (res) => {
                router.visit(route('home'))
                emit('closeRegisterForm');
                store.addToast({message: 'Register successfull'});
            },
            onError : (err) => {
                errorToast({message: 'Please try again', type: 'error'});
            }
        });

    };

</script>

