
<script>
import { translations } from '../../js/translations.js';
import  filter  from '../../js/utilities/filters.js';
import AddExperienceWtc from './add-experiencewtc/add-experiencewtc.vue';
import DeleteExperienceWtc from './delete-experiencewtc/delete-experiencewtc.vue';
import EditExperienceWtc from './edit-experiencewtc/edit-experiencewtc.vue';
import  service  from '../../js/utilities/service.js';
import { HTTP, EXPERIENCEWTC } from '../../js/constants_restful.js';



export default {
  template: require('./mnt-experiencewtc.html'),
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  http: HTTP,
  data: function(){
    return{
      experienceSelect:null,
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

    editExperience: function(){
      this.showModalEditExperience= true;

    },
    update: function(entry){

      if(entry!=null){
        var index=service.getIndiceObject(this, this.candidate.experiences_wtc, 'wtc_id', entry.wtc_id);
        if(index>-1){
          this.candidate.experiences_wtc[index]=entry;
        }
      }
      this.showModalEditExperience= false;
      this.experienceSelect=null;

    },
    deleteExperience: function(){

      this.showModalDeleteExperince=true;

    },
    removeExperince: function(id){
      this.showModalDeleteExperince=false;
      var index=service.getIndiceObject(this, this.candidate.experiences_wtc, 'wtc_id', id);
      if(index>-1){
        this.candidate.experiences_wtc.splice(index,1);
      }

      this.experienceSelect=null;
    },
    addMoreExperience: function(){

      this.showModalAddExperience=true;

    },
    addExperience: function(entry){

      entry.wtc_id=entry.id;
      this.showModalAddExperience=false;

      this.candidate.experiences_wtc.push(entry);

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
