<template>
  <div class="container-fluid">
  </div>
</template>

<script>
import Vue from 'vue';
import VeeValidate from 'vee-validate';

Vue.use(VeeValidate);

export default {
  data() {
    return {
      listsocios: [],
      socios: { RFC: "", nombre: "", razonsocial: "", telefono1: "", telefono2: "", correo: "", website: "", nameContact: ""},
      //errors: [],
    };
  },
  created() {
    axios.get("socios").then(res => {
      this.listsocios = res.data;
    });
  },
  methods: {
    newSocio() {
      const newSocio = this.socios;
      this.socios = { RFC: "", nombre: "", razonsocial: "" };
      axios.post("/socios", newSocio)
      .then(res => {
        const serverSocios = res.data;
        this.listsocios.push(serverSocios);
      })
      .catch(err => {
      });
    }
  }
};
</script>