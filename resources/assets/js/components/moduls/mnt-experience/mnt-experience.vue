
<script>
import { translations } from '../../js/translations.js';
import  filter  from '../../js/utilities/filters.js';
import DeleteExperience from './delete-experience/delete-experience.vue';
import AddExperience from './add-experience/add-experience.vue';
import EditExperience from './edit-experience/edit-experience.vue';
import  runblock  from '../../js/runblock.js';

import ADatepicker from '../../a-components/a-datepicker/a-datepicker.vue';

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
      date: '1984/12/30 08:32'
     }
  },
  components:{
    'delete-experience':DeleteExperience,
    'edit-experience':EditExperience,
    'add-experience': AddExperience,
    'a-datepicker': ADatepicker
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

      this.showModalAddExperience=true;

    },
    addExperience: function(entry){

      entry.experience_id=entry.id;
      this.showModalAddExperience=false;
      this.candidate.experiences.push(entry);



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

  }
}
</script>
