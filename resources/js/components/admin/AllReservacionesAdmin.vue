<template>
    <div class="">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 text-primary">Unidad y fecha</h6>
            </div>
            <div class="card-body">
                <ValidationObserver v-slot="{handleSubmit}" ref="form">
                <form action="" method="post" @submit.prevent="handleSubmit(consBooking)">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="unidad">Seleccione</label>
                            <ValidationProvider name="unidad" rules="required" v-slot="{errors}">
                                <select name="unidad" id="unidad" class="form-control" v-model="negocio.idNegocios" 
                                :class="{'is-invalid': errors[0]}">
                                    <option value="" selected>Seleccione</option>
                                    <option :value="item.idUnits" v-for="(item, index) in unidades" :key="index">
                                        {{ item.nameUnit }}
                                    </option>
                                </select>

                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ errors[0] }}</strong>
                                </span>
                            </ValidationProvider>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fecha">Fecha</label>
                            <input type="date" name="fecha" id="fecha" class="form-control" v-model="negocio.fecha">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary text-white mb-2">Consultar</button>
                </form>
                </ValidationObserver>
            </div>
        </div>

        <div class="mt-5">
            <div class="card shadow" v-if="showtable">
                <div class="card-header py-3">
                    <h6 class="mb-0 text-primary">Lista de Bookings</h6>
                </div>
                <div class="card-body">
                    <v-simple-table>
                        <template v-slot:default>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Tel.</th>
                                    <th>Mesa</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>PAX</th>
                                    <th>Estatus</th>
                                    <th>Usuario</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <!--<tbody v-if="listBookings == 0" class="text-center">
                                <span class="text-secondary">No data avalible</span>
                            </tbody>-->
                            <tbody>
                                <tr v-for="(item, index) in listBookings" :key="index">
                                    <td>{{ index+1 }}</td>
                                    <td>{{ item.name+' '+item.lastname }}</td>
                                    <td>4</td>
                                    <td>{{ item.num_mesa }}</td>
                                    <td>{{ item.bdate }}</td>
                                    <td>{{ item.bhour }}</td>
                                    <td>{{ item.pax }}</td>
                                    <td v-if="item.status == 1"><span class="badge badge-info">Realizada</span></td>
                                    <td v-else-if="item.status == 2"><span class="badge badge-pill badge-danger">Cancelada</span></td>
                                    <td v-else-if="item.status == 3"><span class="badge badge-pill badge-success">Confirmada</span></td>
                                    <td v-else-if="item.status == 4"><span class="badge badge-pill badge-warning">Ni vino</span></td>
                                    <td v-if="item.rol == 1"><span class="badge badge-secondary">Admin</span></td>
                                    <td v-else-if="item.rol == 2"><span class="badge badge-pill badge-secondary">Socio</span></td>
                                    <td v-else-if="item.rol == 3"><span class="badge badge-pill badge-secondary">Socio Unit</span></td>
                                    <td v-else-if="item.rol == 4"><span class="badge badge-pill badge-secondary">Cliente</span></td>
                                    <td v-if="item.status == 1">
                                        <button class="btn btn-info btn-sm" @click="open(item, index)">
                                            <i class="far fa-edit"></i>
                                        </button>
                                    </td>
                                    <td v-else></td>  
                                </tr>
                            </tbody>
                        </template>
                    </v-simple-table>
                </div>
            </div>
        </div>

        <template>
            <v-row justify="center">
                <v-dialog v-model="showDialog" persistent max-width="600px"> 
                    <v-card>
                        <ValidationObserver v-slot="{handleSubmit}" ref="form">
                            <form action="" method="post" @submit.prevent="handleSubmit(editBookings)">
                                <v-card-title>
                                    <span class="headline">Datos de Reservacion</span>
                                </v-card-title>
                                <v-card-text>
                                    <v-container>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="fecah">Fecha</label>
                                                <ValidationProvider name="fecha" rules="required" v-slot="{errors}">
                                                    <input type="date" name="fecha" id="fecha" class="form-control" v-model="bookings.bdate" disabled
                                                    :class="{'is-invalid': errors[0] }">

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ errors[0] }}</strong>
                                                    </span>
                                                </ValidationProvider>
                                                <input type="hidden" name="idbookings" v-model="bookings.idbooking">
                                                <input type="hidden" name="unidad" v-model="bookings.unidad" >
                                                <input type="hidden" name="mesa" v-model="bookings.mesa">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="hora">Hora</label>
                                                <ValidationProvider name="hora" rules="required" v-slot="{errors}">
                                                    <input type="time" name="hora" id="hora" class="form-control" v-model="bookings.bhour" disabled
                                                    :class="{'is-invalid': errors[0] }">

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ errors[0] }}</strong>
                                                    </span>
                                                </ValidationProvider>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="pax">Pax</label>
                                                <ValidationProvider name="pax" rules="required" v-slot="{errors}">
                                                    <input type="number" name="pax" id="pax" class="form-control" step="1" min="0" v-model="bookings.personas" disabled
                                                    :class="{'is-invalid': errors[0]}">

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ errors[0] }}</strong>
                                                    </span>
                                                </ValidationProvider>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="estatus">Estatus</label>
                                                <ValidationProvider name="estatus" rules="required" v-slot="{errors}">
                                                    <select name="estatus" id="" class="form-control" v-model="bookings.status" :class="{'is-invalid': errors[0]}">
                                                        <option value="0" selected>Seleccione</option>
                                                        <option value="1">Realizado</option>
                                                        <option value="2">Cancelado</option>
                                                        <option value="3">Confirmado</option>
                                                        <option value="4">No vino</option>
                                                    </select>

                                                    <span class="invalid-feddback" role="alert">
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
import { required, min_value } from 'vee-validate/dist/rules';

