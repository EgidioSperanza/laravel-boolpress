<template>
  <nav class="navbar navbar-expand-md navbar-dark bg-secondary shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="/">Laravel Boolpress</a>

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-bs-controls="navbarSupportedContent"
        aria-bs-expanded="false"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav ms-auto"></ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item" v-for="route in routes" :key="route.path">
            <router-link class="nav-link text-light" :to="!route.path ? '/' : route.path">{{route.meta.linkText}}</router-link>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="/login" v-if="!user"> Login </a>
            <a class="nav-link text-light" href="/admin" v-else> {{ user.name}} </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      routes:[],
      user:null,
    };
  },
  methods: {
    async fetchUser() {
        try {
        const resp = await axios.get('/api/user/')
        this.user = resp.data
      } catch (er) {
        console.log("Utente non Loggato")
      }

    }
  },
  mounted() {
    this.routes=this.$router.getRoutes().filter((route) => !!route.meta.linkText);
    this.fetchUser();
  },
}
</script>

<style></style>