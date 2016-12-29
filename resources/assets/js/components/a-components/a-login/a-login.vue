<script>


import Toast from 'vue-toast-mobile';

import { HTTP} from '../../js/constants_restful.js';
import  service  from '../../js/utilities/service.js';



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

  http: HTTP,
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
          service.showSuccess(this, 'Welcome');


        }else if(response.body.password_incorrect){

          service.showWarning(this, 'Password Incorrect ! ');

        }


      }, function (error){

        service.showError(this, 'User not exist ! ');

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
