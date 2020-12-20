<template>
    <div class="">
        <div class="contenedor" v-if="showUnidades">
            <div class="card" style="width: 16rem;" v-for="(item, index) in this.unidades" :key="index">
                <img :src="'/images/break.jpg'" class="card-img-top" alt="restaurant">
                <div class="card-body">
                    <h5 class="card-title">{{ item.nameUnit }}</h5>
                    <p class="card-text">
                        Tiempo de Cancelacion: {{ item.cancelation_time_limit }} (horas) <br>
                        Telefono: {{ item.phone1 }} <br>
                    </p>
                    <button type="button" class="btn btn-light btn-block text-black" v-on:click="MesasShow(item.idUnits)">
                        <i class="fas fa-address-book"></i>  Reservar
                    </button>
                </div>
            </div>
        </div>
        
        <div class="" v-if="formMesas">
            <ValidationObserver v-slot="{handleSubmit, reset }" ref="form">
                <form @submit.prevent="handleSubmit(buscarMesas)" @reset.prevent="reset" method="post">
                    <div class="row form-group">
                        <div class="col-6 col-md-6">
                            <label for="fecha">Fecha</label>
                            <ValidationProvider name="fecha" v-slot="{ errors }" rules="required|fechav">
                                <input type="date" name="fecha" id="fecha" class="form-control" v-model="booking.fecha" 
                                :class="{'is-invalid':errors[0] }" min="2020-09-01" max="2020-12-31">

                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ errors[0] }}</strong>
                                </span>
                            </ValidationProvider>
                        </div>
                        <div class="col-6 col-md-6">
                            <label for="hora">Hora</label>
                            <ValidationProvider name="hora" rules="required" v-slot="{ errors }">
                                <input type="time" name="hora" id="hora" class="form-control" v-model="booking.hora" 
                                min="00:00" max="23:00" :class="{'is-invalid':errors[0]}">

                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ errors[0] }}</strong>
                                </span>
                            </ValidationProvider>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white">Buscar Mesa</button>
                    <button type="reset" class="btn btn-danger text-white" v-on:click="cancelarReservacion()">Cancelar</button>
                </form>
            </ValidationObserver>
        </div>
        <div v-if="showMesas">
            <div class="mesas">
                <div>
                    <h3>Seleccione Mesa</h3>
                </div>
                <div class="">
                    <ValidationObserver v-slot="{handleSubmit, reset }" ref="form">
                        <form @submit.prevent="handleSubmit(reservarMesa)" @reset.prevent="reset" method="post">
                            <div class="row form-group">
                                <div class="col-4 col-md-4 col-sm-12">
                                    <label for="fecha">Fecha</label>
                                    <ValidationProvider name="fecha" v-slot="{ errors }" rules="required|fechav">
                                        <input type="date" name="fecha" id="fecha" class="form-control" v-model="booking.fecha" 
                                        :class="{'is-invalid':errors[0] }" min="2020-09-01" max="2020-12-31">

                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ errors[0] }}</strong>
                                        </span>
                                    </ValidationProvider>
                                </div>
                                <div class="col-4 col-md-4 col-sm-12">
                                    <label for="hora">Hora</label>
                                    <ValidationProvider name="hora" rules="required" v-slot="{ errors }">
                                        <input type="time" name="hora" id="hora" class="form-control" v-model="booking.hora" 
                                        min="00:00" max="23:00" :class="{'is-invalid':errors[0]}">

                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ errors[0] }}</strong>
                                        </span>
                                    </ValidationProvider>
                                </div>
                                <div class="col-4 col-md-4 col-sm-12">
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
                            <div class="row">
                                <div class="col-12">
                                    <h5>Mesas</h5>
                                </div>
                                <div class="listamesas col-md-12">
                                    <div class="card mb-3" style="max-width: 400px;" v-for="(item, index) in listMesas " :key="item.idTables"
                                    :class="{'card text-white bg-success mb-3':item.status == 0, 'text-white bg-warning':item.status == 1 }">
                                        <div class="row no-gutters">
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">{{ item.num_mesa }}</h5>
                                                    <label v-if="item.status==0">Estatus: Disponible </label>
                                                    <label v-else>Estatus: Reservada</label>
                                                    <br>
                                                    <div class="custom-control custom-radio" v-if="item.status==0">
                                                        <input type="radio" :id="'customRadio'+index" name="customRadio" class="custom-control-input" v-bind:value="item.idTables"
                                                        v-model="booking.table">
                                                        <label class="custom-control-label" :for="'customRadio'+index">Seleccionar Mesa</label>
                                                    </div>
                                                    <div class="" v-else></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary text-white">Reservar</button>
                            <button type="reset" class="btn btn-danger text-white" v-on:click="cancelarReservacion()">Cancelar</button>
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

extend('fechav', fecha => {
    var fechanow = new Date();
    var fechainput = new Date(fecha+'T00:00:00')

    return fechainput > fechanow;  
});

export default {
    props:{
        'unidades':{}
    },
    data(){
        return {
            showUnidades: true,
            showMesas: false,
            listMesas:[],
            booking:{ businessUnit:0, table:0, fecha:'', hora:'', personas:0 },
            formMesas: false
        }
    },
    created(){

    },
    methods: {
        MesasShow(id){
            this.booking.businessUnit = id
            this.showUnidades = false
            this.formMesas = true
        },
        buscarMesas(){
            axios.post('/buscarMesas',this.booking)
            .then(res => {
                var response = res.data
                this.listMesas = response
            })
            .catch(err => {
                console.log(err.response)
            })
            this.showMesas = true
            this.formMesas = false
        },
        cancelarReservacion(){
            this.showMesas = false
            this.showUnidades = true

            this.booking.businessUnit = this.booking.table = this.booking.personas = 0
            this.booking.fecha = this.booking.hora = ''
        },
        reservarMesa(){

            axios.post('/postReservacion',this.booking)
            .then(res => {
                var response = res.data
                swal(response.titulo,response.mensage, response.tipo);
            })
            .catch(err =>{
                console.log(err.response)
            })

            this.$refs.form.validate().then(success => {
                if (!success) {
                    return;
                }
                // Resetting Values
                this.booking.businessUnit = this.booking.table = this.booking.personas = 0;
                this.booking.fecha = this.booking.hora = ''; 
                // Wait until the models are updated in the UI
                this.$nextTick(() => {
                    this.$refs.form.reset();
                    this.showMesas = false
                    this.showUnidades = true
                });
            });
        }
    }
}
</script>

<style scoped>
.contenedor{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.contenedor > .card {
    margin-bottom: 10px;
}
</style>