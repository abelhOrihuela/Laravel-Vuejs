var Vue = require('vue/dist/vue.js');
var VueRouter = require('vue-router/dist/vue-router.js');
var VueResource = require('vue-resource/dist/vue-resource.js');

Vue.use(VueRouter);
Vue.use(VueResource);

export default {
    user: {
        authenticated: false,
        profile: null,
        perfil: null
    },

    
    
    check() {
        if (localStorage.getItem('id_token') !== null) {
            this.http.get(
                'api/user',
                ).then(response => {
                    this.user.authenticated = true
                    this.user.profile = response.data.data
                })
            }
        },
        signin(context, profile, email, password) {
         console.log("Signin auth");
         console.log(profile);
         console.log(email);
         console.log(password);
         console.log("------------");

         if(profile){
            this.signinAdmin(email, password);
        }else{
            this.signinCustomer(email, password);
        }

    },

    signinAdmin(email, password){
        console.log("Signin admin");

        console.log(email);
        console.log(password);

        var admin ={
            email:email,
            password:password
        }

        Vue.http.headers={
        'X-CSRF-TOKEN' : document.querySelector('#token').getAttribute('value')
      }
    


        Vue.http.post(
            'api/admin/login',
            {
                name: name,
                email: email,
                password: password
            }
        ).then(response => {
            context.success = true
        }, response => {
            context.response = response.data
            context.error = true
        })




    },
    signinCustomer(email, password){
       console.log("Signin customer");

       console.log(email);
       console.log(password);

   },


   signout() {

   },
   register(context, profile, name, email, password) {

   },

}