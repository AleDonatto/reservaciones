<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Password</h5>
                <p class="text-black">Cambio de contraseña</p>
            </div>
            <div class="col-md-8 card">
                <ValidationObserver v-slot="{handleSubmit, reset}" ref="formPassoword">
                    <form @submit.prevent="handleSubmit(updatePassword)" @reset.prevent="reset" id="formPassword" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="actual">Contraseña Actual</label>
                                <ValidationProvider name="actual" rules="required" v-slot="{errors}">
                                    <input type="password" name="actual" id="actual" class="form-control" v-model="user.actual"
                                    :class="{'is-invalid': errors[0] }" maxlength="15">

                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ errors[0] }}</strong>
                                    </div>
                                </ValidationProvider>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="nueva">Nueva Contraseña</label>
                                <ValidationProvider name="nueva" rules="required" v-slot="{ errors }">
                                    <input type="password" name="nueva" id="nueva" class="form-control" v-model="user.nueva"
                                    :class="{'is-invalid': errors[0]}" maxlength="15">

                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ errors[0] }}</strong>
                                    </div>
                                </ValidationProvider>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="confirmar">Confirmar Nueva Contraseña</label>
                                <ValidationProvider name="confirmar" rules="required" v-slot="{ errors }">
                                    <input type="password" name="confirmar" id="confirmar" class="form-control" v-model="user.confirmarNueva"
                                    :class="{'is-invalid':errors[0]}" maxlength="15">

                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ errors[0] }}</strong>
                                    </div>
                                </ValidationProvider>
                            </div>
                        </div>
                        <div class="d-flex flex-row-reverse bd-highlight">
                            <button type="submit" class="btn btn-primary text-white">Guardar Cambios</button>
                        </div>
                    </form>
                </ValidationObserver>
            </div>
        </div>
    </div>
</template>

<script>
import { extend } from 'vee-validate';
import { required, email } from 'vee-validate/dist/rules';
import swal from 'sweetalert';

extend('email',email);

extend('required', {
  ...required,
  message: 'Este Campo es Requerido'
});

export default {
    data(){
        return {
            user:{ actual:'', nueva: '', confirmarNueva:'' }
        }
    }
    ,created(){},
    methods:{
        updatePassword(){
            axios.post('/updatePassword', this.user)
            .then(res => {
                const result = res.data
                console.log(res.data)
                swal(result.title,result.mensaje,result.tipo)
            })
            .catch(err => {
                console.log(err.response)
                swal('error wee')
            })
        }
    }

}
</script>

<style>

</style>