<script setup lang="ts">
import NewAuthLayout from '@/Layouts/NewAuthLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
    foo: string,
}>
</script>

<template>
    <NewAuthLayout>
        <p>LOLCAT</p>
    </NewAuthLayout>
</template>
