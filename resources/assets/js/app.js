import Vue from 'vue';
import axios from 'axios'
import router from './router/';
import App from './components/App.vue';

Vue.prototype.$http = axios.create();

new Vue({
    el: '#root',
    router,
    /**
     * The component's data.
     */
    data() {
        return {
            showModal: false
        }
    },

    render: h => h(App),
});