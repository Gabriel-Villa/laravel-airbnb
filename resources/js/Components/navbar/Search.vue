<template>

    <div class="
        border-[1px]
        w-auto
        md:w-auto
        py-2
        rounded-full
        shadow-sm
        hover:shadow-md
        transition
        cursor-pointer
    ">
        <div class="
            flex
            flex-row
            items-center
            justify-between
        ">
            <div class="text-sm font-semibold px-6">
                Anywhere
            </div>
            <div class="
                hidden
                sm:block
                text-sm
                font-semibold
                px-6
                border-x-[1px]
                text-center
            ">
                Any week
            </div>
            <div class="
                text-sm
                pl-6
                pr-2
                text-gray-600
                gap-3
                flex
                items-center
            ">
                <div class="hidden sm:block">
                    Add Guests
                </div>
                <div class="px-2 py-1.5  bg-rose-500 rounded-full text-white">
                    <font-awesome-icon class="text-sm" icon="fa-solid fa-magnifying-glass" />
                </div>
            </div>
        </div>
    </div>

</template>
