<template>
<div>
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 text-primary">
                Crear Nuevo Usuario Administrador
            </h6>
        </div>
        <div class="card-body">
            <ValidationObserver v-slot="{handleSubmit, reset}" ref="form">
                <form action="" method="post" @submit.prevent="handleSubmit(createUser)" @reset.prevent="reset">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="name">Nombre del usuario</label>
                            <ValidationProvider name="name" rules="required" v-slot="{ errors }">
                                <input type="text" name="name" id="name" v-model="user.name" class="form-control" maxlength="50" 
                                :class="{'is-invalid':errors[0] }">

                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ errors[0] }}</strong>
                                </span>
                            </ValidationProvider>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="lastname">Apellidos</label>
                            <ValidationProvider name="lastname" rules="required" v-slot="{ errors }">
                                <input type="text" name="lastname" id="lastname" class="form-control" v-model="user.lastname" maxlength="50"
                                :class="{'is-invalid':errors[0] }">

                                <span class="invañid-feedback" role="alert">
                                    <strong>{{ errors[0] }}</strong>
                                </span>
                            </ValidationProvider>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="correo">Correo</label>
                            <ValidationProvider name="correo" rules="required|email" v-slot="{ errors }">
                                <input type="email" name="correo" id="correo" class="form-control" v-model="user.email" maxlength="50"
                                :class="{'is-invalid':errors[0] }">

                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ errors[0] }}</strong>
                                </span>
                            </ValidationProvider>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white">Crear Usuario</button>
                </form>
            </ValidationObserver>
        </div>
    </div>

    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <h6 class="m-0 text-primary">Lista de Usuarios</h6>
        </div>
        <div class="card-body">
            <v-simple-table>
                <template v-slot:default>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item,index) in listuser" :key="index">
                            <td>{{ index+1 }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.lastname }}</td>
                            <td>{{ item.email }}</td>
                            <td> <span class="badge badge-pill badge-info">Administrador</span> </td>
                        </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </div>
    </div>
</div>
</template>

<script>
import { extend } from 'vee-validate';
import { email, required } from 'vee-validate/dist/rules';

extend('email',email);

extend('required', {
  ...required,
  message: 'Este Campo es Requerido'
});

export default {
    props:{
        'usuarios': {}
    },
    data: () => ({
        user: {name:'', lastname: '', email:'', rol:1 },
        listuser: []
    }),
    mounted(){
        this.listuser = this.usuarios
    },
    methods:{
        createUser(){

            axios.post('/createUserAdmin',this.user)
            .then( res => {
                const respuesta = res.data 

                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true;
                toastr.options.progressBar = true;
                toastr.success('Usuario Administrador creado!','Usuario Administrador',{timeOut :  15000});

                this.listuser = respuesta

            })
            .catch( err => {
                console.log(err.response)
            })

            this.$refs.form.validate().then(success => {
                if (!success) {
                    return;
                }
                // Resetting Values
                this.user.name = this.user.lastname = this.user.email = '';
                this.user.rol = 1;
                
                // Wait until the models are updated in the UI
                this.$nextTick(() => {
                    this.$refs.form.reset();
                });
            });
        }
    }

}
</script>

<style scoped>

</style>