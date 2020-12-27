<template>
    <div class="">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 text-primary">Unidad de Negocio</h6>
            </div>
            <div class="card-body">
                <ValidationObserver v-slot="{handleSubmit}" ref="form">
                    <form action="" method="post" class="form-inline" @submit.prevent="handleSubmit(consMesas)">
                        <label for="unidades" class="sr-only">Unidad</label>
                        <ValidationProvider name="unidades" rules="required" v-slot="{errors}">
                            <select name="unidades" id="unidades" class="form-control mb-2 mr-sm-2" :class="{'is-invalid':errors[0]}" v-model="unidad.idUnidad">
                                <option value="" selected>Seleccione Opcion</option>
                                <option :value="item.idUnits" v-for="(item, index) in listaUnidades" :key="index">{{ item.nameUnit }}</option>
                            </select>

                            <span class="invalid-feedback" role="alert">
                                <strong>{{ errors[0] }}</strong>
                            </span>
                        </ValidationProvider>
                        <button type="submit" class="btn btn-primary text-white mb-2">Consultar</button>
                    </form>
                </ValidationObserver>
            </div>
        </div>

        <div class="card shadow mt-5">
            <div class="card-header p-3">
                <h6 class="m-0 text-primary">Mesas de la unidad</h6>
            </div>
            <div class="card-body">
                <v-simple-table>
                    <template v-slot:default>
                        <thead>
                            <tr>
                                <th class="text-left">#</th>
                                <th class="text-left">Mesa</th>
                                <th class="text-left">Sillas</th>
                                <th class="text-left">Status</th>
                                <th class="text-left">Acciones</th>  
                            </tr>
                        </thead>
                        <tbody v-if="listaMesas == 0" class="text-center">
                            <span class="text-secondary">No data avalible</span> 
                        </tbody>
                        <tbody v-else>
                            <tr v-for="(item, index) in listaMesas" :key="index">
                                <td>{{ index+1 }}</td>
                                <td>{{ item.num_mesa }}</td>
                                <td>{{ item.number_chairs }}</td>
                                <td v-if="item.status == 0"><span class="badge badge-success">Disponible</span></td>
                                <td v-else><span class="badge badge-warning">Reservada</span></td>
                                <td>
                                    <button class="btn" @click="open(item, index)">
                                        <i class="far fa-edit"></i>
                                    </button>
                                   <!--<template v-slot:item.action="{ item }">
                                        <v-icon small class="mr-2" @click="editItem(item)">edit</v-icon>
                                    </template>-->
                                </td>
                            </tr>
                        </tbody>
                    </template>
                </v-simple-table>
                <div class="text-center">
                    <!--<v-pagination v-model="page" :length="listaMesas.length" circle></v-pagination>-->
                </div>
            </div>
        </div>

        <template>
            <v-row justify="center">
                <v-dialog v-model="dialog" persistent max-width="600px"> 
                    <v-card>
                        <ValidationObserver v-slot="{handleSubmit}" ref="form">
                            <form action="" method="post" @submit.prevent="handleSubmit(editMesas)">
                                <v-card-title>
                                    <span class="headline">Datos de Mesa</span>
                                </v-card-title>
                                <v-card-text>
                                    <v-container>
                                        <div class="form-group">
                                            <div class="col">
                                                <label for="numMesa">Mesa</label>
                                                <ValidationProvider name="mesa" rules="required" v-slot="{errors}">
                                                    <input type="text" name="numMesa" id="numMesa" class="form-control" v-model="mesas.num_mesa"
                                                    :class="{'is-invalid': errors[0] }" maxlength="10">

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ errors[0] }}</strong>
                                                    </span>
                                                </ValidationProvider>
                                                <input type="hidden" name="idtables" v-model="mesas.idTables">
                                                <input type="hidden" name="idunits" v-model="mesas.units">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col">
                                                <label for="sillas">Asientos</label>
                                                <ValidationProvider name="sillas" rules="required" v-slot="{errors}">
                                                    <input type="number" name="sillas" id="sillas" class="form-control" v-model="mesas.number_chairs"
                                                    :class="{'is-invalid': errors[0]}">

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ errors[0] }}</strong>
                                                    </span>
                                                </ValidationProvider>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col">
                                                <label for="estatus">Estatus</label>
                                                <ValidationProvider name="estatus" rules="required" v-slot="{errors}">
                                                    <select name="estatus" id="estatus" class="form-control" v-model="mesas.status" :class="{'is-invalid': errors[0]}">
                                                        <option value="" selected>Seleccione Opcion</option>
                                                        <option value="0">Disponible</option>
                                                        <option value="1">Reservada</option>
                                                    </select>

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
  message: 'Esta campo es requerido'
});

export default {
    props:{
        'unidades': {}
    },
    data: () => ({
        page: 1,
        unidad: { idUnidad:'' },
        mesas:{ idTables:'', units:'', num_mesa:'', number_chairs:0, status: 0 },
        listaUnidades:[],
        listaMesas: [],
        dialog: false,
        idexArray: 0
    }),
    computed: {
    },
    created(){
        this.listaUnidades = this.unidades
    },
    methods:{
        consMesas(){
            axios.get('/getMesasUnidad/'+this.unidad.idUnidad)
            .then(res =>{
                this.listaMesas = res.data
            })
            .catch( error => {
                console.log(error)
            })
        },
        close() {
            this.dialog = false
        },
        open(item, index){
            this.dialog = true

            this.mesas.idTables = item.idTables
            this.mesas.units = item.units
            this.mesas.num_mesa = item.num_mesa
            this.mesas.number_chairs = item.number_chairs
            this.mesas.status = item.status

            this.idexArray = index
        },
        editMesas() {
            const formdata = new FormData()
            formdata.append('idTables', this.mesas.idTables)
            formdata.append('units', this.mesas.units)
            formdata.append('num_mesa', this.mesas.num_mesa)
            formdata.append('number_chairs', this.mesas.number_chairs)
            formdata.append('status', this.mesas.status)
            formdata.append('_method', 'PUT')

            axios.post("/socios_mesas/"+this.mesas.idTables, formdata)
            .then( res =>{
                const respuesta = res.data 
            
                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true;
                toastr.options.progressBar = true;
                toastr.success(respuesta.messageDB,respuesta.messageHeader,{timeOut :  15000});

                this.dialog = false
                Object.assign(this.listaMesas[this.idexArray], this.mesas)
                //this.listaMesas[this.idexArray] = this.mesas;
            })
            .catch( err => {
                console.log(err.response)
            })
        },
    }
}
</script>

<style>

</style>