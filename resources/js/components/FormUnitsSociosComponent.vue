<template>
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Agregar Unidades de Negocio
            </h6>
        </div>
        <div class="card-body">
            <ValidationObserver v-slot="{handleSubmit, reset }" ref="form" >
                <form method="post" id="form" @submit.prevent="handleSubmit(bussinesUnit)" @reset.prevent="reset" enctype="multipart/form-data">
                    <div class="row form-group">
                        <div class="col-md-6 col-6 col-sm-12">
                            <label for="RFC">RFC <sup class="text-danger"> <strong>*</strong> </sup> </label>
                            <ValidationProvider name="RFC" rules="required|rfc" v-slot="{ errors }">
                                <input type="text" name="RFC" id="RFC" class="form-control" placeholder="RFC" v-model="companies.RFC"
                                :class="{ 'is-invalid': errors[0]}" maxlength="20">

                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ errors[0] }}</strong>
                                </div>
                            </ValidationProvider>
                        </div>
                        <div class="col-md-6 col-6 col-sm-12">
                            <label for="nombreUNit">Nombre de la Unidad <sup class="text-danger"> <strong>*</strong> </sup></label>
                            <ValidationProvider name="nombreUnit" rules="required" v-slot="{ errors }">
                                <input type="text" name="nombreUnit" id="nombreUnit" class="form-control" placeholder="Nombre de la Unidad"
                                :class="{ 'is-invalid': errors[0] }" v-model="companies.nameUnit" maxlength="50">

                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ errors[0] }}</strong>
                                </div>
                            </ValidationProvider>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6 col-md-6 col-sm-12">
                            <label for="telefono1">Telefono 1 <sup class="text-danger"> <strong>*</strong> </sup></label>
                            <ValidationProvider name="telefono1" rules="required" v-slot="{ errors }">
                                <input type="tel" name="telefono1" id="telefono1" class="form-control" placeholder="Telefono 1" v-model="companies.telefono1"
                                :class="{ 'is-invalid': errors[0] }" maxlength="10">

                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ errors [0] }}</strong>
                                </div>
                            </ValidationProvider>
                        </div>
                        <div class="col-6 col-md-6 col-sm-12">
                            <label for="telefono2">Telefono 2</label>
                            <ValidationProvider name="telefono2" rules="" v-slot="{ errors }">
                                <input type="tel" name="telefono2" id="telefono2" class="form-control" placeholder="Telefono 2" v-model="companies.telefono2"
                                :class="{ 'is-invalid':errors[0] }" maxlength="10">

                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ errors[0] }}</strong>
                                </div>
                            </ValidationProvider>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6 col-md-6 col-sm-12">
                            <label for="correo">Correo <sup class="text-danger"> <strong>*</strong> </sup></label>
                            <ValidationProvider name="correo" rules="required" v-slot="{ errors }">
                                <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo" v-model="companies.correo"
                                :class="{ 'is-invalid':errors[0] }" maxlength="50">

                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ errors[0] }}</strong>
                                </div>
                            </ValidationProvider>
                        </div>
                        <div class="col-6 col-md-6 col-sm-12">
                            <label for="sitioweb">Sitio Web</label>
                            <ValidationProvider name="sitioweb" rules="" v-slot="{ errors }">
                                <input type="text" name="sitioweb" id="sitioweb" class="form-control" placeholder="Sitio Web" v-model="companies.sitioweb"
                                :class="{ 'is-invalid':errors[0] }" maxlength="50">

                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ errors[0] }}</strong>
                                </div>
                            </ValidationProvider>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6 col-md-6 col-sm-12">
                            <label for="namecontact">Nombre del Contacto<sup class="text-danger"> <strong>*</strong> </sup></label>
                            <ValidationProvider name="namecontact" rules="required" v-slot="{ errors }">
                                <input type="text" name="namecontact" id="namecontact" class="form-control" placeholder="Nombre del Contacto"
                                :class="{ 'is-invalid':errors[0] }" v-model="companies.namecontact" maxlength="50">

                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ errors[0] }}</strong>
                                </div>
                            </ValidationProvider>
                        </div>
                        <div class="col-6 col-md-6 col-sm-12">
                            <label for="horacancelation">Tiempo de Cancelacion <sup class="text-danger"> <strong>*</strong>(Horas)</sup></label>
                            <ValidationProvider name="horacancelation" rules="required" v-slot="{ errors }">
                                <!--<input type="time" name="horacancelation" id="horacancelation" class="form-control" placeholder="00:00:00"
                                :class="{ 'is-invalid':errors[0] }" max="22:30:00" min="10:00:00" step="1" 
                                v-model="companies.horacancelation">-->

                                <input type="number" name="horacancelation" id="horacancelation" min="0" max="24" step="1" class="form-control"
                                :class="{ 'is-invalid':errors[0] }" v-model="companies.horacancelation" placeholder="0">

                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ errors[0] }}</strong>
                                    <strong v-if="Hora">Hora Invalida</strong>
                                </div>
                            </ValidationProvider>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6 col-md-6 col-sm-12">
                            <label for="imagen">Seleccionar Imagen</label>
                            <ValidationProvider name="imagen" rules="image|ext:jpg" v-slot="{errors}">
                                <input type="file" name="imagen" id="imagen" class="form-control" @change="getImagen" accept="image/jpeg" :class="{'is-invalid':errors[0] }">

                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ errors[0] }}</strong>
                                </div>
                            </ValidationProvider>
                        </div>
                        <div class="col-6 col-md-6 col-sm-12">
                            <figure class="figure">
                                <img :src="imagenMuestra" alt="imagen de muestra" class="figure-img img-fluid rounded">
                                <figcaption class="figure-caption">Dimenciones de imagen recomendada (640X958)</figcaption>
                            </figure>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white">
                        <i class="fas fa-store-alt"></i>
                        Agregar Unidad
                    </button>
                    <button type="reset" class="btn btn-light">Restablecer</button>
                </form>
            </ValidationObserver>
        </div>
    </div>
  
