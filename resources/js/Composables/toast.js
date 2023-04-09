import { toast } from 'vue3-toastify';

export function useToast()
{

    function successToast({ message })
    {
        toast.success(message, {
            theme: 'colored',
            position: toast.POSITION.TOP_RIGHT,
            pauseOnHover: true
        });
    }

    function errorToast({ message })
    {
        toast.error(message, {
            theme: 'colored',
            position: toast.POSITION.TOP_RIGHT,
            pauseOnHover: true
        });
    }

    return {
        successToast,
        errorToast,
    }

}
