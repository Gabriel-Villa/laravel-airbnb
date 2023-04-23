<template>
    <form @submit.prevent>

        <div>
            <h1 class="text-2xl font-semibold text-start">
                Which of these best describes your place ?
            </h1>
            <p class="font-light text-start text-slate-600">
                Pick a category
            </p>
        </div>

        <!-- <div>
            2. Location
        </div> -->

        <!-- <div>
            3. Info
        </div>

        <div class="flex justify-between align-middle">
            <button class="bg-green-400 text-white rounded">
                Previus
            </button>
            <button class="bg-black text-white rounded">
                Continue
            </button>
        </div> -->

    </form>
</template>


<script setup>
import { ref } from 'vue';

const steps = ref(['CATEGORY', 'LOCATION', 'INFO', 'IMAGES', 'DESCRIPTION', 'PRICES']);
</script>
