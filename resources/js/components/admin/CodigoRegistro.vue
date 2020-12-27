<template>
    <div>
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weith-bold text-primary">Crear Codigos de Seguridad</h6>
            </div>
            <div class="card-body">
                <ValidationObserver v-slot="{ handleSubmit, reset}" ref="form">
                    <form @submit.prevent="handleSubmit(crearCodigo)" @reset.prevent="reset" method="post">
                        <div class="row form-group">
                            <div class="col-md-12 col-12 col-sm-12 col-xl-12">
                                <ValidationProvider name="codigo" rules="required" v-slot="{errors}">     
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo de Registro" aria-label="Recipient's username" aria-describedby="button-addon2"
                                        v-model="codigo.code" :class="{'is-invalid':errors[0]}">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="button-addon2" @click="CodeSeg()">Generar Codigo</button>
                                        </div>

                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ errors[0] }}</strong>
                                        </span>
                                    </div>
                                </ValidationProvider>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-6 col-md-6 col-sm-6 col-xl-6">
                                <label for="fecha">Fecha de Vencimiento</label>
                                <ValidationProvider name="fecha" rules="required|fechav" v-slot="{ errors }">
                                    <input type="date" name="fecha" id="fecha" class="form-control" v-model="codigo.fecha" :class="{'is-invalid':errors[0]}">

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ errors[0] }}</strong>
                                    </span>
                                </ValidationProvider>
                            </div>
                            <div class="col-6 col-md-6 col-sm-6 col-xl-6">
                                <label for="socio">Seleccione Socio</label>
                                <ValidationProvider name="socio" rules="required" v-slot="{errors}">
                                    <select name="socio" id="socio" class="form-control" v-model="codigo.companies" :class="{'is-invalid':errors[0]}">
                                        <option value="" selected>Seleccione</option>
                                        <option v-for="(item, index) in socios" :key="index"  :value="item.companies">
                                            {{ item.RFC+'-'+item.name }}
                                        </option>
                                    </select>

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ errors[0] }}</strong>
                                    </span>
                                </ValidationProvider>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary text-white">
                            <i class="fas fa-check"></i>
                            Crear Codigo
                        </button>
                        <button type="reset" class="btn btn-light text-black">Retablecer</button>
                    </form>
                </ValidationObserver>
            </div>

        </div>

        <div class="card shadow mt-5">
            <div class="card-header py-3">
                <h6 class="m-0 font-weith-bold text-primary">Conuslta de Codigos</h6>
            </div>
            <div class="card-body">
                <v-simple-table>
                    <template v-slot:default>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Codigo</th>
                                <th>Fecha Expiracion</th>
                                <th>Socio</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in listCodigos" :key="index">
                                <td>{{ index+1 }}</td>
                                <td>{{ item.code_verification}}</td>
                                <td>{{ item.date_expiration }}</td>
                                <td>{{ item.name }}</td>
                                <td>
                                    <button class="btn" @click="open(item, index)">
                                        <i class="far fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </template>
                </v-simple-table>
            </div>
        </div>

        <template>
            <v-row justify="center">
                <v-dialog v-model="dialog" persistent max-width="600px"> 
                    <v-card>
                        <ValidationObserver v-slot="{handleSubmit}" ref="form">
                            <form action="" method="post" @submit.prevent="handleSubmit(editarCodigos)">
                                <v-card-title>
                                    <span class="headline">Codigos de Registro</span>
                                </v-card-title>
                                <v-card-text>
                                    <v-container>
                                        <div class="form-group">
                                            <div class="col">
                                                <label for="numMesa">Codigo</label>
                                                <ValidationProvider name="codigo" rules="required" v-slot="{errors}">
                                                    <input type="text" name="codigo" id="codigo" class="form-control" v-model="codigoEdit.code_verification"
                                                    :class="{'is-invalid': errors[0] }" maxlength="20" disabled>

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ errors[0] }}</strong>
                                                    </span>
                                                </ValidationProvider>
                                                <input type="hidden" name="idcode" v-model="codigoEdit.idCode">
                                                <input type="hidden" name="companies" v-model="codigoEdit.companies">
                                                <input type="hidden" name="user" v-model="codigo.user">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col">
                                                <label for="sillas">Fecha</label>
                                                <ValidationProvider name="fecha" rules="required|fechav" v-slot="{errors}">
                                                    <input type="date" name="fecha" id="fecha" class="form-control" v-model="codigoEdit.date_expiration"
                                                    :class="{'is-invalid': errors[0]}">

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ errors[0] }}</strong>
                                                    </span>
                                                </ValidationProvider>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col">
                                                <label for="estatus">Socio</label>
                                                <ValidationProvider name="socios" rules="required" v-slot="{errors}">
                                                    <input type="text" name="socios" id="socios" class="form-control" v-model="codigoEdit.name" 
                                                    :class="{'is-invalid':errors[0]}" maxlength="50" disabled>

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ errors[0] }}</strong>
                                                    </span>
                                                </ValidationProvider>
                                            </div>
                                        </div>    
                                    </v-container>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <button type="button" class="btn btn-light mx-2" @click="close">Close</button>
                                    <button type="submit" class="btn btn-primary text-white">Guardar</button>
                                    <!--<v-btn color="blue darken-1" text @click="close">Close</v-btn>
                                    <v-btn color="blue darken-1" text @click="">Save</v-btn>-->
                                </v-card-actions>
                            </form>
                        </ValidationObserver>
                    </v-card>
                </v-dialog>
            </v-row>
        </template>
    </div>
