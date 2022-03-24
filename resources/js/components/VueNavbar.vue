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
          <li v-if="user" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ user.name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a role="button" class="nav-link text-light text-dark" @click="userLogout"> Logout </a>
              </li>
            </ul>
          </li>
          <li v-else class="nav-item">
            <a class="nav-link text-light" href="/login"> Login </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import axios from "axios";

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

        localStorage.setItem("user", JSON.stringify(resp.data));

        window.dispatchEvent(new CustomEvent("storedUserChanged"));
      } catch (er) {
        // console.log("Utente non Loggato")
        localStorage.removeItem("user");

        window.dispatchEvent(new CustomEvent("storedUserChanged"));
      }
    },
    async userLogout() {
      try{
        const resp = await axios.post("api/logout");
        this.user=null;
    }catch (er) {
        console.log(er);
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