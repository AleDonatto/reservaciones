<template>
  <div class="">
    <ValidationObserver v-slot="{handleSubmit}" ref="form">
        <form action="" id="form" method="post" @submit.prevent="handleSubmit(updateBusinessUnits)" enctype="multipart/form-data">
            <div class="row form-group">
                <div class="col-6 col-md-6 col-sm-12">
                    <label for="rfc">RFC</label>
                    <ValidationProvider name="rfc" rules="required|rfc" v-slot="{errors}">
                        <input type="text" name="rfc" id="rfc" class="form-control" v-model="companies.RFC" 
                        :class="{ 'is-invalid':errors[0] }" maxlength="20">
                        <input type="hidden" name="idunidad" >
                        <input type="hidden" name="compania" >
                        
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ errors[0] }}</strong>
                        </span>
                    </ValidationProvider>
                </div>
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="unidad">Nombre Unidad</label>
                        <ValidationProvider name="nameunidad" rules="required" v-slot="{errors}">
                            <input type="text" name="nameunidad" id="nameunidad" class="form-control" v-model="companies.nameUnit"
                            :class="{ 'is-invalid':errors[0] }" maxlength="50">

                            <span class="invalid-feedback" role="alert">
                                <strong>{{ errors[0] }}</strong>
                            </span>
                        </ValidationProvider>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="telefono1">Telefono 1</label>
                        <ValidationProvider name="telefono1" rules="required" v-slot="{errors}">
                            <input type="text" name="telefono1" id="telefono1" class="form-control" v-model="companies.telefono1"
                            :class="{ 'is-invalid':errors[0] }" maxlength="10">

                            <span class="invalid-feedback" role="alert">
                                <strong>{{ errors[0] }}</strong>
                            </span>
                        </ValidationProvider>
                    </div>
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="telefono2">Telefono 2</label>
                        <ValidationProvider name="telefono2" rules="required" v-slot="{errors}">
                            <input type="text" name="telefono2" id="telefono2" class="form-control" v-model="companies.telefono2"
                            :class="{'is-invalid': errors[0] }" maxlength="10">

                            <span class="invalid-feedback" role="alert">
                                <strong>{{ errors[0] }}</strong>
                            </span>
                        </ValidationProvider>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="correo">Correo</label>
                        <ValidationProvider name="correo" rules="required" v-slot="{errors}">
                            <input type="email" name="email" id="email" class="form-control" v-model="companies.correo" 
                            :class="{'is-invalid': errors[0]}" maxlength="50">

                            <span class="invalid-feedback" role="alert">
                                <strong>{{ errors[0] }}</strong>
                            </span>
                        </ValidationProvider>
                    </div>
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="sitioweb">Sitio Web</label>
                        <ValidationProvider name="sitioweb" rules="required" v-slot="{errors}">
                            <input type="text" name="sitioweb" id="sitioweb" class="form-control" v-model="companies.sitioweb" 
                            :class="{ 'is-invalid':errors[0] }" maxlength="50">

                            <span class="invalid-feedback" role="alert">
                                <strong>{{ errors[0] }}</strong>
                            </span>
                        </ValidationProvider>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="namecontact">Nombre del Contacto</label>
                        <ValidationProvider name="nameContact" rules="required" v-slot="{errors}">
                            <input type="text" name="nameContact" id="nameContact" class="form-control" v-model="companies.namecontact"
                            :class="{'is-invalid':errors[0]}" maxlength="50">

                            <span class="invalid-feedback" role="alert">
                                <strong>{{ errors[0] }}</strong>
                            </span>
                        </ValidationProvider>
                    </div>
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="tiempoCancelacion">Tiempo de Cancelacion</label>
                        <ValidationProvider name="hora" rules="required" v-slot="errors">
                            <input type="number" name="hora" id="hora" min="0" max="24" step="1" class="form-control" v-model="companies.horacancelation" 
                            :class="{'is-invalid':errors[0]}">

                            <span class="invalid-feedback" role="alert">
                                <strong>{{ errors[0] }}</strong>
                            </span>
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
                        <div class="" v-if="imagenActual">
                            <figure class="figure">
                                <p v-if="companies.imagen == ''" class="figure-caption">No se a agregado una imagen</p>
                                <img v-else :src="urlimagen" alt="imagen de muestra" class="figure-img img-fluid rounded">
                                <figcaption class="figure-caption">Dimenciones de imagen recomendada (640X958)</figcaption>
                            </figure>
                        </div>
                        <div class="" v-else>
                            <figure class="figure">
                                <img :src="imagenMuestra" alt="imagen de muestra" class="figure-img img-fluid rounded">
                                <figcaption class="figure-caption">Dimenciones de imagen recomendada (640X958)</figcaption>
                            </figure>
                        </div>
                        
                    </div>
                </div>
                <button type="submit" class="btn btn-primary text-white">Guardar Datos</button>
                <button type="reset" class="btn btn-light">Restablecer</button>
            </form>
        </ValidationObserver>
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
    props:{
        'unidades': {},
        'urlimagen': {}
    },
    data(){
        return {
            companies: {idUnit:0, idCompany: 0, RFC:"", nameUnit:"", telefono1:"", telefono2:"", correo:"", sitioweb:"", namecontact:"", horacancelation:"", imagen:"", imagenAnterior:"" },
            imagenMuestra: "",
            imagenActual: true
        }
    },
    created(){
        const {RFC, idUnits, idcompany, nameUnit, nameContact, phone1, phone2, webSite, imagen, address, cancelation_time_limit} = this.unidades
        this.companies.RFC = RFC
        this.companies.idUnit = idUnits
        this.companies.idCompany = idcompany
        this.companies.nameUnit = nameUnit
        this.companies.telefono1 = phone1
        this.companies.telefono2 = phone2
        this.companies.correo = address 
        this.companies.sitioweb = webSite 
        this.companies.namecontact = nameContact
        this.companies.horacancelation = cancelation_time_limit 
        this.companies.imagen = imagen
        this.companies.imagenAnterior = imagen
    },
    methods:{
        updateBusinessUnits(){
            const formData = new FormData();
            formData.append('RFC', this.companies.RFC)
            formData.append('idUnit', this.companies.idUnit)
            formData.append('idCompany', this.companies.idCompany)
            formData.append('nameUnit', this.companies.nameUnit)
            formData.append('telefono1', this.companies.telefono1)
            formData.append('telefono2', this.companies.telefono2)
            formData.append('correo', this.companies.correo)
            formData.append('sitioweb', this.companies.sitioweb)
            formData.append('namecontact', this.companies.namecontact)
            formData.append('horacancelation', this.companies.horacancelation)
            formData.append('imagen', this.companies.imagen)
            formData.append('imagenAnterior', this.companies.imagenAnterior)
            formData.append('_method', 'PUT')


            axios.post("/socios_negocios/"+this.companies.idUnits, formData)
            .then( res =>{
                const respuesta = res.data

                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true;
                toastr.options.progressBar = true;
                toastr.success(respuesta.messageDB,respuesta.messageHeader,{timeOut :  15000});
            })
            .catch( err => {
                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true;
                toastr.options.progressBar = true;
                toastr.success(err.response,'Ocurrio un Problema',{timeOut :  15000});
                console.log(err.response)
            })
        },
        getImagen(e){
            this.imagenActual = false
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
        }

    }

}
</script>

<style scoped>
.col-md-6 > div > .figure > img{
    width: 320px;
    height: 480px;
}
</style>