extend('min_value', min_value);

extend('required', {
  ...required,
  message: 'Esta campo es requerido'
});

export default {
    props:{
        'unidades': {}
    },
    data(){
        return {
            negocio:{ idNegocios: '', fecha: '' },
            bookings: { idbooking:0 ,unidad:0, mesa:0, usuario: 0, bdate:'', bhour: '', personas:0, status:0 },
            listBookings:[],
            showtable: false,
            showDialog: false,
            indexArray: 0
        }
    },
    created(){
        
    },
    mounted(){
    },
    methods:{
        consBooking(){
            axios.post('/consallbookings',this.negocio)
            .then(res => {
                this.listBookings = res.data
            })
            .catch(error =>{
                console.log(error.response)
            })
            this.showtable = true
        },
        open(item, index){
            this.showDialog = true
            this.indexArray = index

            this.bookings.idbooking = item.idBooking
            this.bookings.unidad = item.businessUnit_id
            this.bookings.mesa = item.table_id
            this.bookings.usuario = item.usuario_id
            this.bookings.bdate = item.bdate 
            this.bookings.bhour = item.bhour
            this.bookings.personas = item.pax 
            this.bookings.status = item.status
        },
        close(){
            this.showDialog = false
            this.indexArray = 0

            this.bookings.idbooking = 0
            this.bookings.unidad = 0
            this.bookings.mesa = 0
            this.bookings.usuario = 0
            this.bookings.bdate = '' 
            this.bookings.bhour = ''
            this.bookings.personas = 0 
            this.bookings.status = ''
        },
        editBookings(){

            const formdata = new FormData()
            formdata.append('idbookings', this.bookings.idbooking)
            formdata.append('unidad', this.bookings.unidad)
            formdata.append('mesa',this.bookings.mesa)
            formdata.append('usuario', this.bookings.usuario)
            formdata.append('bdate', this.bookings.bdate)
            formdata.append('bhour', this.bookings.bhour)
            formdata.append('personas', this.bookings.personas)
            formdata.append('status', this.bookings.status)
            formdata.append('_method', 'PUT')

            axios.post(`/socios_reservaciones/${this.bookings.idbooking}`, formdata)
            .then(res => {
                const respuesta = res.data
                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true;
                toastr.options.progressBar = true;
                toastr.success(respuesta.messageDB,respuesta.messageHeader,{timeOut :  15000});
                
                this.showDialog = false 
                Object.assign(this.listBookings[this.indexArray], this.bookings)
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