<script setup lang="ts">
import NewAuthLayout from '@/Layouts/NewAuthLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { useLayoutStore } from '@/Stores/layout'
import TagSelect from '@/Components/TagSelect.vue'
import PaginationLinks from '@/Components/PaginationLinks.vue'

const layoutStore = useLayoutStore()

const form = useForm({
    id: '',
    title: '',
    excerpt: '',
    body: '',
    tags: [],
});

const submit = (closeAfterUpdate: Boolean) => {
    form.put(route('dashboard.article.update', {
        article: layoutStore.currentPost.id
    }), {
            onSuccess: () => {
                router.reload({only: ['posts']})
                if (closeAfterUpdate === true) {
                    closeEdit()
                }
            }
        })
}

const onPublishChange = (post) => {
    router.put(route('dashboard.article.update', {
        article: post.id
    }), {
            is_live: post.is_live,
        },
        {
            onSuccess: () => {
                router.reload({only: ['posts']})
            }
        })
}

defineProps({ posts: Object, tags: Object })

async function editPost(id: number) {
    let post = await layoutStore.loadPost(id, 'articles')
    form.title = post.title
    form.excerpt = post.excerpt
    form.body = post.body
    form.tags = post.tags

    layoutStore.currentPost = post
    layoutStore.toggleRight()
}
function closeEdit() {
    layoutStore.currentPost = false
    layoutStore.toggleRight()
}

</script>

<template>
    <NewAuthLayout>
        <template v-slot:drawer>
            <v-form>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-text-field
                                v-model="form.title"
                                label="Title"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12">
                            <v-textarea label="Excerpt" v-model="form.excerpt"></v-textarea>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12">
                            <v-textarea label="Body" v-model="form.body"></v-textarea>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12">
                            <tag-select
                                v-model="form.tags"
                                :tags="tags"
                            ></tag-select>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12">
                            <v-btn @click.prevent="submit" type="submit">Save</v-btn>
                            <v-btn @click.prevent="submit(true)" type="submit">Save and Close</v-btn>
                            <v-btn @click.prevent="closeEdit">Cancel</v-btn>
                        </v-col>
                    </v-row>
                </v-container>
            </v-form>
        </template>

        <v-container fluid>
            <v-row>
                <v-col>
                    <Link :href="route('dashboard.article.create')">Add Article</Link>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12">
                    <v-table>
                        <thead>
                            <th class="text-left">
                                Title
                            </th>
                            <th class="text-left">
                                Actions
                            </th>
                        </thead>
                        <tbody>
                            <tr
                                v-for="post in posts.data"
                                :key="post.id"
                            >
                                <td class="w-75">{{ post.title }}</td>
                                <td class="flex">
                                    <v-switch v-model="post.is_live" @change="onPublishChange(post)" label="published"></v-switch>
                                    <v-btn @click="editPost(post.id)">Edit</v-btn>
                                </td>
                            </tr>
                        </tbody>
                    </v-table>
                    <PaginationLinks :links="posts.links" />
                </v-col>
            </v-row>
        </v-container>
    </NewAuthLayout>
</template>
