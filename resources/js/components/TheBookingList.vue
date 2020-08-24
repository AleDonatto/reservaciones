<template>
    <div>
        <button class="btn btn-primary" type="button" data-toggle="collapse" :data-target="'#listaBookins'+this.idMesa" aria-expanded="false" :aria-controls="'listaBookins'+this.idMesa"
        v-on:click="verReservas()">
            Ver Reservaciones 
        </button>
        <div class="collapse" :id="'listaBookins'+this.idMesa">
            <div class="">
                <ul class="list-group" v-if="listaBookins == 0">
                    <li class="list-group-item">
                        No hay Reservaciones para esta mesas
                    </li>
                </ul>
                <ul class="list-group" v-else>
                    <li class="lis-group-item" v-for="(item, index) in listaBookins" :key="index">
                        {{ item.name+'-'+item.date+'-'.item.hour }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        fecha: '',
        idMesa: 0
    },
    data(){
        return {
            listaBookins: []
        }
    },
    created(){
        /*axios.get('socios_reservaciones/'+idMesa)
        .then(res => {
            const server = res.data

            coonsole.log(server)
        })*/
    },
    methods:{
        verReservas(){
            axios.get('/socios_getListBookings/'+this.idMesa+'/'+this.fecha)
            .then(res => {
                const server = res.data
                this.listaBookins = server
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