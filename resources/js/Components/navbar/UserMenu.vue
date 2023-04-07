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
                <Avatar @toggleUserMenu="showUserMenu = !showUserMenu"  />
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
            <MenuItem>Login</MenuItem>
            <MenuItem>Sing up</MenuItem>
        </div>
    </div>


</template>

<script setup>

    import { ref } from 'vue';

    import Avatar from '@/Components/Avatar.vue'
    import MenuItem from '@/Components/navbar/MenuItem.vue'

    const showUserMenu = ref(false);

</script>
