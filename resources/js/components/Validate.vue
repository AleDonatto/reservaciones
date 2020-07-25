<template>
    <div class="invalid-feedback">
        <!--<span v-show="errors_form.has(attribute_name)" class="red-text"> 
            {{ errors_form.fist(attribute_name) }}
        </span> Please provide a valid city.-->
    </div>
</template>

<script>

export default {
    props: ['attribute_name', 'errors_form']
}
</script>