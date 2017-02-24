<script>
import AddPhoto from '../../a-components/add-photo/add-photo.vue';
import AddCandidate from '../../moduls/mnt-candidates/add-candidate/add-candidate.vue';
import MntExperience from '../../moduls/mnt-experience/mnt-experience.vue';
import MntAcademic from '../../moduls/mnt-academic/mnt-academic.vue';
import MntExperienceWtc from '../../moduls/mnt-experiencewtc/mnt-experiencewtc.vue';
import MntEconomic from '../../moduls/mnt-economic/mnt-economic.vue';
import AddCandidateToGroup from '../../moduls/mnt-groups/add-candidate-to-group/add-candidate-to-group.vue';
import MntLanguages from '../../moduls/mnt-languages/mnt-languages.vue';
import MntIdioms from '../../moduls/mnt-idioms/mnt-idioms.vue';
import  runblock  from '../../js/runblock.js';
import { translations } from '../../js/translations.js';
import  service  from '../../js/utilities/service.js';
import  filter  from '../../js/utilities/filters.js';
import { HTTP, EXPERIENCE, ACADEMIC, EXPERIENCEWTC, ECONOMIC, USER_PERMISSIONS } from '../../js/constants_restful.js';
import { tableCandidates , tableExperience} from '../../js/config-app/tables.js';


export default{
  /*TEMPLATE*/
  template: require('./a-candidate.html'),
  /*RESOURCE HTTP*/
  http:HTTP,
  /*TRANSLATIONS*/
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  /*PROPERTIES*/
  props:{
    candidate: Object,
    show: Function
  },
  /*COMPONENTS*/
  components:{
    'add-candidate': AddCandidate,
    'add-photo': AddPhoto,
    'mnt-experience': MntExperience,
    'mnt-experiencewtc': MntExperienceWtc,
    'mnt-academic': MntAcademic,
    'mnt-economic': MntEconomic,
    'add-candidate-to-group': AddCandidateToGroup,
    'mnt-languages': MntLanguages,
    'mnt-idioms': MntIdioms
  },
  filters:{
    trueOrFalse: function(value){
      console.log(value);
      return filter.trueOrFalse(this,value);
    },
    shortDate: function(value){
      console.log(value);
      return filter.shortDate(this,value);
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
      flagAddGroup: false,
      optionTab: 0,
      experienceSelect:{},
      permissions: {}


    }
  },
  methods:{
    select: function(data){


      this.getAcademic(data);
      this.getExperience(data);
      this.getExperienceWtc(data);
      this.getEconomic(data);


      this.flagTable=false;
      this.flagDetailSelected=true;
      this.candidate=data;


      setTimeout(function(){

        this.optionTab= 1;

      });




    },
    showTable: function(){
      console.log("------------------------------------------------");
      this.show()
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
      this.candidate.photo=data;

      service.showSuccess(this, 'Operacion Exitosa');
    },

    selectTab: function(option){
      this.optionTab=option;

    },
    getAcademic: function(candidate){

      var resource= this.$resource(ACADEMIC);
      resource.get({id : candidate.id }).then(function(response){
        candidate.academics=response.body;
        this.optionTab= 1;

      }, function(error){
        service.showError(this, error);

      });

    },
    getExperience: function(candidate){

      var resource= this.$resource(EXPERIENCE);
      resource.get({id : candidate.id }).then(function(response){
        candidate.experiences=response.body;
      }, function(error){
        service.showError(this, error);

      });

    },
    getExperienceWtc: function(candidate){

      var resource= this.$resource(EXPERIENCEWTC);
      resource.get({id : candidate.id }).then(function(response){
        candidate.experiences_wtc=response.body;
      }, function(error){
        service.showError(this, error);

      });

    },
    getEconomic: function(candidate){

      var resource= this.$resource(ECONOMIC);
      resource.get({id : candidate.id }).then(function(response){
        candidate.economic=response.body;


      }, function(error){
        service.showError(this, error);

      });

    },
    addCandidateToGroup: function(){
      this.flagAddGroup=true;
    },
    addGroup: function(entry){

          this.flagAddGroup=false;

    },
    downloadPdf: function(){

      var $id=this.candidate.id;

      var resource= this.$resource('pdf{/id}');
      resource.get({id : $id }).then(function(response){
        var link = document.createElement("a");
        link.download = response.body;
        link.href = "../pdf/"+response.body;
        link.click();

      }, function(error){
        service.showError(this, error);
      });
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
    this.select(this.candidate);
    this.getPermissions();
  },
}
</script>
