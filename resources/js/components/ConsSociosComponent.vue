<template>
<div class="">
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
                    <button type="button" class="btn btn-circle btn-info btn-sm text-white">
                        <i class="far fa-edit"></i>
                    </button>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>RFC</th>
                <th>Razon Social</th>
                <th>Telefono 1</th>
                <th>Telefono 2</th>
                <th>Correo</th>
                <th>Sitio Web</th>
                <th>Nombre Contacto</th>
                <th>Opciones</th>
            </tr>
        </tfoot>
    </table>
</div>
</template>

<script>
import aatatable from 'datatables.net-bs4'
import buttonsDatatable from 'datatables.net-buttons-bs4'

export default {
    props:{
        'list_socios':{}
    },
    data: () =>{
        return{

        }
    },
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
        }
    }
</script>

<style>

</style>