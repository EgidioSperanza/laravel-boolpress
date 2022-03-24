<template>
<span v-if="user && user.id===post.user_id">
    <button type="button" class="btn btn-danger text-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop" title="Elimina">
        Elimina
    </button>
  <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Conferma Cancellazione Dati</h5>
            <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <p>Vuoi eliminare questo contenuto? Non potrai più recuperarlo.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button> 
                <button class="btn btn-danger text-light" data-bs-dismiss="modal" type="submit" @click="deletePost(post.id)">Elimina Record</button>
            </div>
        </div>
        </div>
    </div>
</span>
</template>
<script>
import axios from 'axios';

  export default {
  props: {
    post: Object,
  },
  data() {
      return {
        user: null,
      }
  },
    methods: {
    async deletePost(postID){
      try{
          
        const resp = await axios.delete("api/delete/"+postID);
            // window.location.reload();
      }catch (er) {
        console.log(er);
      } 
    },
    getStoredUser() {
      const storedUser = localStorage.getItem("user");
      if (storedUser) {
        this.user = JSON.parse(storedUser);
      } else {
        this.user = null;
      }
    },
  },
  mounted() {
    this.getStoredUser();
    window.addEventListener("storedUserChanged", () => {
    this.getStoredUser();
    })
  },

}
</script>
<style lang="scss" scoped>
</style>
