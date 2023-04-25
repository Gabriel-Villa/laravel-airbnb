<template>
   <div className="flex flex-row items-center justify-between my-3">
      <div className="flex flex-col">
        <div className="font-medium">{{ title }}</div>
        <div className="font-light text-gray-600">
          {{ subtitle }}
        </div>
      </div>
      <div className="flex flex-row items-center gap-4">
        <div
            @click="decrementCounter"
            className="
                w-10
                h-10
                rounded-full
                border-[1px]
                border-neutral-400
                flex
                items-center
                justify-center
                text-neutral-600
                cursor-pointer
                hover:opacity-80
                transition
            "
        >
        <font-awesome-icon icon="fa-solid fa-minus" />
        </div>
        <div
          className="
            font-light
            text-xl
            text-neutral-600
          "
        >
            {{ counter }}
          </div>
        <div
            @click="incrementCounter"
            className="
                w-10
                h-10
                rounded-full
                border-[1px]
                border-neutral-400
                flex
                items-center
                justify-center
                text-neutral-600
                cursor-pointer
                hover:opacity-80
                transition
            "
        >
        <font-awesome-icon icon="fa-solid fa-plus" />
        </div>
      </div>
    </div>
</template>

<script setup>
    import { useCounter } from '@/Composables/counter.js';

    const { counter, increment, decrement } = useCounter();

    defineProps(['title', 'subtitle', 'value']);

    const emit = defineEmits(['countChange']);

    function incrementCounter()
    {
        increment();
        emit("countChange", counter);
    }

    function decrementCounter()
    {
        decrement();
        emit("countChange", counter);
    }
</script>
