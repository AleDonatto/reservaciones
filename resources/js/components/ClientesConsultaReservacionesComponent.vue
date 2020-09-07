<template>
<div class="">
    <table class="table">
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
                <td>{{ item.status }}</td>  
            </tr>
        </tbody>
    </table>
</div> 
</template>

<script>
export default {
    props:{
        lista: {}
    },
    data(){
        return{

        }
    }

}
</script>

<style>

</style>