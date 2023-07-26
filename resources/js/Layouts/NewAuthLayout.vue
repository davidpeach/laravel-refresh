<script setup lang="ts">

import { useLayoutStore } from '@/Stores/layout'
import { storeToRefs } from 'pinia'
import { Link } from '@inertiajs/vue3'

const layoutStore = useLayoutStore()
const { showLeft, showRight } = storeToRefs(layoutStore)

function closeEdit() {
  layoutStore.currentPost = false
  layoutStore.toggleRight()
}

</script>

<template>
  <v-app class="rounded rounded-md">
    <v-app-bar color="surface-variant" title="Dave's Dashboard" />

    <v-navigation-drawer location="right" v-model="showRight" width="3000" temporary>
      <slot name="drawer"></slot>
    </v-navigation-drawer>

    <v-navigation-drawer v-model="showLeft">
      <v-list>
        <v-list-item prepend-icon="mdi-note-edit">
          <Link href="/dashboard/articles">Articles</Link>
        </v-list-item>
        <v-list-item prepend-icon="mdi-note-edit">
          <Link href="/dashboard/notes">Notes</Link>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-main class="d-flex justify-center">
      <v-container fluid>
        <v-row>
          <slot />
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>
