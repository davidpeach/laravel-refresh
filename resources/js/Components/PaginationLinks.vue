<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

defineProps({
  links: Array
})
</script>

<template>
  <div v-if="links.length > 3">
    <div>
      <template v-for="link in links">
        <div v-if="link.url === null">{{ link.label }}</div>
        <Link v-else :href="link.url">{{ link.label }}</Link>
      </template>
    </div>
  </div>
</template>
