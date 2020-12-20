<template>
<div class="">

    <div class="">
        <v-card>
            <v-card-title>
                Reservaciones 
                <v-spacer></v-spacer>
                <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
            </v-card-title>
            <!--<v-data-table :headers="headers" :items="lista" :search="search"></v-data-table>-->
            <v-simple-table :search="search">
                <template>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Restaurant</th>
                            <th>Mesa</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Pax</th>
                            <th>Estatus</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in lista" :key="index">
                            <td>{{index+1}}</td>
                            <td>{{ item.nameUnit }}</td>
                            <td>{{ item.num_mesa }}</td>
                            <td>{{ item.bdate }}</td>
                            <td>{{ item.bhour }}</td>
                            <td>{{ item.pax }}</td>
                            <td v-if="item.status == 1"><span class="badge badge-info">Realizada</span></td>
                            <td v-else-if="item.status == 2"><span class="badge badge-pill badge-danger">Cancelada</span></td>
                            <td v-else-if="item.status == 3"><span class="badge badge-pill badge-success">Confirmada</span></td>
                            <td v-else-if="item.status == 4"><span class="badge badge-pill badge-warning">Ni vino</span></td>
                            <td v-if="item.status == 1">
                                <button class="btn btn-info btn-sm" @click="open(item, index)">
                                    <i class="far fa-edit"></i>
                                </button>
                            </td>
                            <td v-else>

                            </td>
                        </tr>
                    </tbody>
                </template>
            </v-simple-table>

            <!--<v-data-table :headers="headers" :items="lista" :search="search" no-data-text="No data to display" class="elevation-1">
                <template v-slot:items="props">
                    <v-chip :value="getText(props.item.status)" dark></v-chip>
                    <td class="text-xs-right">{{ props.item.nameUnit }}</td>
                    <td class="text-xs-right">{{ props.item.num_mesa }}</td>
                    <td class="text-xs-right">{{ props.item.bdate }}</td>
                    <td class="text-xs-right">{{ props.item.bhour }}</td>
                    <td class="text-xs-right">{{ props.item.pax }}</td>
                    <td v-if="props.item.status == 1" class="text-xs-right">Realizada</td>
                </template>
            </v-data-table>-->
        </v-card>
    </div>

    <template>
        <v-row justify="center">
            <v-dialog v-model="dialog" persistent max-width="600px"> 
                <v-card>
                    <ValidationObserver v-slot="{handleSubmit}" ref="form">
                        <form action="" method="post" @submit.prevent="handleSubmit(editReservacion)">
                            <v-card-title>
                                <span class="headline">Datos de Reservacion</span>
                            </v-card-title>
                            <v-card-text>
                                <v-container>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="fecah">Fecha</label>
                                            <ValidationProvider name="fecha" rules="required|fechav" v-slot="{errors}">
                                                <input type="date" name="fecha" id="fecha" class="form-control" v-model="booking.fecha" 
                                                :class="{'is-invalid': errors[0] }">

                                                <span class="invalid-feedback" role="alert">
                                                    <strong>Puede reservar un dia despues de hoy</strong>
                                                </span>
                                            </ValidationProvider>
                                            <input type="hidden" name="idbookings" v-model="booking.id">
                                            <input type="hidden" name="unidad" v-model="booking.unidad" >
                                            <input type="hidden" name="mesa" v-model="booking.mesa">
                                            <input type="hidden" name="usuario" v-model="booking.usuario">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="hora">Hora</label>
                                            <ValidationProvider name="hora" rules="required" v-slot="{errors}">
                                                <input type="time" name="hora" id="hora" class="form-control" v-model="booking.hora" 
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
                                                <input type="number" name="pax" id="pax" class="form-control" step="1" min="0" v-model="booking.pax" 
                                                :class="{'is-invalid': errors[0]}">

                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ errors[0] }}</strong>
                                                </span>
                                            </ValidationProvider>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="estatus">Estatus</label>
                                            <ValidationProvider name="estatus" rules="required" v-slot="{errors}">
                                                <select name="estatus" id="" class="form-control" v-model="booking.estatus" disabled :class="{'is-invalid': errors[0]}">
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
    props:{
        lista: {},
        idcliente: 0
    },
    data: () => ({
        search: '',
        listaBookings:[],
        loading: false,
        dialog: false,
        booking: {
            id:0, unidad:0, mesa:0, usuario:0, fecha:'', hora:'', pax:0, estatus:''
        }
    }),
    mounted(){
    },
    methods:{
        close(){
            this.dialog = false

            this.booking.id = 0
            this.booking.unidad = 0
            this.booking.mesa = 0
            this.booking.usuario = 0
            this.booking.fecha = ''
            this.booking.hora = ''
            this.booking.pax = 0
            this.booking.estatus = ''
        },
        open(item, index){
            this.dialog = true

            this.booking.id = item.idBooking
            this.booking.unidad = item.businessUnit_id
            this.booking.mesa = item.table_id
            this.booking.usuario = item.usuario_id
            this.booking.fecha = item.bdate
            this.booking.hora = item.bhour
            this.booking.pax = item.pax
            this.booking.estatus = item.status
        },
        editReservacion(){
            const formdata = new FormData()
            formdata.append('idbookings', this.booking.id)
            formdata.append('unidad', this.booking.unidad)
            formdata.append('mesa',this.booking.mesa)
            formdata.append('usuario', this.booking.usuario)
            formdata.append('bdate', this.booking.fecha)
            formdata.append('bhour', this.booking.hora)
            formdata.append('personas', this.booking.pax)
            formdata.append('status', this.booking.estatus)
            formdata.append('_method', 'PUT')

            axios.post(`/socios_reservaciones/${this.booking.id}`, formdata)
            .then(res => {
                const respuesta = res.data
                swal("Listo!", "Reservacion modificada con exito", "success");
                
                this.dialog = false 
            })
            .catch( err => {
                console.log(err.response)
            })

            this.$refs.form.validate().then(success => {
                if (!success) {
                    return;
                }
                // Resetting Values
                this.booking.id = this.booking.unidad = this.booking.mesa = this.booking.usuario = this.booking.pax = 0;
                this.booking.fecha = this.booking.hora = this.booking.estatus = ''; 
                // Wait until the models are updated in the UI
                this.$nextTick(() => {
                    this.$refs.form.reset();
                });
            });   
        }
    }
}
</script>

<style>

</style>