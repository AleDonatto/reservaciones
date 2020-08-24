<template>

    <div class="card w-75">
        <div class="card-body">
            <div v-if="bookings == 0">
                <h5 class="card-title">Reservaciones</h5>
                <p class="card-text">No hay reservaciones hasta el momento</p>
            </div>
            <div class="" v-else>
                <h5 class="card-title">Card title</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Button</a>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    props:{
        'bookings':{}
    },
    data(){
        return {

        }
    }
}
</script>

<style>

</style>