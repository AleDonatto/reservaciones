<template>
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Agregar Unidades de Negocio
            </h6>
        </div>
        <div class="card-body">
            <ValidationObserver v-slot="{handleSubmit, reset }" ref="form">
                <form method="post" @submit.prevent="handleSubmit(bussinesUnit)" @reset.prevent="reset">
                    <v-container>
                        <v-row>
                            <v-col cols="12" md="6">
                                <ValidationProvider name="company" rules="required">
                                    <select name="company" id="company" v-model="companies.company" class="form-control">
                                        <option value="">Seleccione Compañia</option>
                                        <option :value="item.idCompanies" v-for="(item, index) in listSocios" :key="index">{{item.name}}</option>
                                    </select>
                                </ValidationProvider>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="6">
                                <ValidationProvider name="RFC" rules="required|rfc|max:15" v-slot="{errors}" required>
                                    <v-text-field outlined v-model="companies.RFC" label="RFC" :error-messages="errors" required :counter="15"></v-text-field>
                                </ValidationProvider>
                            </v-col>
                            <v-col cols="12" md="6">
                                <ValidationProvider name="nombreUnit" rules="required|max:50" v-slot="{errors}" required>
                                    <v-text-field outlined v-model="companies.nameUnit" label="Nombre Unidad" :error-messages="errors" :counter="50" required></v-text-field>
                                </ValidationProvider>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="6">
                                <ValidationProvider name="telefono1" rules="required|max:10" v-slot="{errors}">
                                    <v-text-field outlined v-model="companies.telefono1" label="Telefono 1" :error-messages="errors" :counter="10" required></v-text-field>
                                </ValidationProvider>
                            </v-col>
                            <v-col cols="12" md="6">
                                <ValidationProvider name="telefono2" rules="max:10" v-slot="{errors}">
                                    <v-text-field outlined v-model="companies.telefono2" label="Telefono 2" :error-messages="errors" :counter="10"></v-text-field>
                                </ValidationProvider>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="6">
                                <ValidationProvider name="correo" rules="required|email|max:50" v-slot="{errors}">
                                    <v-text-field outlined v-model="companies.correo" label="E-Mail" :error-messages="errors" :counter="50" required></v-text-field>
                                </ValidationProvider>
                            </v-col>
                            <v-col cols="12" md="6">
                                <ValidationProvider name="sitioweb" rules="max:50" v-slot="{errors}">
                                    <v-text-field outlined v-model="companies.sitioweb" label="Sitio Web" :error-messages="errors" :counter="50"></v-text-field>
                                </ValidationProvider>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="6">
                                <ValidationProvider name="namecontact" rules="required|max:50" v-slot="{errors}">
                                    <v-text-field outlined v-model="companies.namecontact" label="Nombre de Contacto" :error-messages="errors" :counter="50" required></v-text-field>
                                </ValidationProvider>
                            </v-col>
                            <v-col cols="12" md="6">
                                <ValidationProvider name="horacancelation" rules="required" v-slot="{errors}">
                                    <v-text-field outlined v-model="companies.sitioweb" label="Timpo de Cancelacion" :error-messages="errors" type="number" min="0" max="10" step="1"></v-text-field>
                                </ValidationProvider>
                            </v-col>
                        </v-row>
                        <button type="submit" class="btn btn-primary text-white">
                            <i class="fas fa-store-alt"></i>
                            Agregar Unidad
                        </button>
                        <button type="reset" class="btn btn-light">Restablecer</button>
                    </v-container>
                </form>
            </ValidationObserver>
        </div>
    </div>
</template>

<script>
import { required, email, max } from 'vee-validate/dist/rules'
import { extend, setInteractionMode } from 'vee-validate'

extend('email',email);

extend('rfc',rfc =>{
  var patt = new RegExp("^[A-Z,Ñ,&]{3,4}[0-9]{2}[0-1][0-9][0-3][0-9][A-Z,0-9]?[A-Z,0-9]?[0-9,A-Z]?$");
  return patt.test(rfc)
})

extend('required', {
  ...required,
  message: 'Este Campo es Requerido'
});

export default {
    data(){
        return{
            listSocios: [],
            companies:{company:"", RFC:"", nameUnit:"", telefono1:"", telefono2:"", correo:"", sitioweb:"", namecontact:"", horacancelation:"" },
            RFCValido: false,
            Hora: false
        };
    },
    created(){
        axios.get('/socios').then(res=>{
            this.listSocios = res.data;
            //console.log(this.listSocios);
        });
    },
    methods:{
        bussinesUnit(){

            axios.post("/negocios",this.companies)
            .then(res => {
                const server = res.data;
                //console.log(server)

                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true;
                toastr.options.progressBar = true;
                toastr.success(server.messageDB,server.messageHeader,{timeOut :  15000});
            })
            .catch( err => {
                const error = err.respose

                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true;
                toastr.options.progressBar = true;
                toastr.success(error,'Ocurrio un Problema',{timeOut :  15000}); 
            })

            this.$refs.form.validate().then(success => {
                if (!success) {
                    return;
                }
                // Resetting Values
                this.companies.RFC = this.companies.company = this.companies.nameUnit = this.companies.telefono1 = this.companies.telefono2 = this.companies.correo = this.companies.sitioweb = '';
                this.companies.namecontact = this.companies.horacancelation = '';
                
                // Wait until the models are updated in the UI
                this.$nextTick(() => {
                    this.$refs.form.reset();
                });
            });
        },
        VerificacionRFC(){
            var input = this.companies.RFC

            if(input !== ''){
                var patt = new RegExp("^[A-Z,Ñ,&]{3,4}[0-9]{2}[0-1][0-9][0-3][0-9][A-Z,0-9]?[A-Z,0-9]?[0-9,A-Z]?$");
                this.rfcValido = patt.test(input)

                if(patt.test(input)){
                    this.RFCValido = false
                }else{
                    this.RFCValido = true
                }
            }
        },
        HoraVerificacion(){
            var hora = this.companies.horacancelation
            console.log(hora.length)

            if(hora !== ''){
                var patt = new RegExp("^([01]?[0-9]|2[0-3]):[0-5][0-9]?$");
                //$("html, body").stop().animate({scrollTop:$( '#form' ).offset().top - 30}, 500, 'swing');
                this.Hora = patt.test(hora)

                if(patt.test(hora)){
                    this.Hora = false
                }else{
                    this.Hora = true
                }
            }
        }

    }

}
</script>

<style>
</style>