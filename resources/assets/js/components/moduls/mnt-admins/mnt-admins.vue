<script>
/*
*Config module
*/
import { translations } from '../../js/translations.js';
import { tableAdmins } from '../../js/config-app/tables.js';
import  runblock  from '../../js/runblock.js';


/*
*Constants
*/
import { ADMINS, USER_PERMISSIONS } from '../../js/constants_restful.js';

/*
*Components
*/

import  ATable from '../../a-components/a-table/a-table.vue';




export default{
  /*--Tenplate--*/

  template: require('./mnt-admins.html'),

  /*--Mixins--*/

  mixins: [
    require('vue-i18n-mixin')
  ],

  /*--Translate--*/

  translations: translations,

  /*--Properties--*/

  props:{

  },

  /*--Components--*/

  components:{
    'a-table': ATable

  },

  /*Data
  *All properties of module
  */

  data: function(){
    return {
      admins: [],
      permissions: {},
      columns: tableAdmins,
      searchQuery:'',
      flagTable: true,
      flagDetailSelected: false,
      adminSelected: {},
      adminCandidatesRegisters:0,
      locale: 'es'
    }

  },

  http: {
    root: '/api',
    headers: {
      'X-CSRF-TOKEN' : document.querySelector('#token').getAttribute('value')
    }
  },
  attached() {
        this.resetOptions()
      },

  methods:{

    /*function: fetchImageProfile
    *
    * Get image profile
    *
    */
    getAdmins: function(){
      var resource= this.$resource(ADMINS);
      resource.get().then((response) => {
        this.admins=response.body;
      });
    },
    select: function(entry){
      this.adminSelected=entry;
      this.flagTable=false;
      this.flagDetailSelected=true;
    },
    showTable: function(){
      this.adminSelected={};
      this.flagTable=true;
      this.flagDetailSelected=false;
    },
    getPermissions: function(){

      var user=runblock.getUserSession();

      var resource=this.$http.post(USER_PERMISSIONS, user);
      resource.then(function(response){
        this.permissions=response.body;
      }, function (error){
        service.showError(this, error);
      });
    }
  },
  created: function(){
    this.getAdmins();
    this.getPermissions();
  },
  ready: function() {
  },
}
</script>
