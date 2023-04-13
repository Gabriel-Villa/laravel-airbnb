<template>
    <div class="w-full z-10 shadow-sm">
        <div class="py-4 border-b-[1px]">
            <Container>
                <div class="
                    flex
                    items-center
                    justify-between
                    gap-3
                    md:gap-0
                ">
                    <Logo />
                    <Search />
                    <MenuUser />
                </div>
            </Container>
        </div>

        <Container>
            <Categories />
        </Container>
    </div>
</template>

<script setup>

    import Container from '@/Components/Container.vue';
    import Logo from '@/Components/navbar/Logo.vue';
    import Search from '@/Components/navbar/Search.vue';
    import MenuUser from '@/Components/navbar/MenuUser.vue';
    import Categories from '@/Components/navbar/Categories.vue';

</script>

