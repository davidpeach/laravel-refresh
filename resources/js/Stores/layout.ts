import { defineStore } from 'pinia'

export const useLayoutStore = defineStore('layout', {
    state: () => ({
        showRight : false,
    }),

    actions: {
        toggleRight() {
            this.showRight = !this.showRight
        }
    }
})
