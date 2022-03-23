<template>
  <div class="container">
    <div class="row justify-content-center"  v-if="!postSubmitted">
      <div v-if="failedSubmit" class="alert alert-danger py-5">
        <div v-if="user">
          <h4>Invio Fallito</h4>
          <p class="lead">
            La sua richiesta ha avuto esito negativo. Riprovare!
          </p>
        </div>
        <div v-else>
          <h4>Invio Fallito</h4>
          <p class="lead">
            Per scrivere un post devi essere loggato!
          </p>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card border p-5 bg-dark text-light">
          <div class="card-header d-flex">
            <h1>Crea un nuovo post</h1>
          </div>

          <div class="card-body">
            <form @submit.prevent="createPost">
              <div class="mb-3">
                <label>Titolo</label>
                <input
                  type="text"
                  name="title"
                  class="form-control"
                  placeholder="Inserisci il titolo"
                  v-model="newPost.title"
                />
              </div>
              <div class="text-danger" v-if="validationErrors && validationErrors.title">
                <span v-for="(errorTitle, index) in validationErrors.title" :key="index">{{errorTitle}} </span>
              </div>
              <div class="mb-3">
                <label for="url" class="form-label">
                  Immagine del Post
                </label>
                <input
                  type="file"
                  class="form-control"
                  name="url"
                  id="url"
                   aria-describedby="helpId"
                  @change="onAttachmentChange"
                />
              </div>
              <div class="text-danger" v-if="validationErrors && validationErrors.url">
                <span v-for="(errorUrl, index) in validationErrors.url" :key="index">{{errorUrl}} </span>
              </div>
              <div class="mb-3">
                <label for="category_id" class="form-label">Categoria</label>
                <select name="category_id" class="form-select"  v-model="newPost.category_id">
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
                    name="tags[]"
                    v-model="newPost.tags"
                  />
                  <label
                    class="form-check-label text-light"
                    :for="`tag_{{tag.id}}`"
                  >
                    {{ tag.name }}
                  </label>
                </div>
              </div>
              <div class="mb-3">
                <label>Contenuto</label>
                <textarea
                  name="content"
                  rows="10"
                  class="form-control"
                  placeholder="Inizia a scrivere qualcosa..."
                  v-model="newPost.content"
                  >
                </textarea>
              </div>
              <div class="text-danger" v-if="validationErrors && validationErrors.content">
                <span v-for="(errorContent, index) in validationErrors.content" :key="index">{{errorContent}} </span>
              </div>

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
    <div v-else class="alert alert-success py-5">
      <h4>Grazie per averci contattato.</h4>
      <p class="lead">
        Il tuo Post è stato inviato correttamente
      </p>
        <router-link class="btn btn-primary mb-2 text-light" to="/">Torna alla Home</router-link>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
    props:{
        post:Object,
    },
  data() {
    return {
      user: null,
      categories:{},
      tagsList:{},
        newPost : {
            user_id: "",
            title: "",
            content: "",
            url: null,
            category_id: 1,
            tags: [],
        },
      validationErrors: null,
      failedSubmit:false,
      postSubmitted: false,
    }
  },
  methods: {
    async createPost() {
      try{
        this.postSubmitted = false,
        this.validationErrors= null;
        this.failedSubmit=false;

        const formDataInstance = new FormData();
        formDataInstance.append("user_id", this.newPost.user_id);
        formDataInstance.append("title", this.newPost.title);
        formDataInstance.append("content", this.newPost.content);
        formDataInstance.append("url", this.newPost.url);
        formDataInstance.append("category_id", this.newPost.category_id);
        formDataInstance.append("tags", this.newPost.tags);
        const resp = await axios.post('/api/posts', formDataInstance);
        this.postSubmitted=true;

      }
      catch(er){
        console.log(er)
        // 422 = errore di validazione
        if (er.response.status === 422) {
          this.validationErrors = er.response.data.errors;
        }
        console.log(er)
          this.failedSubmit=true;
      }
    },
    async fetchDetails(category = 1) {
      try{
        const resp = await axios.get("/api/create");
        this.categories = resp.data.categories;
        this.tagsList = resp.data.tags;

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
      onAttachmentChange(event) {
      this.newPost.url = event.target.files[0];
    },
  },
    mounted() {
      this.fetchDetails();
      this.getStoredUser();
      window.addEventListener("storedUserChanged", () => {
      this.getStoredUser();
    })
  }
}
</script>

<style></style>
