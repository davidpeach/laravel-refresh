<script setup lang="ts">
import NewAuthLayout from '@/Layouts/NewAuthLayout.vue';
import { Head } from '@inertiajs/vue3';

const emit = defineEmits<{
  (e: 'moose'): void
}>();

function buttonClick() {
    emit('moose')
}

</script>

<template>
    <NewAuthLayout>
        <v-btn @click="buttonClick">Button in Component</v-btn>
    </NewAuthLayout>
</template>
