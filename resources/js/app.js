/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
//import VuewSeetalert2 from 'vue-sweetalert2'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//comentamos el ejemplo 
//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
//Se agrega para las alertas con Vue para eliminar recetas
Vue.use(VueSweetalert2);
//console.log(Vue.prototype);
//Aqui trabajamos trix-editor 
//Cuando se trabaja  en esta esta parte de vue se debe de tener habilitad el  npm run watch  que escuche los cmabios  
Vue.config.ignoredElements = ['trix-editor','trix-toolbar'];
Vue.component('fecha-receta',require('./components/FechaReceta.vue').default);
Vue.component('eliminar-receta', require('./components/EliminarReceta.vue').default);
Vue.component('like-button', require('./components/LikeButton.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
// jQuery-- Lo vamos a quitar por ue usa jquey, y lo vamos hacer con Vue
$('.like-btn').on('click', function() {
    $(this).toggleClass('like-active');
 });
 
