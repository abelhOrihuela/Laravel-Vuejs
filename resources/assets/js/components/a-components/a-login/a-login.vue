<script>

import constants from '../../js/constants_restful.js';
import Toast from 'vue-toast-mobile';

import { apiRoot } from '../../js/constants_restful.js';



export default{

  template: require('./a-login.html'),

  props:{
    todos: Array
  },

  data: function(){
    customer:{

    }

    admin:{

    }


    return {

      admin:{
        email: "",
        password: "",
        authenticated: false

      },
      customer: {
        email: "",
        password: "",
        authenticated: false
      }

    }

  }
  ,

  http: {
    root: apiRoot,
    headers: {
      'X-CSRF-TOKEN' : document.querySelector('#token').getAttribute('value')
    }
  },
  ready: function(){


  },
  methods:{

    /*function: fetchImageProfile
    *
    * Get image profile
    *
    */
    fetchImageProfile: function(){

      var resource= this.$resource('user');


      resource.get().then((response) => {

        this.todos=response.body;

      });

    },


    /*function: loginAdmin
    *
    * Init session admin
    *
    */
    loginAdmin: function(){

      var resource= this.$resource();
      var admin =this.admin;

      this.$http.post('admin/login', admin)
      .then(function(response){

        if(response.body.token!=undefined){
          localStorage.setItem('id_token', response.body.token);
          this.admin.authenticated=true;
          this.admin.password= "";

          var router= this.$router;
          router.push({name: 'candidates'});
          Toast({
            message: 'Welcome',
            position: 'success',
            iconClass: 'glyphicon glyphicon-ok',
            duration: 4000
          });


        }else if(response.body.password_incorrect){

          Toast({
            message: 'nada',
            position: 'warning',
            duration: 4000,
            iconClass: 'glyphicon glyphicon-remove',
          });

        }


      }, function (error){

        Toast({
          message: 'nada',
          position: 'error',
          duration: 4000,
          iconClass: 'glyphicon glyphicon-remove',
        });

      });


    },


    /*function: loginCustomer
    *
    * Init session admin
    *
    */
    loginCustomer: function(){

      var resource= this.$resource('customer/login');
      var candidate= this.


      resource.post(candidate).then((response) => {

        this.todos=response.body;

      });

    }


  }


}

</script>
