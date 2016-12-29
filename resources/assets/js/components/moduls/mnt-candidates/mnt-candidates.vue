<script>
/*-----------------------------------------------------------*/
import ATable from '../../a-components/a-table/a-table.vue';
import AddCandidate from './add-candidate/add-candidate.vue';
import AddPhoto from '../../a-components/add-photo/add-photo.vue';


import MntExperience from '../../moduls/mnt-experience/mnt-experience.vue';
import MntAcademic from '../../moduls/mnt-academic/mnt-academic.vue';
import MntExperienceWtc from '../../moduls/mnt-experiencewtc/mnt-experiencewtc.vue';
//'../../mnt-experience/mnt-experience.vue';


import  service  from '../../js/utilities/service.js';
import  filter  from '../../js/utilities/filters.js';

import { HTTP, candidates, candidates_experince } from '../../js/constants_restful.js';
import { translations } from '../../js/translations.js';
import { tableCandidates , tableExperience} from '../../js/config-app/tables.js';


export default{
  /*TEMPLATE*/
  template: require('./mnt-candidates.html'),
  /*RESOURCE HTTP*/
  http:HTTP,
  /*TRANSLATIONS*/
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  /*PROPERTIES*/
  props:{},
  /*COMPONENTS*/
  components:{
    'a-table': ATable,
    'add-candidate': AddCandidate,
    'add-photo': AddPhoto,
    'mnt-experience': MntExperience,
    'mnt-experiencewtc': MntExperienceWtc,
    'mnt-academic': MntAcademic
  },
  filters:{
    trueOrFalse: function(value){
      console.log(value);
      return filter.trueOrFalse(this,value);
    }
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
      showModalPhoto: false,
      optionTab: 1,
      experienceSelect:{}

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
      this.optionTab= 1;
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
    },
    selectTab: function(option){
      this.optionTab=option;

    },
    downloadPdf: function(){

      var $id=this.candidateSelected.id;

      var resource= this.$resource('pdf{/id}');
      resource.get({id : $id }).then(function(response){

        console.log(response);

        var link = document.createElement("a");
        link.download = "PDF";
        link.href = "../my_stored_file.pdf";
        link.click();


      }, function(error){

      });

    }
  },
  created: function(){
    this.getAdmins();
  },
}
</script>
