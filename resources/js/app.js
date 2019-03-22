
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('tennis_court-component', require('./components/TennisCourtComponent.vue').default);
Vue.component('favorite_button-component', require('./components/FavoriteButtonComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
    strict: process.env.NODE_ENV !== 'production'
});
/*
var favoriteButton = new Vue({
    el: '#favorite_button',
    data: {
        training_id: null,
        canPush: false,
        isFavorite: false
    },
    methods: {
        switch_favorite: function ($training_id) {
            if(this.isFavorite){
                this.isFavorite = !this.isFavorite;

                axios({
                    method: 'DELETE',
                    url: location.protocol + '//' + location.host + '/favorite',
                    data: {
                        training_id: this.training_id
                    }
                }).then(response => {
                  }).catch(error => {
                    this.isFavorite = !this.isFavorite;
                    console.log(error);
                  });
            }else{
                this.isFavorite = !this.isFavorite;

                axios({
                    method: 'POST',
                    url: location.protocol + '//' + location.host + '/favorite/store',
                    data: {
                        training_id: this.training_id
                    }
                }).then(response => {
                  }).catch(error => {
                    this.isFavorite = !this.isFavorite;
                    console.log(error);
                  });
            }
        }
    },
    mounted() {
        var favorite_button = document.getElementById('favorite_button');
        if(favorite_button !== null)
        {
            this.training_id = favorite_button.getAttribute('value');
        }
        axios
            .get(location.protocol + '//' + location.host + '/favorite/show/' + this.training_id)
            .then(
                response => {
                    console.log(this.training_id);
                    console.log(response);
                    this.isFavorite = response.data.isFavorite;
                    this.canPush = true;
                    this.visible = true;
                }
            );

    }
});*/
