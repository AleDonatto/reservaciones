<template>
    <div class="" v-if="misReservaciones>0">
        <h3>Mis Reservaciones</h3>
        <div class="contenedor">
            <div class="card mb-3" style="max-width: 500px;" v-for="(item, index) in misReservaciones" :key="index">
                <div class="row no-gutters">
                    <div class="col-md-4 text-center">
                        <i class="far fa-calendar-alt fa-10x"></i>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ item.nameUnit }}</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            misReservaciones:[]
        }
    },
    created(){
        axios.get('/getLitsReservaciones')
        .then(res =>{
            this.misReservaciones = res.data
        })
        .catch(err =>{
            console.log(err.response)
        });
    }
}
</script>

<style>

</style>