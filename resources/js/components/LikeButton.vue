<template>
<!--la funcion de abajp traera la clase like-active en _like.scss y se vera como me gusta en caso de que this.like traiga algo -->
     <div>
         <span class="like-btn" @click="likeReceta" :class="{'like-active': isActive}" ></span>
         <p> {{cantidadLike}} Me gusta</p>
     </div>
</template>


<script>
export default {
    props: ['recetaId','like','likes'],
    data: function(){  //el data lo podemos llamar desde que se ejecuta el metodo likeReceta() cuando se da click al cor<zon 
        return {
            totalLikes: this.likes,
            isActive: this.like
        }
    },

mounted() {
    console.log(this.like);
},

    methods: {

        likeReceta(){
            const params = {
                id: this.recetaId   
            }
            axios.post(`/recetas/${this.recetaId}`,{params, _method: 'post'})
            .then(respuesta => {
                      console.log(respuesta)
                      //El attached es un atributo de la respuesta que trae algo en su array si le enviamos algo, y en caso de eliminar no trae nada el array (vacio)
                      if(respuesta.data.attached.length > 0){
                          this.$data.totalLikes++;   // this.$data = Para entrrar al data de arriba y en su funcion totalLikes ponerle un incremento
                      }else {
                          this.$data.totalLikes--;
                      }
                     // this.$data.isActive = !this.isActive funciona igual que el de abajo
                     this.isActive = !this.isActive

            })
            .catch(error => {
                console.log(error)
            });
        }
    },
    computed: {
        //son algo estaticos, se usa en conjunto con el data
        cantidadLike: function(){
            return this.totalLikes
        }
    }
}
</script> 