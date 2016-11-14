<script>

  import ATable from '../../a-components/a-table/a-table.vue';
  import { candidates, candidates_experince } from '../../js/constants_restful.js';
  import { translations } from '../../js/translations.js';


  export default{

    template: require('./mnt-candidates.html'),
    translations: translations,
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
        searchQuery: '',
        experiences: [],
        candidates: [],
        columns: this.columns= [
        {label: "username", key: 'username' },
        {label: "position", key: 'position'},
        {label: "email", key: 'email'},
        {label: "created_at", key: 'created_at'},
        {label: "updated_at", key: 'updated_at'}],
        flagTable: true,
        flagDetailSelected: false,
        locale: 'es'
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
  var resource= this.$resource(candidates);
  resource.get().then((response) => {
    this.candidates=response.body;
  });

},
getExperience: function(id){
  var resource= this.$resource(candidates_experince);
  resource.get({id: id}).then((response) => {
    this.experiences=response.body;
  });
}
,
select: function(entry){
  //this.getExperience(entry.id);

  this.candidateSelected=entry;
  this.flagTable=false;
  this.flagDetailSelected=true;

},
showTable: function(){
  this.candidateSelected={};
  this.flagTable=true;
  this.flagDetailSelected=false;
},
},

created: function(){


  this.getAdmins();


},
}
</script>
