
<script>
import { translations } from '../../js/translations.js';
import  filter  from '../../js/utilities/filters.js';
import DeleteExperience from './delete-experience/delete-experience.vue';
import AddExperience from './add-experience/add-experience.vue';
import EditExperience from './edit-experience/edit-experience.vue';


import { HTTP, EXPERIENCE } from '../../js/constants_restful.js';


import  service  from '../../js/utilities/service.js';

export default {
  template: require('./mnt-experience.html'),
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  http: HTTP,
  data: function(){
    return{
      experienceSelect:null,
      experienceOriginal:{},
      showModalEditExperience: false,
      showModalDeleteExperince: false,
      showModalAddExperience: true,
      locale: 'es'
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

    editExperience: function(){
      this.showModalEditExperience= true;

    },
    update: function(entry){

      if(entry!=null){
        var index=service.getIndiceObject(this, this.candidate.experiences, 'experience_id', entry.experience_id);
        if(index>-1){
          this.candidate.experiences[index]=entry;
        }

      }
          this.showModalEditExperience= false;

    },
    deleteExperience: function(){

      this.showModalDeleteExperince=true;

    },
    removeExperince: function(id){
      this.showModalDeleteExperince=false;
      var index=service.getIndiceObject(this, this.candidate.experiences, 'experience_id', id);
      if(index>-1){
        this.candidate.experiences.splice(index,1);
      }
    },
    addMoreExperience: function(){


    },
    addExperience: function(entry){

      entry.experience_id=entry.id;
      this.showModalAddExperience=false;
      this.candidate.experiences.push(entry);
      this.showModalAddExperience=true;



    },
    select: function(entry){

      this.experienceSelect=entry;
      this.experienceOriginal=service.clone(entry);


    }
  },
  filters:{
    trueOrFalse: function(value){
      return filter.trueOrFalse(this,value);
    }
  },
  created: function(){
  }
}
</script>
