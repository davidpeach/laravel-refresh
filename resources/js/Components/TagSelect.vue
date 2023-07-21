<script setup lang="ts">

defineProps({
    tags: Array,
    modelValue: Array,
})

defineEmits(['update:model-value'])
</script>

<template>
    <v-select
        :modelValue="modelValue"
        @update:modelValue="$emit('update:model-value', $event)"
        :items="tags"
        chips
        multiple
        label="Chips"
    >
    </v-select>
</template>
