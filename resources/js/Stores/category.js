import { useHttp } from '@/Composables/helpHttp.js';

const helpHttp = useHttp();

export const useCategoryStore = defineStore('category', () => {
    state: () => ({
        categories: [],
    }),
    getters: {
        doubleCount: (state: String) => state.count * 2,
    }

})
