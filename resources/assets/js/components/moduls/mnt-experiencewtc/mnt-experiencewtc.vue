
<script>
import { translations } from '../../js/translations.js';
import  filter  from '../../js/utilities/filters.js';
import AddExperienceWtc from './add-experiencewtc/add-experiencewtc.vue';
import DeleteExperienceWtc from './delete-experiencewtc/delete-experiencewtc.vue';
import EditExperienceWtc from './edit-experiencewtc/edit-experiencewtc.vue';
import  service  from '../../js/utilities/service.js';
import  runblock  from '../../js/runblock.js';
import { HTTP, EXPERIENCEWTC , USER_PERMISSIONS} from '../../js/constants_restful.js';



export default {
  template: require('./mnt-experiencewtc.html'),
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  http: HTTP,
  data: function(){
    return{
      experienceSelect:null,
      permissions:{},
      experienceOriginal:{},
      showModalEditExperience: false,
      showModalDeleteExperince: false,
      showModalAddExperience: false,
      locale: 'es',
      experiences_wtc:[]
    }
  },
  components:{
    'add-experiencewtc': AddExperienceWtc,
    'edit-experiencewtc': EditExperienceWtc,
    'delete-experiencewtc': DeleteExperienceWtc

  },
  props:{
    candidate: Object
  },
  methods:{
    getExperienceWtc: function(candidate){
      service.loading(true);

      var resource= this.$resource(EXPERIENCEWTC);
      resource.get({id : this.candidate.id }).then(function(response){
        this.experiences_wtc=response.body;
        service.loading(false);

      }, function(error){
        service.showError(this, error);
        service.loading(false);


      });

    },

    editExperience: function(){
      this.showModalEditExperience= true;

    },
    update: function(entry){

      this.getExperienceWtc();

      this.showModalEditExperience= false;
      this.experienceSelect=null;

    },
    deleteExperience: function(){

      this.showModalDeleteExperince=true;

    },
    removeExperince: function(id){
      this.showModalDeleteExperince=false;
      this.getExperienceWtc();


      this.experienceSelect=null;
    },
    addMoreExperience: function(){

      this.showModalAddExperience=true;

    },
    addExperience: function(entry){

      entry.wtc_id=entry.id;
      this.showModalAddExperience=false;

      this.experiences_wtc.push(entry);

    },
    select: function(entry){

      this.experienceSelect=entry;
      this.experienceOriginal=service.clone(entry);

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
  filters:{
    trueOrFalse: function(value){
      return filter.trueOrFalse(this,value);
    },


      shortDate: function(value){
        return filter.shortDate(this,value);
      }



  },
  created: function(){
    this.getPermissions();
    this.getExperienceWtc();
  }
}
</script>
