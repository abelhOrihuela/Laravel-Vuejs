    <script>

      import ATable from '../../a-components/a-table/a-table.vue';
      import { candidates } from '../../js/constants_restful.js';


      export default{

        props:{
          admins: Array,
          columns: Array
        },
        components:{
          'a-table': ATable

        },

        data: function(){
         return {
searchQuery: ''
        }

      },
      

      http: {
        root: '/api',
        headers: {
          'X-CSRF-TOKEN' : document.querySelector('#token').getAttribute('value')
        }
      },

      methods:{

          /*function: fetchImageProfile
          *
          * Get image profile
          *
          */
          getAdmins: function(){

            this.columns= ['username', 'position', 'email', 'created_at'];

            var resource= this.$resource(admins);

            resource.get().then((response) => {

              this.admins=response.body;

            });

          }
        },

        created: function(){


          this.getAdmins();
          
          
        },


        
      }

    </script>
