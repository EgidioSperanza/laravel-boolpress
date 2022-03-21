<template>
    <div class="small text-end">
        <span class="d-block">Pubblicato {{getCreation(post)}}</span>
        <span v-if="isUpdated(post)">Modificato {{getUpdate(post)}}</span>
    </div>
</template>

<script>
import moment from 'moment';
export default {
  props: {
      post: Object,
  },
  data() {
    return {};
  },
  methods: {
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
</style>
