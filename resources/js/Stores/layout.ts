import { defineStore } from 'pinia'

export const useLayoutStore = defineStore('layout', {
    state: () => ({
        showLeft : true,
        showRight : false,
        currentPost: false,
    }),

    actions: {
        toggleLeft() {
            this.showLeft = !this.showLeft
        },
        toggleRight() {
            this.showRight = !this.showRight
        },
        async loadPost(id: number) {
            const response = await fetch('/dashboard/articles/' + id, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })

            const result = await response.json()

            return result.data
        },
    }
})
