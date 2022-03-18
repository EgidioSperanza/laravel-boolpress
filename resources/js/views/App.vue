<template>
  <div>
    <VueNavbar></VueNavbar>
    <div class="container mt-4">
        <h1>Elenco dei posts di BoolPress</h1>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <PostCard v-for="post of posts" :key="post.id" :post="post"></PostCard>
        </div>
    </div>
  </div>
</template>

<script>
import VueNavbar from "../components/VueNavbar.vue";
import PostCard from "../components/PostCard.vue";
import axios from "axios";

export default {
  components: { VueNavbar, PostCard },
  data() {
    return {
        posts: [],
        pagination: {},
    };
  },
  methods: {
    async fetchPosts(page = 1) {
      if (page < 1) {
        page = 1;
      }
      if (page > this.pagination.last_page) {
        page = this.pagination.last_page;
      }

      const resp = await axios.get("/api/posts?page=" + page);
      this.pagination = resp.data;
      this.posts = resp.data.data;
    },
  },
  mounted() {
    this.fetchPosts();
  },
};
</script>

<style></style>