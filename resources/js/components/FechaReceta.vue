<template>
<span v-text="formatearFecha" ></span>
</template>


<script>
export default {
props: ['fecha'],

    //Este metodo es una vez que el comoponente esta lito y se puede ver 
    mounted() {
        console.log('La fecha es', this.fecha);
    },

//esto estara reacionando a los cambios que haya en la vista
    computed:{
        //esta funcion se le pasara al templete de vue, y que asu vez estara tomando los valores en la vista show.blade
        formatearFecha(){
            return moment(this.fecha).locale('es').format('DD [de] MMM [del] YYYY')
        }
    }
}
</script>