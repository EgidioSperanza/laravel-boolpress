<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card border p-5 bg-dark text-light">
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
              <!-- <div class="mb-3">
                <label for="category_id" class="form-label">Categoria</label>
                <select name="category_id" class="form-select">
                  <option v-for="category in categories" :key="category.id" :value="category.id">
                    {{ category.name }}
                  </option>
                </select>
              </div> -->
              <!-- <div class="mb-3">
                <p>Tags</p>
                @foreach ($tags as $tag)
                <div class="form-check form-check-inline">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    value="{{ $tag->id }}"
                    id="tag_{{ $tag->id }}"
                    name="tags[]"
                  />
                  <label
                    class="form-check-label text-light"
                    for="tag_{{ $tag->id }}"
                  >
                    {{ $tag->name }}
                  </label>
                </div>
                @endforeach @error('tags')
                <div class="text-red">{{ $message }}</div>
                @enderror
              </div> -->
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
        newPost : {
            title: "",
            content: "",
            url: "",
            category_id: 1,
        }
    }
  },
methods: {
     createPost() {
        
        axios.post('/api/posts', this.newPost);
    },
  },
}
</script>

<style></style>
