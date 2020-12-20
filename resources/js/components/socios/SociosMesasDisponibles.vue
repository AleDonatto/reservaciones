<template>
<div class="">
    <form action="" method="post" class="form-inline mx-auto ml-auto">
        <label for="fecha" class="mb-2 mr-sm-2">Seleccione Fecha:</label>
        <input type="date" name="fecha" id="fecha" class="form-control mb-2 mr-sm-2" v-model="inputFecha" >

        <button type="button" class="btn btn-primary mb-2 text-white" v-on:click="Fecha()">Buscar</button>
    </form>

    <div class="listamesas" >
        <div v-for="(item, index) in mesasdisponibles" :key="index">
            <!--<div class="" v-if="mesasdisponibles == false">
                <p>Sin mesas agregadas</p>
            </div>-->
            <div v-if="item.status == 0">
                <div class="card mb-3 bg-success text-dark" style="max-width: 350px;">
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ item.num_mesa }}</h5>
                                <p class="card-text">Sillas: {{ item.number_chairs }}</p>
                                <div class="" v-if="fechaseleccionada">
                                    <p class="card-text">Reservas para esta mesa: </p>
                                    <p v-show="!fechaseleccionada">Seleccione Fecha</p>
                                    <TheLitsBookins :fecha="fechaBooking" :idMesa="item.idTables" v-show="fechaseleccionada"></TheLitsBookins>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props:{
        "mesasdisponibles":{}
    },
    data(){
        return {
            listaMesas:  {},
            statusMesa: 'Disponible',
            fechaseleccionada: false,
            inputFecha: '',
            fechaBooking: ''
        }
    },
    methods:{
        Fecha(){
            //this.fechaseleccionada = true
            if(this.inputFecha != ''){
                this.fechaseleccionada = true
                this.fechaBooking = this.inputFecha
            }else{
                this.fechaseleccionada = false
            }
        }
    }
}
</script>

<style>
.listamesas{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}
.listamesas>.card{
    margin-bottom: 10px;
}
</style>