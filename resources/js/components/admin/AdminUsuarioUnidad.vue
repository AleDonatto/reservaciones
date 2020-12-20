<template>
    <div class="">
        <div class="card shadow mb-5">
            <div class="card-header py-3">
                <h6 class="m-0 font-weith-bold text-primary">Usuarios</h6>
            </div>
            <div class="card-body">
                <ValidationObserver v-slot="{ handleSubmit, reset }" ref="form">
                    <form action="" method="post" @submit.prevent="handleSubmit(createUser)" @reset.prevent="reset">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Nombre</label>
                                <ValidationProvider name="name" rules="required" v-slot="{ errors }">
                                    <input type="text" name="name" id="name" v-model="usuario.name" class="form-control"
                                    :class="{'is-invalid':errors[0] }">

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ errors[0] }}</strong>
                                    </span>
                                </ValidationProvider>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastname">Apellidos</label>
                                <ValidationProvider name="lastname" rules="required" v-slot="{ errors }">
                                    <input type="text" name="lastname" id="lastname" v-model="usuario.lastname" class="form-control"
                                    :class="{'is-invalid': errors[0] }">

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ errors[0] }}</strong>
                                    </span>
                                </ValidationProvider>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="unidad">Seleccione Unidad </label>
                                <ValidationProvider name="unidad" rules="required" v-slot="{errors}">
                                    <select name="unidad" id="unidad" class="form-control" v-model="usuario.unidad" :class="{'is-invalid':errors[0]}">
                                        <option value="" selected>Seleccione Opcion</option>
                                        <option :value="item.idUnits" v-for="(item, index) in unidades" :key="index">
                                            {{ item.nameUnit }}
                                        </option>
                                    </select>

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ errors[0] }}</strong>
                                    </span>
                                </ValidationProvider>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="correo">Correo</label>
                                <ValidationProvider name="correo" rules="required" v-slot="{errors}">
                                    <input type="email" name="correo" id="correo" v-model="usuario.email" class="form-control" :class="{'is-invalid':errors[0]}">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ errors[0] }}</strong>
                                    </span>
                                </ValidationProvider>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary text-white">Crear</button>
                    </form>
                </ValidationObserver>
            </div>
        </div>

        <div class="card shadow mt-5">
            <div class="card-header py-3">
                <h6 class="m-0 font-weith-bold text-primary">Usuarios de Unidad de negocio</h6>
            </div>
            <div class="">
                <v-card>
                    <v-card-title>
                        Usuarios de Unidad 
                        <v-spacer></v-spacer>
                        <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                    </v-card-title>
                    <v-data-table :headers="headers" :items="list" :search="search"></v-data-table>
                </v-card>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props:{
        'unidades': {}
    },
    data: () => ({
        usuario: {name:'', lastname: '', email: '', unidad: ''},
        headers: [
            { text: 'Nombre', value: 'name' },
            { text: 'Apelllidos', value: 'lastname' },
            { text: 'Correo', value: 'email' },
            { text: 'Unidad', value: 'nameUnit' },
        ],
        search: '',
        page: 1,
        pageCount: 0,
        itemsPerPage: 10,
        list:[]
    }),
    created(){
        axios.get("/getAdminUsuariosUnidad")
        .then(res =>{
            this.list = res.data;
        })
        .catch(err => {
            console.log(err.responser)
        })
    },
    methods: {
        createUser(){

            axios.post('/usuariosunidad_store', this.usuario)
            .then(res =>{
                const respuesta = res.data 
            
                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true;
                toastr.options.progressBar = true;
                toastr.success(respuesta.messageDB,respuesta.messageHeader,{timeOut :  15000});

                this.list.push(this.usuario)
            })
            .catch( err => {
                const error = err.data
                
                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true;
                toastr.options.progressBar = true;
                toastr.warning(error.messageDB,error.messageHeader,{timeOut :  15000});
            })

            this.$refs.form.validate().then(success => {
                if (!success) {
                    return;
                }
                // Resetting Values
                this.usuario.name = this.usuario.lastname = this.usuario.email = '';
                this.usuario.unidad = '';
                
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