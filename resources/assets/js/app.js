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


Vue.config.debug = true;
const dev=true;


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
import ALoading from './components/a-components/a-loading/a-loading.vue';
Vue.component('a-loading', ALoading);




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

	if(to.name==='login'){
		sessionStorage.clear();
	}



	var menu=[];
	var menuSession=JSON.parse(sessionStorage.getItem('menu'));
	const authUser=sessionStorage.getItem('id_token');


	if(menuSession){
		menu=menuSession;
	}

	var existInMenu=false;

	if(to.meta.requiresAuth){

		if(menu.length>0){
			for (var i = 0; i < menu.length; i++) {

				if(to.name==menu[i].name){

					existInMenu=true;
					break;

				}
			}

			if(authUser && existInMenu){

				next();

			}else if(authUser && !existInMenu){

				next({
					name: 'dashboard'
				});

			}


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
		locale: 'es',
		logged: false,
		loading: false
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
		},
		loading: function(){
			var load=sessionStorage.getItem('loading');

			if(load==true){
				return true;
			}else{
				return false;
			}

		}

	},
	mounted: function(){
		sessionStorage.setItem('loading', false);

	}
}).$mount('#app');
