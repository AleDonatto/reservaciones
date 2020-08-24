<template>
    <div class="">
        <form action="" method="post" class="form-inline mx-auto ml-auto">
            <label for="fecha" class="mb-2 mr-sm-2">Seleccione Fecha:</label>
            <input type="date" name="fecha" id="fecha" class="form-control mb-2 mr-sm-2" v-model="inputFecha" >

            <button type="button" class="btn btn-primary mb-2" v-on:click="Fecha()">Buscar</button>
        </form>

        <div class="card shadow">
            <div class="card-header">
                <h4 class="m-0 font-weight-bold text-primary">Mesas Negocio</h4>
            </div>
            <div class="card-body">
                <div class="" v-if="listaMesas == 0">
                    <p>Sin mesas agregadas</p>
                </div>
                <div class="listamesas" v-else>
                    <div class="card mb-3 " style="max-width: 400px;" v-for="(item, index) in listaMesas " :key="index"
                    :class="{'bg-light text-dark':item.status == 0, 'text-white bg-danger':item.status == 1 }">
                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{ item.num_mesa }}</h5>
                                    <p class="card-text">Sillas: {{ item.number_chairs }}</p>
                                    <label v-if="item.status==0">Estatus: Disponible </label>
                                    <label v-else>Estatus: Reservada</label>
                                    <p class="card-text">Reservas para esta mesa: </p>
                                    <p v-show="!fechaseleccionada">Seleccione Fecha</p>
                                    <TheLitsBookins :fecha="fechaBooking" :idMesa="item.idTables"  v-show="fechaseleccionada"></TheLitsBookins>
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
        'mesas':{}
    },
    data(){
        var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getFullYear();
        return {
            listaMesas: this.mesas,
            statusMesa: 'Disponible',
            fechaseleccionada: false,
            inputFecha: '',
            fechaBooking: ''
        }
    },
    methods:{
        print(){
        },
        CmabiarEstatus(){
            this.statusMesa = 'Ocupada'
        },
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