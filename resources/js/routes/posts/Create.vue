<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card border p-5 bg-dark text-light" v-if="!postSubmitted">
          <div class="card-header d-flex">
            Crea un nuovo post
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
                  required
                />
              </div>
              <div class="mb-3">
                <label for="url" class="form-label">Image Url</label>
                <input
                  type="text"
                  class="form-control"
                  name="url"
                  id="url"
                  aria-describedby="helpId"
                  placeholder="Image Url"
                  v-model="newPost.url"
                />
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
                  required
                  ></textarea
                >
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
        <div v-else class="alert alert-success py-5">
          <h4>Grazie per averci contattato.</h4>
          <p class="lead">
            Il tuo Post è stato inviato correttamente
          </p>
            <router-link class="btn btn-primary mb-2 text-light" to="/">Torna alla Home</router-link>
        </div>
      </div>
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
      postSubmitted:false,
      user: null,
      categories:{},
      tagsList:{},
        newPost : {
            user_id: "",
            title: "",
            content: "",
            url: "",
            category_id: 1,
            tags: [],
        }
    }
  },
  methods: {
    createPost() {
      try{
        axios.post('/api/posts', this.newPost);

        this.postSubmitted=true;
      }
      catch(er){
        console.log(er)
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
