<template>
  <div>
    <h1>{{ post.title }}</h1>
    <h3>Autore: {{ post.user.name }}</h3>
    <div class="d-flex ms-2">
      <img v-if="post.url" :src="post.url" alt="post.title" />
      <div class="ms-2">
        <div v-html="post.content">
        </div>
            <div class="mt-4" v-if="post.category_id !== 1">
              Categoria:
              <span class="bg-light text-dark p-1 rounded">
                {{ post.category.name }}
              </span>
            </div>
            <div class="mt-4" v-if="post.tags.length > 0">
              Tags:
              <span
                class="bg-primary p-1 rounded me-1"
                v-for="tag of post.tags"
                :key="tag.id"
              >
                {{ tag.name }}
              </span>
            </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      post: {},
    }
  },
  methods: {
    async fetchPost() {
      try {
        const resp = await axios.get('/api/post/' + this.$route.params.post)
        this.post = resp.data
      } catch (er) {
        this.$router.replace({ name: 'error' })
      }
    },
  },
  mounted() {
    this.fetchPost()
  },
}
</script>

<style></style>
