<script>
import Toast from 'vue-toast-mobile';
import { HTTP} from '../../js/constants_restful.js';
import  service  from '../../js/utilities/service.js';
import  runblock  from '../../js/runblock.js';

export default{
  template: require('./a-login.html'),
  props:{
    todos: Array
  },
  computed: {
    validation: function () {
      var emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return {
        email: emailRE.test(this.user.email)
      }
    },
    isValid: function () {
      var validation = this.validation
      return Object.keys(validation).every(function (key) {
        return validation[key]
      })
    }
  },

  data: function(){
    customer:{
    }
    admin:{
    }
    return {
      user:{
        name:"",
        email: "",
        password: "",
        authenticated: false
      },
      flagEmailValid: false
    }
  },
  http: HTTP,
  ready: function(){

  },
  methods:{

    /*function: fetchImageProfile
    *
    * Get image profile
    *
    */
    validateUser: function(){

      this.$http.post('user', this.user)
      .then(function(response){

        runblock.loadProfile(response.body);

        this.flagEmailValid=true;

        var user=response.body;

        this.user.name=user.user;

      },function(){
        service.showError(this, 'User not exist ! ');
      });
    },


    /*function: loginAdmin
    *
    * Init session admin
    *
    */
    loginAdmin: function(){
      var resource=null;
      var admin =this.user;


      var userValid=runblock.getProfile();

      if(userValid==="A"){
        resource=this.$http.post('admin/login', admin);

      }else if (userValid==="C") {

        resource=this.$http.post('customer/login', admin);

      }

      resource.then(function(response){

        if(response.body.token!=undefined){

          sessionStorage.setItem('id_token', response.body.token);
          this.user.authenticated=true;
          this.user.password= "";

          var menu=[];
          var dashboard={
            name: 'dashboard',
            class: 'glyphicon-th-large',
            description: 'Dashboard',
            dashboard:{

            }
          }

          menu.push(dashboard);

          sessionStorage.setItem('menu', JSON.stringify(menu));

          var router= this.$router;

          router.push({name: 'dashboard'});

          service.showSuccess(this, 'Welcome');

          runblock.loadUserSession(response.body);

        }else if(response.body.password_incorrect){
          service.showWarning(this, 'Password Incorrect ! ');
        }
      },
      function (error){
        service.showError(this, 'User not exist ! ');
      });
    },
    clearLogin: function(){
      this.flagEmailValid=false;
      this.user={ name:"", email: "", password: "", authenticated: false
      }
    }
  }
}

</script>
