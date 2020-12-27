<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Informacion del Pefil</h5>
                <p class="text-black">Actualizacion de Datos</p>
            </div>
            <div class="col-md-8 card">
                <div class=" ">
                    <ValidationObserver v-slot="{handleSubmit}" ref="form">
                        <form id="form"  method="post"  @submit.prevent="handleSubmit(updateDatos)">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">Nombre</label>
                                    <ValidationProvider name="nombre" rules="required" v-slot="{ errors }">
                                        <input type="text" name="nombre" id="nombre" class="form-control" v-model="user.nombre"
                                        :class="{'is-invalid': errors[0] }" maxlength="50">

                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ errors[0] }}</strong>
                                        </div>
                                    </ValidationProvider>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="apellidos">Apellidos</label>
                                    <ValidationProvider name="apellidos" rules="required" v-slot="{ errors }">
                                        <input type="text" name="apellidos" id="apellidos" class="form-control" v-model="user.apellidos"
                                        :class="{'is-invalid': errors[0]}" maxlength="50">
                                        
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ errors[0] }}</strong>
                                        </div>
                                    </ValidationProvider>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="correo">E-mail</label>
                                    <ValidationProvider name="correo" rules="required" v-slot="{ errors }">
                                        <input type="email" name="" id="" class="form-control" v-model="user.correo"
                                        :class="{'is-invalid': errors[0]}" maxlength="50">

                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ errors[0] }}</strong>
                                        </div>
                                    </ValidationProvider>
                                </div>
                            </div>
                            <div class="d-flex flex-row-reverse bd-highlight">
                                <button type="submit" class="btn btn-primary text-white">Guardar Datos</button>
                            </div>
                        </form>
                    </ValidationObserver>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { extend } from 'vee-validate';
import { required, email } from 'vee-validate/dist/rules';
import swal from 'sweetalert';

extend('email',email);

extend('required', {
  ...required,
  message: 'Este Campo es Requerido'
});

export default {
    data() {
        return {
            user: {id: 0,nombre: "", apellidos: "", correo: "" },
        };
    },
    created(){
        axios.get('/getDatosUserProfile')
        .then(res => {
            this.user.id = res.data.id
            this.user.nombre = res.data.name
            this.user.apellidos = res.data.lastname
            this.user.correo = res.data.email
        })
        .catch( err => {
            console.log(err.response)
        })
    },
    methods:{
        updateDatos(){

            axios.post('/updateDatosProfile', this.user)
            .then(res => {
                const datos = res.data 
                console.log(res.data)
                swal(datos.title ,datos.mensaje, datos.tipo);
            })
            .catch(error => {
                console.log(error.response)
                swal('Datos de Perfil','Ocurrio un problema al modificar', 'error');
            })
        }
    }
}
</script>

<style>

</style>