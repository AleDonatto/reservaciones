<template>      
    <div class="">
        <div class="" v-if="misReservaciones == 0">
        </div>
        <div class="" v-else>
            <h3>Mis Reservaciones</h3>
            <div class="contenedor">
                <div class="card w-75" v-for="(item, index) in misReservaciones" :key="index+1">
                    <div class="card-body">
                        <h5 class="card-title">{{ item.nameUnit }}</h5>
                        <p class="card-text">
                            Contacto: {{ item.phone1 }} <br>
                            Fecha: {{item.B_date +'-'+ item.B_hour }} <br>
                            Personas: {{ item.pax+' Mesa: '+ item.num_mesa}} <br>
                        </p>
                        <p class="card-text"><small class="text-muted">Realizada el: {{ item.created_at }}</small></p>
                        <button type="button" class="btn btn-info">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger" v-on:click="cancelarReservacion(item.idBooking)">
                            <i class="fas fa-window-close"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import swal from 'sweetalert';
export default {
    data(){
        return{
            misReservaciones:[]
        }
    },
    created(){
        axios.get('/getLitsReservaciones')
        .then(res =>{
            this.misReservaciones = res.data
        })
        .catch(err =>{
            console.log(err.response)
        });
    },
    methods:{
        modificarReservacion(){

        },
        cancelarReservacion(reservacion){
            swal({
                title: "Esta seguro?",
                text: "Una vez hechos los cambio no podran revertirse!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    let data;
                    axios.get('cancelarReservacion/'+reservacion)
                    .then( res => {
                        data = res.data
                        this.misReservaciones = data.listaReservacion

                        swal(data.notificacion.mensage, {
                            icon: data.notificacion.tipo,
                        });
                        //swal(data.titulo,data.mensage, data.tipo);
                    })
                    .catch( err => {
                        console.log(err.response)
                    });
                }
            });

            axios.get('/getLitsReservaciones')
            .then(res =>{
                this.misReservaciones = res.data
            });
        }
    }
}
</script>

<style>

</style>