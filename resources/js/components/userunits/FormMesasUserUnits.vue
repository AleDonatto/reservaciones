<template>
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 text-primary">Mesas de Negocio</h6>
        </div>
        <div class="card-body">
            <ValidationObserver v-slot="{handleSubmit, reset}" ref="form">
                <form @submit.prevent="handleSubmit(agregarMesas)" method="post" @reset.prevent="reset">
                    <div class="row form-group">
                        <div class="col-6 col-md-6 col-sm-12">
                            <label for="negocio">Seleccione Negocio:</label>
                            <ValidationProvider name="negocio" rules="required" v-slot="{ errors }">
                                <select name="negocios" id="negocios" class="form-control" v-model="mesas.idunidad" 
                                :class="{'is-invalid': errors[0] }">
                                    <option value="">Seleccione</option>
                                    <option v-for="(item, index) in listUnidades" v-bind:value="item.idUnits" :key="index">
                                        {{ item.nameUnit }}
                                    </option>
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ errors[0] }}</strong>
                                </span>
                            </ValidationProvider>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6 col-md-6 col-sm-12">
                            <label for="mesa">Numero/Nombre Mesa</label>
                            <ValidationProvider name="mesa" rules="required" v-slot="{ errors }">
                                <input type="text" name="mesa" id="mesa" class="form-control" :class="{'is-invalid': errors[0]}"
                                v-model="mesas.numeromesa" maxlength="10">

                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ errors[0] }}</strong>
                                </span>
                            </ValidationProvider>
                        </div>
                        <div class="col-6 col-md-6 col-sm-12">
                            <label for="sillas">Numero de Sillas</label>
                            <ValidationProvider name="sillas" rules="required" v-slot="{ errors }">
                                <input type="number" name="sillas" id="sillas" class="form-control" v-model="mesas.sillas" min="0" step="1"
                                :class="{ 'is-invalid': errors[0] }">

                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ errors[0] }}</strong>
                                </span>
                            </ValidationProvider>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white">Agregar Mesa</button>
                </form>
            </ValidationObserver>
        </div>
    </div>
</template>

<script>
import { extend } from 'vee-validate';
import { required } from 'vee-validate/dist/rules';

extend('required', {
  ...required,
  message: 'Esta campo es requerido'
});

export default {
    props:{
        'unidades': {}
    },
    data(){
        return{
            listUnidades:[],
            mesas:{idunidad:'', sillas: 0, status:0, numeromesa:''}
        }
    },
    created(){
        this.listUnidades = this.unidades
    },
    methods:{
        agregarMesas(){
            axios.post('/socios_mesas',this.mesas)
            .then( res => {
                const server = res.data

                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true;
                toastr.options.progressBar = true;
                toastr.success(server.messageDB,server.messageHeader,{timeOut :  15000});
            })
            .catch( error => {
                console.log(error.response)
            })

            this.limpiarForm();
        },
        limpiarForm(){
            this.$refs.form.validate().then(success => {
                if (!success) {
                    return;
                }
                // Resetting Values
                this.mesas.idunidad = this.mesas.numeromesa = ''
                this.mesas.sillas = this.mesas.status = 0
                
                // Wait until the models are updated in the UI
                this.$nextTick(() => {
                    this.$refs.form.reset();
                });
            });
        }
    }
}
</script>

<style>

</style>