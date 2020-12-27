<template>
<div class="">

    <v-simple-table>
        <template v-slot:default>
            <thead>
                <tr>
                    <th>#</th>
                    <th>RFC</th>
                    <th>Razon Social</th>
                    <th>Tel 1</th>
                    <th>Tel 2</th>
                    <th>Correo </th>
                    <th>Sitio web</th>
                    <th>Nombre Contacto</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,index) in listSocios" :key="index">
                    <td>{{ index+1 }}</td>
                    <td>{{ item.RFC }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.phone1 }}</td>
                    <td>{{ item.phone2 }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.website }}</td>
                    <td>{{ item.name_contact }}</td>
                    <td>
                        <button class="btn btn-info btn-sm text-white" @click="open(item, index)">
                            <i class="far fa-edit"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </template>

    </v-simple-table>

    <template>
        <v-row justify="center">
                <v-dialog v-model="dialog" persistent max-width="600px"> 
                    <v-card>
                        <ValidationObserver v-slot="{handleSubmit}" ref="form">
                            <form action="" method="post" @submit.prevent="handleSubmit(editSocio)">
                                <v-card-title>
                                    <span class="headline">Datos del Socio</span>
                                </v-card-title>
                                <v-card-text>
                                    <v-container>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="rfc ">RFC</label>
                                                <ValidationProvider name="rfc" rules="required|rfc" v-slot="{errors}">
                                                    <input type="text" name="rfc" id="rfc" class="form-control" v-model="socio.RFC"
                                                    :class="{'is-invalid': errors[0] }" maxlength="15">

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ errors[0] }}</strong>
                                                    </span>
                                                </ValidationProvider>
                                                <input type="hidden" name="idCompanies" v-model="socio.idCompanies">
                                                <input type="hidden" name="usuario" v-model="socio.idUser">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="name">Razon Social</label>
                                                <ValidationProvider name="name" rules="required" v-slot="{errors}">
                                                    <input type="text" name="name" id="name" class="form-control" v-model="socio.name"
                                                    :class="{'is-invalid': errors[0] }" maxlength="50">

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ errors[0] }}</strong>
                                                    </span>
                                                </ValidationProvider>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="phone1">Telefono 1</label>
                                                <ValidationProvider name="phone1" rules="required" v-slot="{errors}">
                                                    <input type="text" name="phone1" id="phone1" class="form-control" v-model="socio.phone1"
                                                    :class="{'is-invalid': errors[0]}" maxlength="10">

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ errors[0] }}</strong>
                                                    </span>
                                                </ValidationProvider>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="phone2">Telefono 2</label>
                                                <ValidationProvider name="phone2" rules="" v-slot="{errors}">
                                                    <input type="text" name="phone2" id="phone2" class="form-control" v-model="socio.phone2" 
                                                    :class="{'is-invalid': errors[0] }" maxlength="10">

                                                    <span class="invalid-feddback" role="alert">
                                                        <strong>{{ errors[0] }}</strong>
                                                    </span>
                                                </ValidationProvider>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="email">Correo</label>
                                                <ValidationProvider name="email" rules="required|email" v-slot="{ errors }">
                                                    <input type="email" name="email" id="email" class="form-control" v-model="socio.email" 
                                                    :class="{'is-invalid': errors[0] }" maxlength="50">

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ errors[0] }}</strong>
                                                    </span>
                                                </ValidationProvider>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="website">Sitio web</label>
                                                <ValidationProvider name="website" rules="" v-slot="{ errors }">
                                                    <input type="text" name="website" id="website" class="form-control" v-model="socio.website"
                                                    :class="{'is-invalid':errors[0]}" maxlength="50">

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ errors[0] }}</strong>
                                                    </span>
                                                </ValidationProvider>
                                            </div>
                                            <div class="form-group col-md 4">
                                                <label for="name_contact">Nombre del Contacto</label>
                                                <ValidationProvider name="name_contact" rules="required" v-slot="{ errors }">
                                                    <input type="text" name="name_contact" id="name_contact" class="form-control" v-model="socio.name_contact"
                                                    :class="{ 'is-invalid':errors[0] }" maxlength="50">

                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ errors[0] }}</strong>
                                                    </span>
                                                </ValidationProvider>
                                            </div>
                                        </div>
                                    </v-container>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <button type="button" class="btn btn-light mx-2" @click="close">Close</button>
                                    <button type="submit" class="btn btn-primary text-white">Guardar</button>
                                </v-card-actions>
                            </form>
                        </ValidationObserver>
                    </v-card>
                </v-dialog>
            </v-row>
        </template>
</div>
</template>

<script>
import { required, email, max } from 'vee-validate/dist/rules'
import { extend, setInteractionMode } from 'vee-validate'

extend('required', {
  ...required,
  message: 'Este campo es requerido',
})

extend('rfc',rfc =>{
  var patt = new RegExp("^[A-Z,Ñ,&]{3,4}[0-9]{2}[0-1][0-9][0-3][0-9][A-Z,0-9]?[A-Z,0-9]?[0-9,A-Z]?$");
  return patt.test(rfc)
})
extend('max', {
  ...max,
  message: '{_field_} may not be greater than {length} characters',
})
extend('email', {
  ...email,
  message: 'Email no es valido',
})

export default {
    props:{
        'list_socios':{}
    },
    data: () =>({
        socio: {idCompanies: 0, RFC: '', name: '', phone1:'', phone2:'', email:'', website:'', name_contact: '', idUser:0},
        dialog: false,
        indexArray: 0,
        listSocios: []
    }),
    mounted(){
        this.listSocios = this.list_socios
    },
    methods:{
        open(item, index){
            this.dialog = true

            this.socio.idCompanies = item.idCompanies
            this.socio.idUser = item.idUser
            this.socio.RFC = item.RFC
            this.socio.name = item.name
            this.socio.name_contact = item.name_contact
            this.socio.phone1 = item.phone1
            this.socio.phone2 = item.phone2
            this.socio.website = item.website
            this.socio.email = item.email

            this.indexArray = index
        },
        close(){
            this.dialog = false

            this.socio.idCompanies = 0
            this.socio.idUser = 0
            this.socio.RFC = ''
            this.socio.name = ''
            this.socio.name_contact = ''
            this.socio.phone1 = ''
            this.socio.phone2 = ''
            this.socio.website = ''
            this.socio.email = ''

            this.indexArray = 0
        },
        editSocio(){
            const formdata = new FormData();
            formdata.append('idcompanies', this.socio.idCompanies)
            formdata.append('user', this.socio.idUser)
            formdata.append('RFC', this.socio.RFC)
            formdata.append('name', this.socio.name)
            formdata.append('name_contact', this.socio.name_contact)
            formdata.append('phone1', this.socio.phone1)
            formdata.append('phone2', this.socio.phone2)
            formdata.append('website', this.socio.website)
            formdata.append('email', this.socio.email)
            formdata.append('_method','PUT')

            axios.post('/socios/'+this.socio.idCompanies, formdata)
            .then( res => {
                const respuesta = res.data

                toastr.options.closeButton = true;
                toastr.options.escapeHtml = true;
                toastr.options.progressBar = true;
                toastr.success(respuesta.messageDB,respuesta.messageHeader,{timeOut :  15000});
                
                this.dialog = false 
                Object.assign(this.listSocios[this.indexArray], this.socio)
            })
            .catch( err => {
                console.log(err.response)
            })
        } 
    },
}
</script>

<style>

</style>