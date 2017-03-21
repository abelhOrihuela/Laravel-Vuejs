
<script>
import { translations } from '../../js/translations.js';
import  filter  from '../../js/utilities/filters.js';
import DeleteExperience from './delete-experience/delete-experience.vue';
import AddExperience from './add-experience/add-experience.vue';
import EditExperience from './edit-experience/edit-experience.vue';
import  runblock  from '../../js/runblock.js';

import { HTTP, EXPERIENCE, USER_PERMISSIONS } from '../../js/constants_restful.js';
import  service  from '../../js/utilities/service.js';

export default {
  template: require('./mnt-experience.html'),
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
      experiences:[]
    }
  },
  components:{
    'delete-experience':DeleteExperience,
    'edit-experience':EditExperience,
    'add-experience': AddExperience
  },
  props:{
    candidate: Object
  },
  methods:{
    getExperience: function(){
      service.loading(true);

      var resource= this.$resource(EXPERIENCE);
      resource.get({id : this.candidate.id }).then(function(response){
        this.experiences=response.body;
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

      console.log("UPDATE");
      console.log(entry);

      if(entry!=null){

        this.getExperience();
        this.experienceSelect=null;
        this.experienceOriginal=null;

      }
      this.showModalEditExperience= false;

    },
    deleteExperience: function(){


      this.showModalDeleteExperince=true;

    },
    removeExperince: function(id){
      this.showModalDeleteExperince=false;
      var index=service.getIndiceObject(this, this.experiences, 'experience_id', id);
      if(index>-1){
        this.experiences.splice(index,1);
        this.experienceSelect=null;
        this.experienceOriginal=null;
      }
    },
    addMoreExperience: function(){

      this.showModalAddExperience=true;

    },

    addExperience: function(entry){

      entry.experience_id=entry.id;
      this.showModalAddExperience=false;
      this.getExperience();

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
    this.getExperience();

  }
}
</script>
