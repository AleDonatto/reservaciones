<template>
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 text-primary">Mesas de Negocio</h6>
    </div>
    <v-card>
        <ValidationObserver v-slot="{ handleSubmit, reset }" ref="form">
            <form action="" method="post" @submit.prevent="handleSubmit(agregarMesas)" @reset.prevent="reset">
                <v-container>
                    <v-row>
                        <v-col cols="12" md="6">
                            <label for="company">Seleccione Compañia</label>
                            <ValidationProvider name="company" rules="required" v-slot="{ errors }">
                                <select name="company" id="company" class="form-control" v-model="id_company" :onchange="getUnidades()" :class="{'is-invalid':errors[0]}"> 
                                    <option value="" selected>Seleccione</option>
                                    <option :value="item.idCompanies" v-for="(item, index) in list_companies" :key="index">{{ item.name }}</option>
                                </select>

                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ errors[0] }}</strong>
                                </span>
                            </ValidationProvider>
                        </v-col>
                        <v-col cols="12" md="6">
                            <label for="unidad">Seleccione Unidad</label>
                            <ValidationProvider name="unidad" rules="required" v-slot="{erros}">
                                <select name="unidad" id="unidad" class="form-control" :error-messages="erros" v-model="mesas.negocio">
                                    <option value="" selected>Seleccione</option>
                                    <option :value="item.idUnits" v-for="item in listunits" :key="item.idUnits">
                                        {{ item.nameUnit }}
                                    </option>
                                </select>
                            </ValidationProvider>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="6" md="6" sm="6">
                            <label for="num_mesa">Numero/Nombre Mesa</label>
                            <ValidationProvider name="num_mesa" rules="required|max:15" v-slot="{ errors }">
                                <input type="text" name="num_mesa" id="" class="form-control" v-model="mesas.numMesa" maxlength="15" 
                                :class="{'is-invalid':errors[0]}">
                                <!--<v-text-field v-model="mesas.numMesa" label="Nombre/numero Mesa" :error-messages="errors" :counter="15" ></v-text-field>-->
                            </ValidationProvider>
                        </v-col>
                        <v-col cols="6" md="6" sm="6">
                            <label for="sillas">Numero de Sillas</label>
                            <ValidationProvider name="sillas" rules="required" v-slot="{errors}">
                                <input type="number" name="sillas" id="" class="form-control" v-model="mesas.numerosillas" min="1" max="50" step="1"
                                :class="{'is-invalid':errors[0]}">
                                <!--<v-text-field v-model="mesas.numerosillas" :error-messages="errors" type="number" min="1" max="10" step="1"></v-text-field>-->
                            </ValidationProvider>
                        </v-col>
                    </v-row>
                    <button type="submit" class="btn btn-primary text-white">
                        <i class="fas fa-store-alt"></i>
                        Agregar Unidad
                    </button>
                    <button type="reset" class="btn btn-light">Restablecer</button>
                </v-container>
            </form>
        </ValidationObserver>
    </v-card>
</div>
</template>

<script>

export default {
    props:{
        'list_companies':{},
        'listaunidades':{}
    },
    data: () =>({
        listunits:[],
        id_company: '',
        mesas:{ negocio: '', numMesa:'', numerosillas:1 },
        actual: 0, 
        anterior: 0
    }),
    methods:{
        getUnidades(){
            this.actual = this.id_company
            if( this.id_company > 0){
                if( this.actual != this.anterior){
                    this.anterior = this.actual
                    axios.get('/getlistaunidades/'+this.id_company)
                    .then( res => {
                        this.listunits = res.data
                    })
                    .catch(err => {
                        console.log(err.respose)
                    })
                }
            }
        },
        agregarMesas(){
            axios.post('/mesas',this.mesas)
            .then( res => {
                const server = res.data

                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true;
                toastr.options.progressBar = true;
                toastr.success(server.messageDB,server.messageHeader,{timeOut :  15000});
            })
            .catch( err => {
                const server = res.data

                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true;
                toastr.options.progressBar = true;
                toastr.warning(err.response,'Mesas',{timeOut :  15000});
            })
            this.limpiarForm()
        },
        limpiarForm(){
            this.$refs.form.validate().then(success => {
                if (!success) {
                    return;
                }
                // Resetting Values
                this.mesas.negocio = this.mesas.numerosillas = 0
                this.mesas.numMesa = ''
                
                // Wait until the models are updated in the UI
                this.$nextTick(() => {
                    this.$refs.form.reset();
                });
            });
        }
    }

}
</script>

<style scoped>

</style>
