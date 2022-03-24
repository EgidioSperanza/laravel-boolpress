<template>
  <div class="container">
    <div class="row justify-content-center">
      <!-- <div v-if="failedSubmit" class="alert alert-danger py-5">
        <div v-if="user">
          <h4>Invio Fallito</h4>
          <p class="lead">
            La sua richiesta ha avuto esito negativo. Riprovare!
          </p>
        </div>
        <div v-else>
          <h4>Invio Fallito</h4>
          <p class="lead">
            Per Modificare un post devi essere loggato!
          </p>
        </div>
      </div> -->
      <div class="col-md-8">
        <div class="card border p-5 bg-dark text-light">
          <div class="card-header d-flex">
            <h1>Modifica il tuo Post</h1>
          </div>

          <div class="card-body">
            <form @submit.prevent="updatePost">
              <div class="mb-3">
                <label>Titolo</label>
                <input
                  type="text"
                  name="title"
                  class="form-control"
                  placeholder="Inserisci il titolo"
                  v-model="post.title"
                />
              </div>
              <!-- <div class="text-danger" v-if="validationErrors && validationErrors.title">
                <span v-for="(errorTitle, index) in validationErrors.title" :key="index">{{errorTitle}} </span>
              </div> -->
              <div class="mb-3">
                <label for="url" class="form-label">
                  Immagine del Post
                </label>
                <div v-if="post.url" class="d-flex justify-content-center align-items-center mb-2">
                  <img class="img-fluid img-thumbnail post-img me-2" :src="post.url" :alt="`Images for{{post.title}}post`">
                  <p>Anteprima Immagine Presente</p>
                </div>
                <input
                  type="file"
                  class="form-control"
                  name="url"
                  id="url"
                   aria-describedby="helpId"
                  @change="onAttachmentChange"
                />
              </div>
              <!-- <div class="text-danger" v-if="validationErrors && validationErrors.url">
                <span v-for="(errorUrl, index) in validationErrors.url" :key="index">{{errorUrl}} </span>
              </div> -->
              <div class="mb-3">
                <label for="category_id" class="form-label">Categoria</label>
                <select name="category_id" class="form-select"  v-model="post.category_id">
                  <option v-for="category in categories" :key="category.id" :value="category.id">
                    {{ category.name }}
                  </option>
                </select>
              </div>
              <div class="mb-3">
                <p>Tags</p>
                <div v-for="tag in tagsList" :key="tag.id" class="form-check form-check-inline">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    :value="tag.id"
                    :id="`tag_{{tag.id}}`"
                    name="tags"
                    v-model="post.tags"
                  />
                  <label
                    class="form-check-label text-light"
                    :for="`tag_{{tag.id}}`"
                  >
                    {{ tag.name }}
                  </label>
                </div>
              </div>
                <p>Tag Precedenti: <span class="btn bg-primary me-1" v-for="tag in post.tags" :key="tag.id">{{tag.name}}</span></p>
                <p>Ricorda di selezionarli nuovamente se non vuoi escluderli</p>
              <div class="mb-3">
                <label>Contenuto</label>
                <textarea
                  name="content"
                  rows="10"
                  class="form-control"
                  placeholder="Inizia a scrivere qualcosa..."
                  v-model="post.content"
                  >
                </textarea>
              </div>
              <!-- <div class="text-danger" v-if="validationErrors && validationErrors.content">
                <span v-for="(errorContent, index) in validationErrors.content" :key="index">{{errorContent}} </span>
              </div> -->

              <div class="card-footer form-group">
                <router-link
                  to="/"
                  class="btn btn-secondary"
                >
                  Annulla
                </router-link>
                <button type="reset" class="btn btn-secondary">Cancella</button>
                <button type="submit" class="btn btn-success">
                  Salva post
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div v-if="!user" class="alert alert-danger py-5">
      <h4>Effettua il Login</h4>
      <p class="lead">
        Devi essere Registrato per Modificare un post
      </p>
        <router-link class="btn btn-primary mb-2 text-light" to="/">Torna alla Home</router-link>
        <a class="btn btn-success mb-2 text-light" href="/login">Login</a>
    </div>
    <!-- <div v-if="postSubmitted" class="alert alert-success py-5">
      <h4>Grazie per averci contattato.</h4>
      <p class="lead">
        Il tuo Post è stato inviato correttamente
      </p>
        <router-link class="btn btn-primary mb-2 text-light" to="/">Torna alla Home</router-link>
    </div> -->
  </div>
</template>

<script>
import axios from "axios";

export default {
    props:{
    },
  data() {
    return {
      post: {},
      categories:{},
      tagsList:{},
      user:null,
    }
  },
  methods: {
    async fetchPost() {
      try {
        const resp = await axios.get('/api/post/' + this.$route.params.post+'/edit')
        this.post = resp.data.post;
        this.tagChecked = resp.data.post.tags
        this.categories = resp.data.categories;
        this.tagsList = resp.data.tags;
      } catch (er) {
        // this.$router.replace({ name: 'error'})
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
    onAttachmentChange(event) {
      this.post.url = event.target.files[0];
    },
    async updatePost() {
      try {
      const resp = await axios.put('/api/post/' + this.$route.params.post+'/update');
      dd(resp);
    }catch(er){
      console.log(er);
    }
  }
},
    mounted() {
      this.fetchPost();
      this.getStoredUser();
      window.addEventListener("storedUserChanged", () => {
      this.getStoredUser();
    })
  }
}
</script>

<style></style>
