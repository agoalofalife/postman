import Vue from 'vue';
import axios from 'axios'
import router from './router/';
import App from './components/App.vue';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-default/index.css'
import lang from 'element-ui/lib/locale/lang/en'
import locale from 'element-ui/lib/locale'

// configure language
locale.use(lang)
Vue.use(ElementUI);
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