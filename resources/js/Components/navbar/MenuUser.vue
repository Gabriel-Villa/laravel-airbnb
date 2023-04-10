<template>
    <div class="">
        <div class="flex flex-row items-center gap-3">
            <div
                class="hidden md:block text-sm font-semibold py-3 px-4 rounded-full hover:bg-neutral-100 transition cursor-pointer">
                <template v-if="user">
                    {{ user.name }}
                </template>
            </div>
            <div class="
                flex
                justify-between
                align-middle
                rounded-full
                shadow-md
                border-[1px]
                border-neutral-200
                px-2
                py-1
            ">
                <div class="
                        px-2.5 py-2
                        flex
                        items-center
                        gap-3
                        rounded-full
                        cursor-pointer
                        transition
                    ">
                    <font-awesome-icon class="font-sm text-[#595959]" icon="fa-solid fa-bars" />
                </div>
                <div class="
                        hidden
                        md:block
                    ">
                    <Avatar @toggleUserMenu="showUserMenu = !showUserMenu" />
                </div>
            </div>
        </div>
    </div>

    <div v-if="showUserMenu" class="
            absolute
            rounded-xl
            shadow-lg
            bg-white
            w-[13vw]
            overflow-hidden
            top-20
            right-20
            text-sm
        ">
        <div class="flex flex-col cursor-pointer" v-if="!user">
            <menu-item @click="toggleLoginForm">Login</menu-item>
            <menu-item>Sing up</menu-item>
        </div>
        <div class="flex flex-col cursor-pointer" v-else>
            <menu-item @click="logOut">Log Out</menu-item>
        </div>
    </div>

    <LoginForm :showModal="showLoginForm" @closeLoginForm="closeLoginForm"/>

</template>

<script setup>

    import { ref } from 'vue';
    import { router, usePage, Link } from '@inertiajs/vue3'

    import Avatar from '@/Components/Avatar.vue'
    import NavLink from '@/Components/NavLink.vue'
    import MenuItem from '@/Components/navbar/MenuItem.vue'
    import LoginForm from '../auth/LoginForm.vue';

    const user = usePage().props.auth.user;

    const showUserMenu = ref(false);
    const showLoginForm = ref(false);

    function toggleLoginForm()
    {
        showLoginForm.value = true;
        showUserMenu.value = false;
    }

    function logOut()
    {
        router.visit('/app/logout', { method: 'post' });
        router.visit('/dashboard');
    }

    const closeLoginForm = () => showLoginForm.value = false;

</script>
