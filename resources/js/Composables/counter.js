import { ref } from "vue";

export function useCounter()
{
    const counter = ref(1);

    function increment()
    {
        if(counter.value >= 15)
        {
            return;
        }

        counter.value++;
    }

    function decrement()
    {
        if(counter.value <= 1)
        {
            return;
        }

        counter.value--;
    }

    return {
        counter,
        increment,
        decrement
    }
}
