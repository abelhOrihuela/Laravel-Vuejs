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








Vue.config.debug = false;




/*----------------------------IMPORT MODULS-----------------------------*/

import MntAdmins from './components/moduls/mnt-admins/mnt-admins.vue';
Vue.component('mnt-admins', MntAdmins);
import MntCandidates from './components/moduls/mnt-candidates/mnt-candidates.vue';
/*------------------------IMPORT A COMPONENTS---------------------------*/
Vue.component('mnt-candidates', MntCandidates);

import ALogin from './components/a-components/a-login/a-login.vue';
Vue.component('a-login', ALogin);

import Asignin from './components/a-components/a-signin/a-signin.vue';






/*------------------------------ ROUTER --------------------------------*/
/*It was great to see everyone--fue genial verlos a todos*/

const routes =[{
	path: '/',
	component: ALogin,
	name: 'home'
},
{
	path: '/candidates',
	component: MntCandidates,
	name: 'candidates'
},
{
	path: '/admins',
	component: MntAdmins
},
{
	path: '*',
	redirect: '/'
}]

const router = new VueRouter({
	mode: 'hash',
	routes
})


/*------------------------------- DEFINE APP -------------------------------------*/

const app = new Vue({

	config:{

      //silent : true,
      //debug: true
	}
	,
	mixins: [
        require('vue-i18n-mixin')
    ],
	router,
	data:{
		message: 'Keytalent',
		locale: 'en'
	},
	translations: {
        header: {
            title: {
                en: 'Hello',
                fr: 'Bonjour'
            }
        }
    }
}).$mount('#app');
