<template>
  <div class="col">
    <div class="card bg-dark border-light h-100">
        <div class="card-header text-end"> X</div>
      <img
        :src="getPostUrl(post)"
        class="card-img-top"
        :alt="`Image for {{post.title}} post`"
      />
      <div class="card-body">
        <h3 class="card-title">Titolo: {{ post.title }}</h3>
        <h4 class="card-title">Autore: {{ post.user.name }}</h4>
        <p class="card-text">{{ post.content }}</p>
      </div>
      <div class="card-footer">
        <div class="small text-end">
            <span class="d-block">Pubblicato {{getCreation(post)}}</span>
            <span v-if="isUpdated(post)">Modificato {{getUpdate(post)}}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from 'moment';
export default {
  props: {
    post: Object,
  },
  methods: {
    getPostUrl(post) {
      return post.url !== null ? post.url : 'https://picsum.photos/400/200'
    },
    getCreation(post) {
        moment.locale('it');
        // moment(post.created_at).fromNow()
        if(moment().diff(post.created_at, 'hours')>=12){
            return "il " + moment(post.created_at).format('DD/MM/YYYY [alle] HH:mm');
        }else{
            return moment(post.created_at).fromNow()
        }
    },
    isUpdated(post){
        if(moment(post.updated_at) > moment(post.created_at)) {
            return true
        }
    },
    getUpdate(post){
        return moment(post.updated_at).fromNow()
    }
  },
}
</script>
<style lang="scss" scoped>
img {
  width: 100%;
  height: 200px;
  object-fit: contain;
}
</style>
