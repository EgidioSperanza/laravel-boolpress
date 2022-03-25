<template>
  <div>
    <h1>Contatti</h1>
    <div v-if="failedSubmit" class="alert alert-danger py-5">
      <h4>Invio Fallito</h4>
      <p class="lead">
        La sua richiesta ha avuto esito negativo. Riprovare!
      </p>
    </div>
    <div v-if="!messageSubmitted">
      <div class="mb-3">
        <label for="name" class="form-label">Nome e Cognome</label>
        <input type="text" class="form-control" id="name" placeholder="Inserisci il nome completo" v-model="contact.name">
        <div class="text-danger" v-if="validationErrors && validationErrors.name">
          <span v-for="(errorName, index) in validationErrors.name" :key="index">{{errorName}} </span>
        </div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" placeholder="name@example.com" v-model="contact.email">
        <div class="text-danger" v-if="validationErrors && validationErrors.email">
          <span v-for="(errorEmail, index) in validationErrors.email" :key="index">{{errorEmail}} </span>
        </div>
      </div>
      <div class="mb-3">
        <label for="message" class="form-label">Messaggio</label>
        <textarea class="form-control" id="message" rows="3" v-model="contact.message"></textarea>
        <div class="text-danger" v-if="validationErrors && validationErrors.message">
          <span v-for="(errorMessage, index) in validationErrors.message" :key="index">{{errorMessage}} </span>
        </div>
      </div>
      <button type="submit" class="btn btn-success" @click="contactSubmit">Invia!</button>
    </div>
    <div v-else class="alert alert-success py-5">
      <h4>Grazie per averci contattato.</h4>
      <p class="lead">
        La sua richiesta è stata inviata correttamente e risponderemo il prima
        possibile.
      </p>
    </div>

  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      messageSubmitted: false,
      contact:{
        name: "",
        email: "",
        message: "",
      },
      validationErrors: null,
      failedSubmit:false,
    };
  },
  methods: {
    async contactSubmit(){
      try{
        this.failedSubmit=false;
        this.validationErrors=null;
        const resp = await axios.post('/api/contacts', this.contact)

        this.messageSubmitted=true;
      }catch(er){
        // 422 = errore di validazione
        if (er.response.status === 422) {
          this.validationErrors = er.response.data.errors;
        }

          this.failedSubmit=true;
      }
    }
  },
}

</script>

<style></style>