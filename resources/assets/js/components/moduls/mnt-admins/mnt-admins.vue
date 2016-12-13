<script>
/*
*Config module
*/
import { translations } from '../../js/translations.js';
import { tableAdmins } from '../../js/config-app/tables.js';

/*
*Constants
*/
import { admins, candidates_admin } from '../../js/constants_restful.js';

/*
*Components
*/

import  ATable from '../../a-components/a-table/a-table.vue';
import VueToast from 'vue-toast'



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
    'a-table': ATable,
     'vue-toast': VueToast

  },

  /*Data
  *All properties of module
  */

  data: function(){
    console.log(VueToast);
    return {
      admins: [],
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
      var resource= this.$resource(admins);
      resource.get().then((response) => {
        this.admins=response.body;
      });
    },
    select: function(entry){
      this.candidates(entry.id);
      this.adminSelected=entry;
      this.flagTable=false;
      this.flagDetailSelected=true;
    },
    candidates: function(id){
      var resource= this.$resource(candidates_admin);
      resource.get({id : id }).then((candidates) => {
        this.adminCandidatesRegisters=candidates.body.candidates;
      });
    },
    showTable: function(){
      this.adminSelected={};
      this.flagTable=true;
      this.flagDetailSelected=false;
    }
  },
  created: function(){
    this.getAdmins();
  },
  ready: function() {
  },
}
</script>