</template>

<script>
import { extend } from 'vee-validate';
import { required } from 'vee-validate/dist/rules';

extend('required', {
  ...required,
  message: 'Este Campo es Requerido'
});

extend('fechav', fecha => {
    var fechanow = new Date();
    var fechainput = new Date(fecha+'T00:00:00')

    return fechainput > fechanow;  
});

export default {
    props: {
        'socios': {},
        'codigos': {}
    },
    data: () => ({
        codigo: { code: '', fecha:'', companies: ''},
        codigoEdit: {idCode: 0, code_verification: '', date_expiration: '', user:0, name: ''},
        listCodigos: [],
        dialog: false,
        indexArray: 0
    }),
    mounted(){
        this.listCodigos = this.codigos
    },
    methods:{
        crearCodigo(){
            axios.post('/codigos',this.codigo)
            .then( res => {
                const respuesta = res.data

                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true;
                toastr.options.progressBar = true;
                toastr.success('Codigo agredo al socio!','Codigos',{timeOut :  15000});

                this.listCodigos = respuesta
            })
            .catch( err => {
                console.log(err.response)
            })

            this.$refs.form.validate().then(success => {
                if (!success) {
                    return;
                }

                // Resetting Values
                this.codigo.code = this.codigo.fecha = this.codigo.companies = ''; 
                // Wait until the models are updated in the UI
                this.$nextTick(() => {
                    this.$refs.form.reset();
                });
            });
        },
        random() {
            return Math.random().toString(36).substr(2); // Eliminar `0.`
        },
        CodeSeg(){
            const num = Math.floor(Math.random() * (1000 - 0) +0);
            const finnum = Math.floor(Math.random() * (1000- 0)+0);
            const token = num +  this.random().toUpperCase() + finnum ;
            this.codigo.code = token
        },
        open(item, index){
            this.dialog = true

            this.codigoEdit.idCode = item.idCode
            this.codigoEdit.code_verification = item.code_verification
            this.codigoEdit.date_expiration = item.date_expiration
            this.codigoEdit.name = item.name
            this.codigoEdit.companies = item.companies
            this.codigoEdit.user = item.user
            
            this.indexArray = index
        },
        close(){
            this.dialog = false

            this.codigoEdit.idCode = 0
            this.codigoEdit.code_verification = ''
            this.codigoEdit.date_expiration = ''
            this.codigoEdit.name = ''
            this.codigoEdit.companies = ''
            this.codigoEdit.user = 0
            
            this.indexArray = 0
        },
        editarCodigos(){
            const formdata = new FormData();
            formdata.append('idCode', this.codigoEdit.idCode)
            formdata.append('numero', this.codigoEdit.code_verification)
            formdata.append('fecha', this.codigoEdit.date_expiration)
            formdata.append('companies', this.codigoEdit.companies)
            formdata.append('user', this.codigoEdit.user)
            formdata.append('_method', 'PUT')

            axios.post('/codigos/'+this.codigoEdit.idCode, formdata)
            .then(res => {
                const respuesta = res.data

                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true;
                toastr.options.progressBar = true;
                toastr.success(respuesta.messageDB,respuesta.messageHeader,{timeOut :  15000});
                
                this.dialog = false
                Object.assign(this.listCodigos[this.indexArray], this.codigoEdit)
            })
            .catch( err => {
                console.log(err.response)
            })
        }
    }
}
</script>

<style>

</style>