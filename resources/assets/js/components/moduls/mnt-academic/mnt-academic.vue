<script>
import { translations } from '../../js/translations.js';
import AddAcademic from './add-academic/add-academic.vue';
import EditAcademic from './edit-academic/edit-academic.vue';
import DeleteAcademic from './delete-academic/delete-academic.vue';
import  service  from '../../js/utilities/service.js';
import  filter  from '../../js/utilities/filters.js';

import { HTTP, ACADEMIC } from '../../js/constants_restful.js';




export default{
  template: require('./mnt-academic.html'),
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  http: HTTP,
  data: function(){
    return{
      locale: 'es',
      academicSelect: null,
      flagShowAddAcademic: false,
      showModalDeleteAcademic: false,
      flagShowEditAcademic: false,
      academicOriginal:{}
    }
  },
  props:{
    candidate: Object
  },
  components:{
    'add-academic': AddAcademic,
    'edit-academic': EditAcademic,
    'delete-academic': DeleteAcademic
  },
  filters:{
    trueOrFalse: function(value){

      return filter.trueOrFalse(this,value);
    },
    shortDate:function(value){

      return filter.shortDate(this,value);
    }
  }
  ,
  methods:{

    addMoreAcademic: function(){
      this.flagShowAddAcademic=true;
    },
    editAcademic: function(){
      this.flagShowEditAcademic=true;
    },
    updateAcademic(entry){
      if(entry!=null){
        var index=service.getIndiceObject(this, this.candidate.academics, 'academic_id', entry.academic_id);
        if(index>-1){
          this.candidate.academics[index]=entry;
        }
      }
      this.flagShowEditAcademic=false;
        this.resetSelect();
    },
    deleteAcademic: function(){
      this.showModalDeleteAcademic=true;
    },
    removeAcademic: function(id){
      this.showModalDeleteAcademic=false;
      if(id!=null){
        var index=service.getIndiceObject(this, this.candidate.academics, 'academic_id', id);
        if(index>-1){
          this.candidate.academics.splice(index,1);
        }
      }

        this.resetSelect();
    },
    addAcademic: function(entry){

      if (entry!=null) {
        entry.academic_id=entry.id;
        this.candidate.academics.push(entry);

      }
      this.flagShowAddAcademic=false;
      this.resetSelect();

    },
    select: function(entry){
      this.academicSelect=entry;
      this.academicOriginal=service.clone(entry);

    },
    resetSelect: function(){
      this.academicSelect=null;
        this.academicOriginal=null;
    }
  },
  created: function(){
  }
}
</script>
