<template>
  <div class="">
      <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Agregar Nuevo Socio</h6>
        </div>
        <div class="card-body">
            <ValidationObserver  v-slot="{ handleSubmit, reset }" ref="form">
              <form method="post" id="form" @submit.prevent="handleSubmit(newSocio)" @reset.prevent="reset">
                  <div class="row form-group">
                      <div class="col-6 col-md-6 col-sm-12">
                          <label for="razonsocial">Razon Social <sup class="text-danger"> <strong>*</strong> </sup> </label>
                          <!--<input type="text" name="razonsocial" id="razonsocial" class="form-control" 
                          placeholder="Razon Social" v-model="socios.razonsocial">-->

                          <ValidationProvider name="razonsocial" rules="required" v-slot="{ errors }">
                            <input type="text" v-model="socios.razonsocial" name="razonsocial" class="form-control" placeholder="Razon Social" 
                            :class="{ 'is-invalid': errors[0] }">

                            <div class="invalid-feedback" role="alert">
                              <strong>{{ errors[0] }}</strong>
                            </div>
                          </ValidationProvider>
      
                      </div>
                      <div class="col-6 col-md-6 col-sm-12">
                          <label for="RFC">RFC <sup class="text-danger"> <strong>*</strong> </sup> </label>
                          <!--<input type="text" name="RFC" id="RFC" class="form-control" placeholder="RFC" v-model="socios.RFC"
                          v-on:blur="VerificacionRFC" >-->

                          <ValidationProvider name="RFC" rules="required" v-slot="{ errors }">
                            <input type="text" class="form-control" name="RFC" placeholder="RFC" v-model="socios.RFC"
                            v-on:blur="VerificacionRFC" :class="{ 'is-invalid': errors[0], 'is-invalid': rfcValido }">

                            <div class="invalid-feedback" role="alert">
                              <strong>{{ errors[0] }}</strong>
                              <strong v-if="rfcValido">RFC Invalido</strong>
                              <!--<p v-if="rfcValido">RFC Invalido</p>-->
                            </div>
                          </ValidationProvider>

                          
                      </div>
                  </div>
      
                  <div class="row form-group">
                      <div class="col-6 col-md-6 col-sm-12">
                          <label for="telefono1">Telefono 1 <sup class="text-danger"> <strong>*</strong> </sup> </label>
                          <!--<input type="tel" name="telefono1" id="telefono1" class="form-control" 
                          placeholder="Telefono 1" v-model="socios.telefono1">-->

                          <ValidationProvider name="telefono1" rules="required" v-slot="{ errors }">
                            <input type="tel" v-model="socios.telefono1" name="telefono1" class="form-control" placeholder="Telefono1"
                            :class="{ 'is-invalid':errors[0] }">

                            <div class="invalid-feedback" role="alert">
                              <strong>{{ errors[0] }}</strong>
                            </div>
                          </ValidationProvider>
                      </div>
                      <div class="col-6 col-md-6 col-sm-12">
                          <label for="telefono2">Telefono 2</label>
                          <input type="tel" name="telefono2" id="telefono2" class="form-control" placeholder="Telefono 2" 
                          v-model="socios.telefono2">
                      </div>
                  </div>
      
                  <div class="row form-group">
                      <div class="col-4 col-md-4 col-sm-12">
                          <label for="email">Correo <sup class="text-danger"> <strong>*</strong> </sup> </label>
                          <!--<input type="email" name="email" id="email" class="form-control" placeholder="example@example.com"
                          v-model="socios.correo">-->
                          <ValidationProvider name="email" rules="required|email" v-slot="{ errors }">
                            <input type="email" v-model="socios.correo" name="email" class="form-control" placeholder="example@example.com" 
                            :class="{ 'is-invalid': errors[0] }">

                            <div class="invalid-feedback" role="alert">
                              <strong>{{ errors[0] }}</strong>
                            </div>
                          </ValidationProvider>
                      </div>
                      <div class="col-4 col-md-4 col-sm-12">
                          <label for="sitioweb">Sitio Web</label>
                          <input type="text" name="sitioweb" id="sitioweb" class="form-control"
                          placeholder="Sitio Web" v-model="socios.website">
                      </div>
                      <div class="col-4 col-md-4 col-sm-12">
                          <label for="nombresocio">Nombre Socio <sup class="text-danger"> <strong>*</strong> </sup> </label>
                          <!--<input type="text" name="nombresocio" id="nombresocio" class="form-control"
                          placeholder="Nombre Socio" v-model="socios.nameContact">-->

                          <ValidationProvider name="nombresocio" rules="required" v-slot="{ errors }">
                            <input type="text" id="nombresocio" name="nombresocio" v-model="socios.nameContact" class="form-control" placeholder="Nombre Socio"
                            :class="{ 'is-invalid':errors[0] }">

                            <div class="invalid-feedback" role="alert">
                              <strong>{{ errors[0] }}</strong>
                            </div>
                          </ValidationProvider>
                      </div>
                  </div>
                  <button type="submit" class="btn btn-primary">
                      <i class="fas fa-plus"></i> Agregar Nuevo Socio
                  </button>
                  <button type="reset" class="btn btn-light">Retablecer</button>
              </form>
            </ValidationObserver>
        </div>
    </div>
  </div>
</template>

<script>
import { extend } from 'vee-validate';
import { required, email } from 'vee-validate/dist/rules';

extend('email',email);

extend('required', {
  ...required,
  message: 'Este Campo es requerido'
});

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
        var geterror = err
        console.log(geterror)
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
    }
  }
};
</script>