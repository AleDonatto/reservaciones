<template>
    <div class="card shadow">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Mesas de Negocios</h4>
        </div>
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-6">
                    <label for="socios">Selecciones Socios</label>
                    <select name="socio" id="socios" class="form-control" v-on:change="getNegocios()" v-model="socios">
                        <option value="">Seleccione</option>
                        <option v-for="(item, index) in listSocios" v-bind:value="item.idCompanies" :key="index">
                            {{ item.name }}
                        </option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="negocio">Seleccione Negocio</label>
                    <select name="negocio" id="negocio" class="form-control">
                        <option>Seleccione</option>
                        <option v-for="(item, index) in listUnidades" v-bind:value="idUnits" :key="index">
                            {{ item.nameUnit }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            listSocios:[],
            listUnidades:[],
            socios: '',
            getUnidades: false
        }
    },
    created(){
        axios.get('/socios').then(res=>{
            this.listSocios = res.data;
            //console.log(this.listSocios);
        });
    },
    updated(){
        if(this.getUnidades){
            axios.get('/negocios').then(res=>{
                console.log(res.data)
                this.listUnidades = res.data;
                //console.log(this.listSocios);
            })
            .then(response => {
                console.log(response)
            })
            .catch(error => {
                console.log(error.response)
            });
        }
    },
    methods:{
        getNegocios(){
            this.getUnidades = true
            /*console.log(this.socios)
            axios.get('/negocios/',{id: this.socios}).then(res=>{
                console.log(res.data)
                this.listUnidades = res.data;
                //console.log(this.listSocios);
            })
            .then(response => {
                console.log(response)
            })
            .catch(error => {
                console.log(error.response)
            });*/
        }

    }
}
</script>

<style>

</style>