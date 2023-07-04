<script setup lang="ts">

import { ref } from 'vue'
import { useLayoutStore } from '@/Stores/layout'
import { storeToRefs } from 'pinia'

const showLeft = ref(true)
const showRight = ref(false)

const layoutStore = useLayoutStore()
const { showRight } = storeToRefs(layoutStore)


function onButtonClicked() {
  console.log('here');
  showRight = !showRight
}

</script>

<template>
  <v-layout class="rounded rounded-md">
    <v-app-bar color="surface-variant" title="Application bar"></v-app-bar>

    <v-navigation-drawer v-model="showLeft">
      <v-list>
        <v-list-item title="Drawer left"></v-list-item>
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
      <v-btn @click="showRight = !showRight">Button in LayouT1</v-btn>
    </v-main>
  </v-layout>
</template>
