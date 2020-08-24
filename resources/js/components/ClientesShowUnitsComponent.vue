<template>
<div>
    <div class="" v-if="showUnits">
        <h3>Reservar Ahora</h3>
    </div>
    <div class="contenedor" v-if="showUnits">
        <div class="card" style="width: 18rem;" v-for="(item, index) in listUnits" :key="index">
            <img :src="'images/break.jpg'" class="card-img-top" alt="">
            <div class="card-body">
                <h5 class="card-title">{{ item.nameUnit }}</h5>
                <p class="card-text">
                    Tiempo de Cancelacion: {{ item.cancelation_time_limit }} (horas) <br>
                    Telefono: {{ item.phone1 }} <br>
                </p>
                <button type="button" class="btn btn-light btn-block" v-on:click="MesasShow(item.idUnits)">
                    <i class="fas fa-address-book"></i>  Reservar
                </button>
            </div>
        </div>
    </div>

    <div class="mesas" v-if="showMesas">
        <div>
            <h3>Seleccione Mesa</h3>
        </div>
        <div>
            <div class="" v-if="listMesas == 0">
                <p>No hay mesas por el momento</p>
            </div>
            <div class="listamesas" v-else>
                <div class="card mb-3" style="max-width: 400px;" v-for="(item, index) in listMesas " :key="index"
                :class="{'card text-white bg-success mb-3':item.status == 0, 'text-white bg-danger':item.status == 1 }">
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ item.num_mesa }}</h5>
                                <label v-if="item.status==0">Estatus: Disponible </label>
                                <label v-else>Estatus: Reservada</label>
                                <br>
                                <div class="custom-control custom-radio">
                                    <input type="radio" :id="'customRadio'+index" name="customRadio" class="custom-control-input" v-bind:value="item.idTables"
                                    v-model="booking.table">
                                    <label class="custom-control-label" :for="'customRadio'+index">Seleccionar Mesa</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ValidationObserver v-slot="{handleSubmit, reset }" ref="form">
                    <form @submit.prevent="handleSubmit(reservarMesa)" @reset.prevent="reset" method="post">
                        <div class="row form-group">
                            <div class="col-4 col-md-4">
                                <label for="fecha">Fecha</label>
                                <ValidationProvider name="fecha" v-slot="{ errors }" rules="required">
                                    <input type="date" name="fecha" id="fecha" class="form-control" v-model="booking.fecha" 
                                    v-on:blur="selectFecha" :class="{'is-invalid':fechaValida == false,'is-invalid':errors[0] }">

                                    <span class="invalid-feedback" role="alert">
                                        <strong v-if="fechaValida == false">Fecha Invalida</strong>
                                    </span>
                                </ValidationProvider>
                            </div>
                            <div class="col-4 col-md-4">
                                <label for="hora">Hora</label>
                                <ValidationProvider name="hora" rules="required" v-slot="{ errors }">
                                    <input type="time" name="hora" id="hora" class="form-control" v-model="booking.hora" 
                                    step='1' min="00:00:00" max="23:59:59" :class="{'is-invalid':errors[0]}">

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ errors[0] }}</strong>
                                    </span>
                                </ValidationProvider>
                            </div>
                            <div class="col-4 col-md-4">
                                <label for="personas">Personas</label>

                                <ValidationProvider name="personas" rules="required" v-slot="{ errors }">
                                    <input type="number" name="personas" id="personas" step="1" min="0" class="form-control" 
                                    v-model="booking.personas" :class="{ 'is-invalid':errors[0] }">

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ errors[0] }}</strong>
                                    </span>
                                </ValidationProvider>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Reservar</button>
                    </form>
                </ValidationObserver>
            </div>
        </div>
    </div>
</div>
  
</template>

<script>
import swal from 'sweetalert';
import { extend } from 'vee-validate';
import { required } from 'vee-validate/dist/rules';

extend('required', {
  ...required,
  message: 'Este Campo es Requerido'
});


export default {
    data(){
        return{
            listUnits: [],
            listMesas:[],
            showUnits: true,
            showMesas: false,
            booking:{ businessUnit:0, table:0, fecha:'', hora:'', personas:0 },
            fechaValida: true 
        };
    },
    created(){
        axios.get('/getlistunidades')
        .then(res =>{
            this.listUnits = res.data
        });
    },
    methods:{
        MesasShow(id){
            this.booking.businessUnit = id
            this.showUnits = false
            this.showMesas = true

            axios.get('getMesasUnidad/'+id)
            .then(res =>{
                this.listMesas = res.data
            })
        },
        reservarMesa(){
            axios.post('/postReservacion',this.booking)
            .then(res => {
                console.log(res.data)
                swal("Good job!", "You clicked the button!", "success");
            })
            .catch(err =>{
                console.log(err.response)
            })
        },
        selectFecha(){
            var fecha = new Date();
            var fechainput = new Date(this.booking.fecha)

            this.fechaValida = fechainput > fecha   
            console.log(this.fechaValida)
        }
    }

}
</script>

<style>
.contenedor{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.contenedor > .card {
    margin-bottom: 10px;
}
</style>