<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
        <!--<ValidationProvider rules="even" v-slot="{ errors }">
            <input v-model="value" type="number" placeholder="type something">
            <span>{{ errors[0] }}</span>
        </ValidationProvider>-->
        <!--<ValidationObserver v-slot="{ invalid }">
            <form @submit.prevent="onSubmit">
            <ValidationProvider name="E-mail" rules="required|email" v-slot="{ errors }">
                <input v-model="email" type="email">
                <span>{{ errors[0] }}</span>
            </ValidationProvider>

            <ValidationProvider name="First Name" rules="required|alpha" v-slot="{ errors }">
                <input v-model="firstName" type="text">
                <span>{{ errors[0] }}</span>
            </ValidationProvider>

            <ValidationProvider name="Last Name" rules="required|alpha" v-slot="{ errors }">
                <input v-model="lastName" type="text">
                <span>{{ errors[0] }}</span>
            </ValidationProvider>

            <button type="submit" :disabled="invalid">Submit</button>
            </form>
        </ValidationObserver>-->
    </div>
</template>

<script>

    export default {
        data: () => ({
            value: ''
        }),
        mounted() {
            console.log('Component mounted.');
        }
    }
</script>

