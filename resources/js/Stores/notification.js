import { defineStore } from "pinia";

export const useNotification = defineStore('notification', {

    state: () => {
        return {
            toasts: []
        }
    },

    actions : {
        addToast(toast)
        {
            this.toasts.unshift({
                id: Symbol(),
                ...toast
            });
        },
        removeToast(id)
        {
            this.toasts = this.toasts.filter((toast) => toast.id !== id);
        }
    }

});

