<template>
    <div class="">
        <div class="card w-75" v-if="bookings == 0">
            <div class="card-body">
                <div>
                    <h5 class="card-title">
                        Reservaciones
                    </h5>
                    <p class="card-text">
                        No hay reservaciones hasta el momento
                    </p>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="card w-75" v-for="(item, index) in listBookings" :key="index">
                <div class="card-body">
                    <div>
                        <h5 class="card-title">
                            Nombre: {{ item.name+' '+item.lastname }}
                        </h5>
                        <p class="card-text">
                            Tel: {{ item.phone }} 
                            Pax: {{ item.pax }} 
                            Mesa: {{ item.num_mesa }}
                        </p>
                        <form action="" method="post" @submit.prevent="confirmarLlegada()">
                            <input type="hidden" name="reservacion" v-model="reservacion.id">
                            <button type="submit" class="btn btn-success">
                                <i class="far fa-check-circle"></i>
                                Confirmar Llegada
                            </button>
                        </form>
                        <form action="" method="post" @submit.prevent="noLlego()">
                            <input type="hidden" name="reservacion" v-model="reservacion.id">
                            <button type="submit" class="btn btn-warning">
                                <i class="far fa-times-circle"></i>
                                Ni vino 
                            </button>
                        </form>
                        <!--<a href="#" class="btn btn-success">
                            <i class="far fa-check-circle"></i>
                            Confirmar Llegada
                        </a>-->
                        <!--<a href="" class="btn btn-warning">
                            <i class="far fa-check-circle"></i>
                            Ni vino
                        </a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        'bookings':{}
    },
    data(){
        return {
            reservacion: {
                id: 0,
                listBookings:[]
            }
        }
    },
    created(){
        this.listBookings = this.bookings
    },
    methods:{
        confirmarLlegada(){
            axios.post('/confirmarReservacion',this.reservacion)
            .then(res => {
                var server = res.data
                
                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true;
                toastr.options.progressBar = true;
                toastr.success(server.messageDB,server.messageHeader,{timeOut :  15000});

                this.listBookings.splice(item.idBooking, this.reservacion.id);
            })


        },
        noLlego(){
            axios.post('/confirmarAusenciaReservacion',this.reservacion)
            .then(res => {
                var server = res.data

                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true;
                toastr.options.progressBar = true;
                toastr.success(server.messageDB,server.messageHeader,{timeOut :  15000});

                this.listBookings.splice(item.idBooking, this.reservacion.id);
            })
        }
    }
}
</script>

<style>

</style>