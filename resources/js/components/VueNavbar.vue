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
            <a class="nav-link text-light" href="/login" v-else> {{user.name}} </a>
          </li>
          <li class="nav-item" v-if="user">
            <a class="nav-link text-light" @click="userLogout"> Logout </a>
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
        console.log("Utente non Loggato")
        localStorage.removeItem("user");

        window.dispatchEvent(new CustomEvent("storedUserChanged"));
      }
    },
    userLogout() {
      try{
      axios.post("logout").then(response => { 
        window.location.replace("/logout");
        })
    }catch (er) {
        console.log(er);
        } finally {
            setTimeout(() => {
              window.location.replace("/");
        }, 1000);
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