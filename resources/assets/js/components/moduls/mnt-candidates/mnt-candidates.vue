<script>

import ATable from '../../a-components/a-table/a-table.vue';
import AddCandidate from './add-candidate/add-candidate.vue';
import AddPhoto from '../../a-components/add-photo/add-photo.vue';
import  service  from '../../js/utilities/service.js';




import Toast from 'vue-toast-mobile';
import { candidates, candidates_experince } from '../../js/constants_restful.js';
import { translations } from '../../js/translations.js';
import { tableCandidates , tableExperience} from '../../js/config-app/tables.js';


export default{

  template: require('./mnt-candidates.html'),
  translations: translations,
  mixins: [
    require('vue-i18n-mixin')
  ],
  props:{

  },

  components:{
    'a-table': ATable,
    'add-candidate': AddCandidate,
    'add-photo': AddPhoto

  },

  data: function(){
    return {
      searchQuery: '',
      experiences: [],
      candidates: [],
      columns: tableCandidates,
      columnsExperience: tableExperience,
      flagTable: true,
      flagDetailSelected: false,
      locale: 'es',
      showModal: false,
      showNewCandidate: false,
      showPersonalInformation: false,
      showModalPhoto: false
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
    select: function(data){

      this.candidateSelected=data;
      this.flagTable=false;
      this.flagDetailSelected=true;
    },
    showTable: function(){
      this.candidateSelected={};
      this.flagTable=true;
      this.flagDetailSelected=false;
    },
    addCandidate: function(){
      this.flagTable=false;
      this.flagDetailSelected=false;
      this.showNewCandidate=true;

    },
    cancelAddCandidate:  function(){
      this.flagTable=true;
      this.flagDetailSelected=false;
      this.showNewCandidate=false;
    },
    getNewCandidate: function(data){
      this.candidates.push(data);
      this.showNewCandidate=false;
      this.select(data);
    },
    getPhoto: function(data, status){
      this.showModalPhoto=false;
      this.candidateSelected.photo=data;

      service.showSuccess(this, 'Operacion Exitosa');
    },
    getCandidateId: function($id, update){

      var resource= this.$resource('candidate{/id}');
      resource.get({id : $id }).then(function(response){
        if(update){
          var index=service.getIndiceObject(this, this.candidates, 'id', response.body.id );
          if(index>-1){

          }
        }else{
        }
      }, function(error){

      });
    }
  },
  created: function(){
    this.getAdmins();
  },
}
</script>
