<template>
<div class="">

    <!--<table class="table table-sm" id="usertable" style="width:100%">
        <thead>
            <th>#</th>
            <th>Restaurant</th>
            <th>Mesa</th>
            <th>Dia</th>
            <th>Hora</th>
            <th>Personas</th>
            <th>Estatus</th>
        </thead>
        <tbody>
            <tr v-for="(item, index) in lista" :key="index">
                <td>{{ index+1 }}</td>
                <td>{{ item.nameUnit }}</td>
                <td>{{ item.num_mesa }}</td>
                <td>{{ item.B_date }}</td>
                <td>{{ item.B_hour }}</td>
                <td>{{ item.pax }}</td>
                <td v-if="item.status == 1">Pendiente</td>
                <td v-else-if="item.status == 2">Cancelada</td>
                <td v-else-if="item.status == 3">Confirmada</td>
                <td v-else>No fuiste</td>    
            </tr>
        </tbody>
    </table>-->

    <!--<div>
        <v-data-table :headers="headers" :items="lista" class="elevation-1">
            <template v-slot:items="props">
                <td class="text-xs-right">{{ props.item.nameUnit }}</td>
                <td class="text-xs-right">{{ props.item.num_mesa }}</td>
                <td class="text-xs-right">{{ props.item.B_date }}</td>
                <td class="text-xs-right">{{ props.item.B_hour }}</td>
                <td class="text-xs-right">{{ props.item.pax }}</td>
                <td class="text-xs-right">{{ this.getText(props.item.status) }} </td>
            </template>
        </v-data-table>
    </div>-->

    <div class="">
        <v-card>
            <v-card-title>
                Reservaciones 
                <v-spacer></v-spacer>
                <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
            </v-card-title>
            <v-data-table :headers="headers" :items="lista" :search="search"></v-data-table>

           <!-- <v-data-table :headers="headers" :items="lista" :search="search" no-data-text="No data to display" class="elevation-1">
                <template v-slot:items="props">
                    <v-chip :value="getText(props.item.status)" dark></v-chip>
                    <td class="text-xs-right">{{ props.item.nameUnit }}</td>
                    <td class="text-xs-right">{{ props.item.num_mesa }}</td>
                    <td class="text-xs-right">{{ props.item.B_date }}</td>
                    <td class="text-xs-right">{{ props.item.B_hour }}</td>
                    <td class="text-xs-right">{{ props.item.pax }}</td>
                    <td class="text-xs-right">{{ props.item.status}}</td>
                </template>
            </v-data-table>  -->
        </v-card>
    </div>
</div> 
</template>

<script>

export default {
    props:{
        lista: {},
        idcliente: 0
    },
    data(){
        return{
            page: 1,
            pageCount: 0,
            itemsPerPage: 10,
            search: '',
            listaBookings:[],
            headers: [
                { text: 'Restaurant', align: 'start', sortable: false, value: 'nameUnit',},
                { text: 'Mesa', value: 'num_mesa' },
                { text: 'Dia', value: 'B_date' },
                { text: 'Horas', value: 'B_hour' },
                { text: 'Personas', value: 'pax' },
                { text: 'Estatus', value:  'status'}//this.getText(status) }
            ],
            desserts: [
            ],
            loading: false
        }
    },
    mounted(){
        this.datatable()
    },
    methods:{
        getText(numero){
            switch(numero){
                case 1: return 'Pendiente'
                case 2: return 'Cancelada'
                case 3: return 'Confirmada'
                case 4: return 'Ni fuiste'
            }
        },
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
    }
}
</script>

<style>

</style>