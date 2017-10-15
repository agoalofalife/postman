import Vue from 'vue/dist/vue.js';
import axios from 'axios'
import App from './components/App.vue';
import ElementUI from 'element-ui'
import lang from 'element-ui/lib/locale/lang/en'
import locale from 'element-ui/lib/locale'
import VueHtml5Editor from 'vue-html5-editor'

Vue.use(VueHtml5Editor, {
    name: "vue-html5-editor",
    // if set true,will append module name to toolbar after icon
    showModuleName: true,
    // config image module
    image: {
        //   max file size
        sizeLimit: 512 * 1024,
        // upload config,default null and convert image to base64
        upload: {
            url: null,
            headers: {},
            params: {},
            fieldName: {}
        },
        // compression config,default resize image by localResizeIMG (https://github.com/think2011/localResizeIMG)
        // set null to disable compression
        compress: {
            width: 1600,
            height: 1600,
            quality: 80
        },
        // handle response data，return image url
        uploadHandler(responseText){
            //default accept json data like  {ok:false,msg:"unexpected"} or {ok:true,data:"image url"}
            var json = JSON.parse(responseText)
            if (!json.ok) {
                alert(json.msg)
            } else {
                return json.data
            }
        }
    },
    //default en-us, en-us and zh-cn are built-in
    language: "en-us",
    // the modules you don't want
    hiddenModules: [
        "full-screen",
        "info",
        "undo",
    ],
    // keep only the modules you want and customize the order.
    // can be used with hiddenModules together
    visibleModules: [
        "text",
        "color",
        "font",
        "align",
        "list",
        "link",
        "unlink",
        "tabulation",
        "image",
        "hr",
        "eraser",
    ],
    // extended modules
    modules: {
        //omit,reference to source code of build-in modules
    }
});
locale.use(lang);
Vue.use(ElementUI);
Vue.prototype.$http = axios.create();

new Vue({
    el: '#root',
    data() {
        return {
            showModal: false
        }
    },
    render: h => h(App),
});