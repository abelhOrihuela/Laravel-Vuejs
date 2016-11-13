<script>

  import ATable from '../../a-components/a-table/a-table.vue';
  import { admins, candidatesAdmin } from '../../js/constants_restful.js';

  import { translations_mnt_admins } from '../../js/translations.js';



  export default{


    template: require('./mnt-admins.html'),
    mixins: [
    require('vue-i18n-mixin')
    ],
    props:{

    },
    components:{
      'a-table': ATable

    },

    data: function(){
      return {
        admins: [],
        columns: [],
        searchQuery:'',
        flagTable: true,
        flagDetailSelected: false,
        adminSelected: {},
        adminCandidatesRegisters:0,
        locale: 'es'
      }

    },

    translations: translations_mnt_admins,


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
  this.columns= ['username', 'type', 'email', 'created_at'];
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
  var resource= this.$resource(candidatesAdmin);
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
}
</script>

