<template>
    <div class="">
        <div class="flex flex-row items-center gap-3">
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
            z-10
        ">
        <div class="flex flex-col cursor-pointer" v-if="!user">
            <menu-item @click="toggleLoginForm">Login</menu-item>
            <menu-item>Sing up</menu-item>
        </div>
        <div class="flex flex-col cursor-pointer" v-else>

            <div
                class="text-sm font-semibold py-3 px-4 hover:bg-neutral-100 transition cursor-pointer text-center border-b-2 border-neutral-200">
                <template v-if="user">
                    {{ user.name }}
                </template>
            </div>

            <menu-item @click="logOut">Log Out</menu-item>
            <menu-item @click="router.visit(route('listing.index'))">Add your Space</menu-item>
        </div>
    </div>

    <LoginForm :showModal="showLoginForm" @closeLoginForm="closeLoginForm"/>

    <LoginForm :showModal="false" @closeLoginForm=""/>

</template>

<script setup>

    import { onMounted, onUnmounted, ref } from 'vue';
    import { router, usePage } from '@inertiajs/vue3'
    import { useNotification } from '@/Stores/notification.js';

    import Avatar from '@/Components/Avatar.vue'
    import MenuItem from '@/Components/navbar/MenuItem.vue'
    import LoginForm from '../auth/LoginForm.vue';

    const store = useNotification();

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
        router.visit(route('app.logout'), { method: 'post' });
        router.visit(route('home'));
        store.addToast({message: 'Success'})
    }

    onMounted(() => {
        window.addEventListener("click", closeDropdown);
    });

    onUnmounted(() => {
        window.removeEventListener("click", closeDropdown);
    });

    function closeDropdown(e)
    {
        if (!document.getElementById('dropdown-user-menu').contains(e.target)){
            showUserMenu.value = false;
        }
    }

    const closeLoginForm = () => showLoginForm.value = false;

</script>
