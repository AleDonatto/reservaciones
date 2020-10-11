<template>
  <div class="">
    <div class="card shadow">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Agregar Nuevo Socio</h6>
      </div>
      <div class="card-body">
        <ValidationObserver v-slot="{ handleSubmit, reset }" ref="form">
          <form method="post" id="form" @submit.prevent="handleSubmit(newSocio)" @reset.prevent="reset">
            <v-container>
              <v-row>
                <v-col cols="12" md="6">
                  <ValidationProvider name="razonsocial" rules="required|max:50" v-slot="{errors}" required>
                    <v-text-field v-model="socios.razonsocial" :error-messages="errors" :counter="50" label="Razon Social" required></v-text-field>
                  </ValidationProvider>
                </v-col>
                <v-col cols="12" md="6">
                  <ValidationProvider name="RFC" rules="required|max:15|rfc" v-slot="{errors}">
                    <!--<v-text-field v-model="socios.RFC" :error-messages="errors" :counter="50" label="RFC" required
                    v-on:blur="VerificacionRFC" :class="{ 'is-invalid': errors[0], 'is-invalid': rfcValido }"></v-text-field>-->
                    <v-text-field v-model.lazy="socios.RFC" :error-messages="errors" :counter="15" label="RFC" required></v-text-field>
                  </ValidationProvider>
                </v-col>
              </v-row>
              <v-row>
                <v-col cols="12" md="6">
                  <ValidationProvider name="telefono1" rules="required|max:10" v-slot="{errors}" required>
                    <v-text-field v-model="socios.telefono1" :error-messages="errors" :counter="10" label="Telefono 1" required></v-text-field>
                  </ValidationProvider>
                </v-col>
                <v-col cols="12" md="6">
                  <ValidationProvider name="telefono2" rules="max:10" v-slot="{errors}">
                    <v-text-field v-model="socios.telefono2" :error-messages="errors" :counter="10" label="Telefono 2"></v-text-field>
                  </ValidationProvider>
                </v-col>
              </v-row>
              <v-row>
                <v-col cols="12" md="4">
                  <ValidationProvider name="correo" rules="required|email" v-slot="{errors}">
                    <v-text-field v-model="socios.correo" :error-messages="errors" :counter="50" label="E-mail" required></v-text-field>
                  </ValidationProvider>
                </v-col>
                <v-col cols="12" md="4">
                  <ValidationProvider name="website" rules="" >
                    <v-text-field v-model="socios.website" label="Web Site" :counter="50" ></v-text-field>
                  </ValidationProvider>
                </v-col>
                <v-col cols="12" md="4">
                  <ValidationProvider name="nameContact" rules="required" v-slot="{errors}">
                    <v-text-field v-model="socios.nameContact" :error-messages="errors" :counter="50" label="Nombre del Contacto" required></v-text-field>
                  </ValidationProvider>
                </v-col>
              </v-row>
              <v-btn class="mr-4" type="submit">Agregar Nuevo Socio</v-btn>
              <v-btn type="reset">Restablecer</v-btn>
            </v-container>
          </form>
        </ValidationObserver>
      </div>
    </div>
  </div>
</template>

<script>
import { required, email, max } from 'vee-validate/dist/rules'
import { extend, setInteractionMode } from 'vee-validate'

setInteractionMode('eager')
extend('required', {
  ...required,
  message: '{_field_} can not be empty',
})
extend('rfc',rfc =>{
  var patt = new RegExp("^[A-Z,Ñ,&]{3,4}[0-9]{2}[0-1][0-9][0-3][0-9][A-Z,0-9]?[A-Z,0-9]?[0-9,A-Z]?$");
  return patt.test(rfc)
})
extend('max', {
  ...max,
  message: '{_field_} may not be greater than {length} characters',
})
extend('email', {
  ...email,
  message: 'Email must be valid',
})

export default {
  data() {
    return {
      listsocios: [],
      socios: { RFC: "", razonsocial: "", telefono1: "", telefono2: "", correo: "", website: "", nameContact: ""},
      rfcValido: false
    };
  },
  created() {
  },
  methods: {
    newSocio() {
      const newSocio = this.socios;

      axios.post("/api/socios", this.socios)
      .then(res => {
        const serverSocios = res.data;
        
        toastr.options.closeButton = true;
        toastr.options.escapeHtml = true;
        toastr.options.progressBar = true;
        toastr.success(serverSocios.messageDB,serverSocios.messageHeader,{timeOut :  15000});
      })
      .catch( err => {
        toastr.options.closeButton = true;
        toastr.options.escapeHtml = true;
        toastr.options.progressBar = true;
        toastr.warning(err.response,'Socios',{timeOut :  15000});
        var geterror = err
        console.log(err.response)
      })

      this.$refs.form.validate().then(success => {
        if (!success) {
          return;
        }
        // Resetting Values
        this.socios.RFC = this.socios.razonsocial = this.socios.telefono1 = this.socios.telefono2 = this.socios.correo = this.socios.website = this.socios.nameContact = '';

        // Wait until the models are updated in the UI
        this.$nextTick(() => {
          this.$refs.form.reset();
        });
      });
    },
    VerificacionRFC(){
      var input = this.socios.RFC

      if(input !== ''){
        var patt = new RegExp("^[A-Z,Ñ,&]{3,4}[0-9]{2}[0-1][0-9][0-3][0-9][A-Z,0-9]?[A-Z,0-9]?[0-9,A-Z]?$");
        this.rfcValido = patt.test(input)

        if(patt.test(input)){
          this.rfcValido = false
        }else{
          this.rfcValido = true
        }
      }
      /*$('#RFC').on('blur',function(){
        var value = $("#RFC").val()

        if(value !== ''){
          var patt = new RegExp("^[A-Z,Ñ,&]{3,4}[0-9]{2}[0-1][0-9][0-3][0-9][A-Z,0-9]?[A-Z,0-9]?[0-9,A-Z]?$");
          this.rfcValido = patt.test(value)
          
          //$('#validacion').text('rfc invalido')
          //console.log(reg)
        }else{
          rfcValido = false
        }
      });*/
    },
    clear () {
      this.$refs.observer.reset()
    },
  }
};
</script>