<template>
    <div class="">
        <div class="flex flex-row items-center gap-3">
            <div
                class="hidden md:block text-sm font-semibold py-3 px-4 rounded-full hover:bg-neutral-100 transition cursor-pointer">
                Airnb your home
            </div>
            <div class="
                        px-2.5 py-2
                        border-[1px]
                        border-neutral-200
                        flex
                        items-center
                        gap-3
                        rounded-full
                        cursor-pointer
                        transition
                    ">
                <font-awesome-icon class="font-sm" icon="fa-solid fa-bars" />
            </div>
            <div class="
                    hidden
                    md:block
                ">
                <Avatar @toggleUserMenu="showUserMenu = !showUserMenu" />
            </div>
        </div>
    </div>


    <div v-if="showUserMenu" class="
            absolute
            rounded-xl
            shadow-lg
            bg-white
            w-[10vw]
            overflow-hidden
            top-20
            right-20
            text-sm
        ">
        <div class="flex flex-col cursor-pointer">
            <MenuItem @click="showLoginModal = !showLoginModal">Login</MenuItem>
            <MenuItem>Sing up</MenuItem>
        </div>
    </div>

    <DialogModal :show="showLoginModal" @close="closeLoginModal" maxWidth="xl">
        <template #title>
            Login
        </template>

        <template #content>
            <h3 class="font-bold text-lg">Welcome to Airbnb</h3>

            <div class="mt-4">
                <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose a country</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
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
                <span class="absolute px-3 font-medium text-gray-900 -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-gray-900">o</span>
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

    import { ref, onMounted } from 'vue';

    import Avatar from '@/Components/Avatar.vue'
    import MenuItem from '@/Components/navbar/MenuItem.vue'

    import ActionSection from '@/Components/ActionSection.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import DialogModal from '@/Components/DialogModal.vue';
    import InputError from '@/Components/InputError.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
import axios from 'axios';

    const showUserMenu = ref(false);
    const showLoginModal = ref(false);
    const closeLoginModal = ref(false);

    const countries = ref([]);


    onMounted(() => {
        axios.get('/api/v1/countries').then((res) => console.log(res));
    });



</script>
