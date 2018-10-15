
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('form-component', require('./components/FormComponent.vue'));

const app = new Vue({
    el: '#app',
    data() {
        return {
            form: new Form({
                name: '',
                description: '',
                price: ''
            })
        }
    },
    methods: {
        onSubmit() {
            this.form.post('/products')
                .then(response => alert('Success'))
                .catch(error => {
                    console.log(error.response.data);
                })
        }
    }
});