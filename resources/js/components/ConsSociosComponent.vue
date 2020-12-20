<template>
<div class="">
    <template>
    <table id="usertable" class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">RFC</th>
                <th scope="col">Razon Social</th>
                <th scope="col">Telefono 1</th>
                <th scope="col">Telefono 2</th>
                <th scope="col">Correo</th>
                <th scope="col">Sitio Web</th>
                <th scope="col">Nombre Contacto</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item,index) in list_socios" :key="index">
                <td>{{ index+1 }}</td>
                <td>{{ item.RFC }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.phone1 }}</td>
                <td>{{ item.phone2 }}</td>
                <td>{{ item.email }}</td>
                <td>{{ item.website }}</td>
                <td>{{ item.name_contact }}</td>
                <td>
                    <button class="btn btn-info btn-sm text-white">
                        <i class="far fa-edit"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
    </template>

    <template>
        <v-row justify="center">
                <v-dialog v-model="dialog" persistent max-width="600px"> 
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
                                                    <input type="date" name="fecha" id="fecha" class="form-control" disabled
                                                    :class="{'is-invalid': errors[0] }">

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ errors[0] }}</strong>
                                                    </span>
                                                </ValidationProvider>
                                                <input type="hidden" name="idbookings">
                                                <input type="hidden" name="unidad"  >
                                                <input type="hidden" name="mesa" >
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="hora">Hora</label>
                                                <ValidationProvider name="hora" rules="required" v-slot="{errors}">
                                                    <input type="time" name="hora" id="hora" class="form-control"  disabled
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
                                                    <input type="number" name="pax" id="pax" class="form-control" step="1" min="0" disabled
                                                    :class="{'is-invalid': errors[0]}">

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ errors[0] }}</strong>
                                                    </span>
                                                </ValidationProvider>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="estatus">Estatus</label>
                                                <ValidationProvider name="estatus" rules="required" v-slot="{errors}">
                                                    <select name="estatus" id="" class="form-control" :class="{'is-invalid': errors[0]}">
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
import aatatable from 'datatables.net-bs4'
import buttonsDatatable from 'datatables.net-buttons-bs4'

export default {
    props:{
        'list_socios':{}
    },
    data: () =>({
        socio: {},
        dialog: false
    }),
    mounted(){
        this.datatable()
    },
    methods:{
        datatable(){
            var table = $('#usertable').DataTable( {
                //"dom": 'Blfrtip',
                "scrollX": true,
                lengthChange: false,
                //buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
                buttons: ['copy', 'excel']
            });
            table.buttons().container()
                .appendTo( '#usertable_wrapper .col-md-6:eq(0)' );
            }
        },
        open(){
            this.dialog = true
        },
        close(){
            this.dialog = false
        }
    }
</script>

<style>

</style>