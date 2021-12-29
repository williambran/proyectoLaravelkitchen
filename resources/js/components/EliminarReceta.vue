<template>
        <!--v-on:click="eliminarReceta" -->
        <input type="submit" 
        class="btn btn-danger  mr-1" 
        value="Eliminar x"
        @click="eliminarReceta"
        > 

</template>

<script>
export default {
    props: ['recetaId'],
    mounted() {
        console.log('receta actual', this.recetaId);
    },
    methods:{
        eliminarReceta(){
            this.$swal({
                title: 'Deseas eliminar esta receta?',
                text:'Una vez eliminada, no se puede recuperar',
                icon:'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                canceñButtonText: 'No'
            }).then((result)=> {
                
                if(result.value) {


                    const params = {
                        id: this.recetaId   
                    }

                    axios.post(`/recetas/${this.recetaId}`, {params, _method: 'delete'})
                    .then(respuesta => {
                    this.$swal({
                        title: 'Probando Alerta',
                        text: 'Funciona Bien',
                        icon: 'success'
                    })

                    //Eliminar del DOM, se tiene que ir al padre superior (body) y borrar desde ahi
                    console.log(this.$el);
                    this.$el.parentNode.parentNode.parentNode .removeChild(this.$el.parentNode.parentNode);


                    })
                    .catch(error=> {
                        console.log(error)
                    })
                        

                }
            })


            //Enviar la peticion al servidor


        }
    }
}
</script>