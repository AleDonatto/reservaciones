<template>
    <div class="">
        <div class="mesas">
            <div>
                <h3 v-if="showMesas">Complete el formulario</h3>
                <h3>Seleccione Mesa</h3>
            </div>
            <div>
                <div class="contenedor listamesas">
                    <ValidationObserver v-slot="{handleSubmit, reset }" ref="form">
                        <form @submit.prevent="handleSubmit(reservarMesa)" @reset.prevent="reset" method="post">
                            <div class="row form-group">
                                <div class="col-4 col-md-4">
                                    <label for="fecha">Fecha</label>
                                    <ValidationProvider name="fecha" v-slot="{ errors }" rules="required|fechav">
                                        <input type="date" name="fecha" id="fecha" class="form-control" v-model="booking.fecha" 
                                        :class="{'is-invalid':errors[0] }">

                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ errors[0] }}</strong>
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
                            <button v-if="showMesas" type="submit" class="btn btn-primary">Buscar Mesas </button>
                            <button v-else type="submit" class="btn btn-primary">Reservar</button>
                        </form>
                    </ValidationObserver>
                    <div class="card mb-3" style="max-width: 400px;" v-for="(item, index) in listMesas " :key="index"
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
} );

export default {
    props:{
        unidad:0
    },
    data(){
        return {
            listMesas:[],
            booking:{ businessUnit:0, table:0, fecha:'', hora:'', personas:0 },
            showMesas: true
        }
    },
    created(){
        console.log(this.unidad)
        axios.get('getMesasUnidad/'+this.unidad)
        .then(res =>{
            this.listMesas = res.data
        })
    },
    methods:{
        buscarMesas(){
            console.log(this.unidad)
            axios.get('getMesasUnidad/'+this.unidad)
            .then(res =>{
                this.listMesas = res.data
            })
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
