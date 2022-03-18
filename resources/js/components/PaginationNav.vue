 <template>
 <nav class="my-2 d-flex justify-content-end">
        <ul class="pagination">
          <li :class="pagination.current_page===1 ? 'page-item disabled' : 'page-item'">
            <a  class="page-link"
              @click="$emit('fetchPosts', (pagination.current_page - 1))"
              >Previous</a
            >
          </li>
          <li :class="pagination.current_page===page ? 'page-item active' : 'page-item'" v-for="page in pagination.last_page" :key="page">
            <a class="page-link"
            @click="$emit('fetchPosts', page)"
            >{{page}}</a>
          </li>
          <li :class="pagination.current_page=== pagination.last_page ? 'page-item disabled' : 'page-item'">
            <a
              class="page-link"
              @click="$emit('fetchPosts', (pagination.current_page + 1))"
              >Next</a
            >
          </li>
        </ul>
      </nav>
 </template>
 <script>
export default {
  
  props: {
    pagination: Object,
  },
}
</script>
<style lang="scss" scoped>
</style>
