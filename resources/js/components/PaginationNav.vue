 <template>
 <div>

  <nav v-if="pagination.last_page>1" class="my-2 d-flex justify-content-end">
    <ul class="pagination">
      <li :class="pagination.current_page===1 ? 'page-item disabled' : 'page-item'">
        <a  class="page-link"
          @click="$emit('fetchPosts', (pagination.current_page - 1))">
          Previous
        </a>
      </li>
      <li :class="pagination.current_page===page ? 'page-item active' : 'page-item'" v-for="page in pagination.last_page" :key="page">
        <a class="page-link"
          @click="$emit('fetchPosts', page)">
          {{page}}
        </a>
      </li>
      <li :class="pagination.current_page=== pagination.last_page ? 'page-item disabled' : 'page-item'">
        <a class="page-link"
          @click="$emit('fetchPosts', (pagination.current_page + 1))">
          Next
        </a>
      </li>
    </ul>
  </nav>
  <div v-if="pagination.total===0 && emptyAlert" class="alert alert-warning py-5">
    <h4>Grazie per averci fatto visita.</h4>
    <p class="lead">
      Non ci sono Post da Visualizzare. Se sei registrato puoi essere il primo!
    </p>
    <router-link class="btn btn-primary mb-2 text-light" to="/create">Scrivi Post</router-link>
  </div>
 </div>
 </template>
 <script>
export default {
  
  props: {
    pagination: Object,
    emptyAlert: Boolean,
  },
}
</script>
<style lang="scss" scoped>
</style>
