<template>
    <div class="">
        <p>Seleccione Negocio</p>
        <div class="form-row">
            <div class="form-group col-md-6">
                <select name="negocio" id="negocio" class="form-control" v-model="idNegocios">
                    <option v-bind:value="item.idUnits" v-for="(item,index) in unidades" :key="index">
                        {{ item.nameUnit }}
                    </option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <button class="btn btn-primary" v-on:click="consBooking()">Buscar</button>
            </div>
        </div>

        <div class="">
            <table class="table display nowrap" id="example" style="with: 100%" v-if="showtable">
                <thead>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Tel.</th>
                    <th>Mesa</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>PAX</th>
                    <th>Estatus</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in listBookings" :key="index">
                        <td>{{ index+1 }}</td>
                        <td>{{ item.name+' '+item.lastname }}</td>
                        <td>{{ item.phone }}</td>
                        <td>{{ item.num_mesa }}</td>
                        <td>{{ item.B_date }}</td>
                        <td>{{ item.B_hour }}</td>
                        <td>{{ item.pax }}</td>
                        <td v-if="item.status == 1">Realizada</td>
                        <td v-else-if="item.status == 2">Cancelada</td>
                        <td v-else-if="item.status == 3">Confirmada</td>
                        <td v-else-if="item.status == 4">Ni vino</td>
                        <td v-if="item.status == 1">
                            <button class="btn btn-info btn-sm">
                                <i class="far fa-edit"></i>
                            </button>
                        </td>  
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import aatatable from 'datatables.net-bs4'
import buttonsDatatable from 'datatables.net-buttons-bs4'

export default {
    props:{
        'unidades': {}
    },
    data(){
        return {
            idNegocios:0,
            listBookings:[],
            showtable: false
        }
    },
    created(){
        
    },
    mounted(){
        $(document).ready(function() {
            $('#example').DataTable( {
                "scrollX": true
            });
        });
    },
    methods:{
        consBooking(){
            axios.get('/consallbookings/'+this.idNegocios)
            .then(res => {
                this.listBookings = res.data
            })
            .catch(error =>{
                console.log(error.response)
            })
            this.showtable = true
        }
    }
}
</script>

<style>

</style>