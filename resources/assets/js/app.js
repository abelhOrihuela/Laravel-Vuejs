/**
*Created by AbelOrihuelaMendoza
*29/10/2016
*/

/*------------------------------INIT -----------------------------------*/

var Vue = require('vue/dist/vue.js');
var VueRouter = require('vue-router/dist/vue-router.js');
var VueResource = require('vue-resource/dist/vue-resource.js');

Vue.use(VueRouter);
Vue.use(VueResource);




/*----------------------------IMPORT MODULS-----------------------------*/

import MntAdmins from './components/moduls/mnt-admins/mnt-admins.vue';
/*------------------------IMPORT A COMPONENTS---------------------------*/


import ALogin from './components/a-components/a-login/a-login.vue';


/*------------------------------ ROUTER --------------------------------*/
/*It was great to see everyone--fue genial verlos a todos*/


const router = new VueRouter({
	mode: 'hash',
	routes :[{
		path: '/',
		component: ALogin
	},
	{
		path: '/about',
		component: MntAdmins
	},
	{
		path: '/admins',
		component: MntAdmins
	},
	{
		path: '*',
		redirect: '/'
	}]
})


/*------------------------------- DEFINE APP -------------------------------------*/

const app = new Vue({
  router,
  data:{
  	message: "Keytalent"
  }
}).$mount('#app')







