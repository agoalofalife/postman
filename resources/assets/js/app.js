import Vue from 'vue/dist/vue.js';
import axios from 'axios'
import App from './components/App.vue';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-default/index.css'
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
    i18n: {
        //specify your language here
        // "zh-cn": {
        //     "align": "对齐方式",
        //     "image": "图片",
        //     "list": "列表",
        //     "link": "链接",
        //     "unlink": "去除链接",
        //     "table": "表格",
        //     "font": "文字",
        //     "full screen": "全屏",
        //     "text": "排版",
        //     "eraser": "格式清除",
        //     "info": "关于",
        //     "color": "颜色",
        //     "please enter a url": "请输入地址",
        //     "create link": "创建链接",
        //     "bold": "加粗",
        //     "italic": "倾斜",
        //     "underline": "下划线",
        //     "strike through": "删除线",
        //     "subscript": "上标",
        //     "superscript": "下标",
        //     "heading": "标题",
        //     "font name": "字体",
        //     "font size": "文字大小",
        //     "left justify": "左对齐",
        //     "center justify": "居中",
        //     "right justify": "右对齐",
        //     "ordered list": "有序列表",
        //     "unordered list": "无序列表",
        //     "fore color": "前景色",
        //     "background color": "背景色",
        //     "row count": "行数",
        //     "column count": "列数",
        //     "save": "确定",
        //     "upload": "上传",
        //     "progress": "进度",
        //     "unknown": "未知",
        //     "please wait": "请稍等",
        //     "error": "错误",
        //     "abort": "中断",
        //     "reset": "重置"
        // }
    },
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