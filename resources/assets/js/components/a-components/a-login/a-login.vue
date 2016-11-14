  <script>

  import constants from '../../js/constants_restful.js';

  import { apiRoot } from '../../js/constants_restful.js';

  

    export default{

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

              console.log(response.body);

              if(response.body.token!=undefined){
                localStorage.setItem('id_token', response.body.token);
                this.admin.authenticated=true;
                this.admin.password= "";

                var router= this.$router;
                router.push({name: 'candidates'});

              }else if(response.body.user_not_exist){

                console.log("User not exist");
              }
              

            }, function (error){

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

  <template>

    <div class="jumbotron">




      <div class="row">
        <div>

          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Admin</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Candidate</a></li>


          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
              <br>
              <div class="col-sm-6">
                <form class="form-horizontal" @submit.prevent="loginAdmin">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" v-model="admin.email"class="form-control" id="inputEmail3" placeholder="Email">
                    </div>

                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password"  v-model="admin.password" class="form-control" id="inputPassword3" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Remember me
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit"  class="btn btn-default">Sign in</button>
                    </div>
                  </div>
                </form>
              </div>

            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
              <br>

              <div class="col-sm-6">
                <form class="form-horizontal" @submit.prevent="fetchImageProfile">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password"  class="form-control" id="inputPassword3" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Remember me
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit"  class="btn btn-default">Sign in</button>
                    </div>
                  </div>
                </form>
              </div>


            </div>

          </div>

        </div>
      </div>
      

    </div>

  </template>
