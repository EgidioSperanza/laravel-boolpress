<template>
<div class="error404">
  <h1>ERROR 404 |  NOT FOUND</h1>
  <router-link class="btn btn-primary mb-2 text-light" to="/">Torna alla Home</router-link>
</div>
</template>

<script>
export default {
}
</script>

<style>
h1{
  text-align: center;
}
.error404{
  position:absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 36px;
  text-align: center;
}
</style>