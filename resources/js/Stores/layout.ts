import { defineStore } from 'pinia'

export const useLayoutStore = defineStore('layout', {
    state: () => ({
        showLeft : true,
        showRight : false,
    }),

    actions: {
        toggleLeft() {
            this.showLeft = !this.showLeft
        },
        toggleRight() {
            this.showRight = !this.showRight
        }
    }
})
