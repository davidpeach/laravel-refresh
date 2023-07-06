<script setup lang="ts">
import NewAuthLayout from '@/Layouts/NewAuthLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useLayoutStore } from '@/Stores/layout'

const layoutStore = useLayoutStore()
const { toggleLeft, toggleRight } = layoutStore

</script>

<template>
    <NewAuthLayout>
        <v-btn @click="toggleLeft">Toggle Left</v-btn>
        <v-btn @click="toggleRight">Toggle Right</v-btn>
    </NewAuthLayout>
</template>
