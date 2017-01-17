/**
*Created by AbelOrihuelaMendoza
* abelorihuelamendoza@hotmail.com
*29/10/2016
*/

/*------------------------------INIT -----------------------------------*/

var Vue = require('vue/dist/vue.js');
var VueRouter = require('vue-router/dist/vue-router.js');
var VueResource = require('vue-resource/dist/vue-resource.js');

var VueFilter = require('vue-filter/dist/vue-filter');
Vue.use(VueFilter);
Vue.use(VueRouter);
Vue.use(VueResource);

Vue.config.debug = false;

const dev=true;

import moment from 'moment'



/*----------------------------IMPORT MODULS-----------------------------*/

import MntAdmins from './components/moduls/mnt-admins/mnt-admins.vue';
Vue.component('mnt-admins', MntAdmins);
import MntCandidates from './components/moduls/mnt-candidates/mnt-candidates.vue';
Vue.component('mnt-candidates', MntCandidates);
import ALogin from './components/a-components/a-login/a-login.vue';
Vue.component('a-login', ALogin);
import AMenu from './components/a-components/a-menu/a-menu.vue';
Vue.component('a-menu', AMenu);
import MntGroups from './components/moduls/mnt-groups/mnt-groups.vue';
Vue.component('mnt-groups', MntGroups);
import MntCustomers from './components/moduls/mnt-customers/mnt-customers.vue';
Vue.component('mnt-customers', MntCustomers);

import Dashboard from './components/moduls/dashboard/dashboard.vue';
Vue.component('dashboard', Dashboard);




/*------------------------------ ROUTER --------------------------------*/
/*It was great to see everyone--fue genial verlos a todos*/

const routes =[{
	path: '/',
	component: ALogin,
	name: 'login',
},
{
	path: '/dashboard',
	component: Dashboard,
	name: 'dashboard',
	meta: { requiresAuth: true }
},
{
	path: '/candidates',
	component: MntCandidates,
	name: 'candidates',
	meta: { requiresAuth: true }
},
{
	path: '/admins',
	component: MntAdmins,
	name: 'admins',
	meta: { requiresAuth: true }
},
{
	path: '/customers',
	component: MntCustomers,
	name: 'customers',
	meta: { requiresAuth: true }
},
{
	path: '/groups',
	component: MntGroups,
	name: 'groups',
	meta: { requiresAuth: true }
},
{
	path: '*',
	redirect: '/'
}]

const router = new VueRouter({
	mode: 'hash',
	routes
})

router.beforeEach((to, from, next)=>{

	if(to.meta.requiresAuth){

		const authUser=sessionStorage.getItem('id_token');

		if(authUser){

			next();

		}else{

			next({
				name: 'login'
			});

		}
	}else{
		next();
	}
});

/*------------------------------- DEFINE APP -------------------------------------*/

const app = new Vue({

	config:{
		silent : !dev,
		debug: !dev
	}
	,
	mixins: [
		require('vue-i18n-mixin')
	],
	router,
	data:{
		message: 'Keytalent',
		locale: 'en',
		logged: false,
	},
	translations: {

	},
	methods: {
		loggedUser: function(){

			const authUser=sessionStorage.getItem('id_token');

			if(authUser){
				return true;
			}

			return false;
		}
	}
}).$mount('#app');
