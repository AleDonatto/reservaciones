<template>
  <div class="">
    <div class="">
        <h4>{{ texto }}</h4>
    </div>

    <div></div>
    
    <div class="contenedor" v-if="showSocios">
        <div class="card" style="width: 16rem;" v-for="(item, index) in socios" :key="index">
            <img :src="'images/break.jpg'" class="card-img-top" alt="">
            <div class="card-body">
                <h5 class="card-title">{{ item.name }}</h5>
                <p class="card-text">{{ item.RFC }}</p>
                <button type="button" class="btn btn-light btn-block" v-on:click="unidadesShow(item.idCompanies)">
                    <i class="fas fa-address-book"></i>  Ver Unidades
                </button>
            </div>
        </div>
    </div>

    <div class="contenedor" v-if="showUnits">
        <div class="card" style="width: 16rem;" v-for="(item, index) in listaunidades" :key="index">
            <img :src="'images/break.jpg'" class="card-img-top" alt="">
            <div class="card-body">
                <h5 class="card-title">{{ item.nameUnit }}</h5>
                <p class="card-text">{{ item.RFC }}</p>
                <button type="button" class="btn btn-light btn-block" v-on:click="mesasShow(item.idUnits)">
                    <i class="fas faaddress-book"></i> Ver Mesas
                </button>
            </div>
        </div>
    </div>

    <div class="contenedor" v-if="showMesas">
        <div class="card mb-3 " style="max-width: 350px;" v-for="(item, index) in listamesas " :key="index"
        :class="{'bg-success text-dark':item.status == 0, 'text-white bg-warning':item.status == 1 }">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ item.num_mesa }}</h5>
                        <p class="card-text">Sillas: {{ item.number_chairs }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container d-inline justify-content-center" v-if="showMesas">
        <button type="button" class="btn btn-info text-white" @click="inicio()">
            <i class="fas fa-home"></i> Inicio
        </button>
    </div>

  </div>
</template>

<script>
export default {
    props:{
        'socios':{}
    },
    data: () => {
        return {
            showSocios:true,
            showUnits: false,
            showMesas: false,
            listaunidades: [],
            listamesas:[],
            texto: 'Socios'
        }
    },
    methods:{
        unidadesShow(id){
            this.showSocios= false
            this.showUnits = true
            this.texto = 'Unidades de Negocio'

            axios.get('getlistaunidades/'+id)
            .then( res => {
                this.listaunidades = res.data
            })
            .catch( err => {
                console.log(err.respose)
            })
        },
        mesasShow(id){
            this.showUnits = false
            this.showMesas = true
            this.texto = 'Mesas de Negocio'

            axios.get('getMesasUnidad/'+id)
            .then( res => {
                this.listamesas = res.data
            })
            .catch( err => {
                console.log(err.respose)
            })
        },
        inicio(){
            this.showSocios = true,
            this.showUnits = false,
            this.showMesas = false,
            this.texto = 'Socios'
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