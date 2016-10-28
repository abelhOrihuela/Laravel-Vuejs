var Vue = require('vue/dist/vue.js');

var VueResource = require('vue-resource/dist/vue-resource.js');
var VueRouter = require('vue-router/dist/vue-router.js');


Vue.use(VueResource);
Vue.use(VueRouter);

const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>bar</div>' }


const routes = [
  { path: '/foo', component: Foo },
  { path: '/bar', component: Bar }
]


const router = new VueRouter({
  routes // short for routes: routes
})


const app = new Vue({
  router,
  data:{
  	message: "Keytalent"
  }
}).$mount('#app')






