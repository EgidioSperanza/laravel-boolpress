<template>
  <div>
    <VueNavbar></VueNavbar>
    <div class="container mt-4">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import VueNavbar from "../components/VueNavbar.vue";

export default {
  components: { VueNavbar },
  data() {
    return {
    };
  },
};
</script>

<style></style>