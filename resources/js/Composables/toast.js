import { ref } from "vue";

export function useToast()
{

    const toasts = ref([]);

    function addToast(toast)
    {
        toasts.value.unshift({id: Symbol(), ...toast});
    }

    function deleteToast(key)
    {
        console.log(key);
        toasts.value = toasts.value.filter((toast) => toast.id != key);
    }

    return {
        addToast,
        deleteToast,
        toasts
    }

}
