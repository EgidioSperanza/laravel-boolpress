<template>
    <div>
        <h1>Elenco dei posts di BoolPress</h1>
        <PaginationNav :pagination="pagination" @fetchPosts="fetchPosts"></PaginationNav>
        <button v-if="loading" class="btn btn-primary mb-2 text-light" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Loading...
        </button>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <PostCard v-for="post of posts" :key="post.id" :post="post"></PostCard>
        </div>
        <PaginationNav :pagination="pagination" @fetchPosts="fetchPosts"></PaginationNav>
    </div>
</template>

<script>
import PostCard from "../components/PostCard.vue";
import PaginationNav from "../components/PaginationNav.vue";

import axios from "axios";

export default {
  components: { PostCard, PaginationNav },
  data() {
    return {
        posts: [],
        pagination: {},
        loading:true,
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

    this.loading = true;

    try{
        const resp = await axios.get("/api/posts?page=" + page);
        this.pagination = resp.data;
        this.posts = resp.data.data;
    }catch (er) {
        console.log(er);
        } finally {
            setTimeout(() => {
                this.loading = false;
        }, 1000);
        }
    },
  },
  mounted() {
    this.fetchPosts();
  },
};

</script>

<style></style>