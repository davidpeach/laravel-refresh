<script setup lang="ts">

import { ref } from 'vue'
import { useLayoutStore } from '@/Stores/layout'
import { storeToRefs } from 'pinia'

const layoutStore = useLayoutStore()
const { showLeft, showRight} = storeToRefs(layoutStore)
</script>

<template>
  <v-layout class="rounded rounded-md">
    <v-app-bar color="surface-variant" title="Dave's Dashboard" />

    <v-navigation-drawer v-model="showLeft">
      <v-list>
        <v-list-item prepend-icon="mdi-note-edit" title="Posts"></v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-navigation-drawer location="right" v-model="showRight" temporary>
      <v-list>
        <v-list-item title="Drawer right"></v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-main class="d-flex align-center justify-center" style="min-height: 300px;">
      <slot />
      Main Content
    </v-main>
  </v-layout>
</template>