</template>

<script>
import { required, email, max, image, ext } from 'vee-validate/dist/rules'
import { extend, setInteractionMode } from 'vee-validate'

extend('email',email);

extend('image', {
    ...image,
    message: 'El archivo que selecciono no es una Imagen'
} );

extend('ext', ext);

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
            companies:{RFC:"", nameUnit:"", telefono1:"", telefono2:"", correo:"", sitioweb:"", namecontact:"", horacancelation:"", imagen:null },
            RFCValido: false,
            Hora: false,
            imagenMuestra: ''
        };
    },
    created(){
    },
    computed:{
        /*imagen(){
            return this.imagenMuestra
        }*/
    },
    methods:{
        bussinesUnit(){

            const formData = new FormData();
            formData.append('RFC', this.companies.RFC)
            formData.append('nameUnit', this.companies.nameUnit)
            formData.append('telefono1', this.companies.telefono1)
            formData.append('telefono2', this.companies.telefono2)
            formData.append('correo', this.companies.correo)
            formData.append('sitioweb', this.companies.sitioweb)
            formData.append('namecontact', this.companies.namecontact)
            formData.append('horacancelation', this.companies.horacancelation)
            formData.append('imagen', this.companies.imagen)

            axios.post("/socios_negocios",formData)
            .then(res => {
                const server = res.data;

                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true; 
                toastr.options.progressBar = true;
                toastr.success(server.messageDB,server.messageHeader,{timeOut :  15000});
            })
            .catch( err => { 
                console.log(err.response)
                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true;
                toastr.options.progressBar = true;
                toastr.success(err.response,'Ocurrio un problema',{timeOut :  15000});
            })

            this.$refs.form.validate().then(success => {
                if (!success) {
                    return;
                }
                // Resetting Values
                this.companies.RFC = this.companies.company = this.companies.nameUnit = this.companies.telefono1 = this.companies.telefono2 = this.companies.correo = this.companies.sitioweb = '';
                this.companies.namecontact = this.companies.horacancelation = "";
                this.companies.imagen = "";
                this.imagenMuestra = '';
                
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
        },
        getImagen(e){
            const img = e.target.files[0]
            this.companies.imagen = img

            let reader  = new FileReader();

            reader.addEventListener("load", function () {
                this.imagenMuestra = reader.result;
            }.bind(this), false);

            if( this.companies.imagen ){
                if ( /\.(jpe?g|png|gif)$/i.test( this.companies.imagen.name ) ) {
                    reader.readAsDataURL( this.companies.imagen );
                }
            }
        },
        cargarImagen(img){
            const reader = new FileReader()

            reader.onload = (e) => {
                this.imagenMuestra = e.target.result
            }

            reader.readAsDataURL(img)
        }

    }

}
</script>

<style scoped>
.col-md-6 > .figure > img{
    width: 320px;
    height: 480px;
}
</style>