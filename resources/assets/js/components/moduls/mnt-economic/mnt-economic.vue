
<script>
import { translations } from '../../js/translations.js';
import  filter  from '../../js/utilities/filters.js';
import EditEconomic from './edit-economic/edit-economic.vue';
import AddEconomic from './add-economic/add-economic.vue';
import  service  from '../../js/utilities/service.js';

export default {
  template: require('./mnt-economic.html'),
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  data: function(){
    return{
      economicSelect:null,
      economicNow: null,
      showModalEditEconomic: false,
      showModalAddEconomic: false,
      locale: 'es'
    }
  },
  components:{
    'edit-economic': EditEconomic,
    'add-economic': AddEconomic

  },
  props:{
    candidate: Object
  },
  methods:{

    addMoreEconomic: function (){
      this.showModalAddEconomic=true;

    },

    addEconomic: function(entry){
      this.showModalAddEconomic=false;

      if(entry!=null){
        this.candidate.economic.push(entry);
      }

    },

    editEconomic: function(){
      this.showModalEditEconomic=true;
    },
    update: function(entry){

      if(entry!=null){
        var index=service.getIndiceObject(this, this.candidate.economic, 'id', entry.id);
        if(index>-1){
          this.candidate.economic[index]=entry;
        }

      }
      this.showModalEditEconomic=false;

    },
    select: function(entry){
      this.economicSelect=entry;
      this.economicNow=service.clone(entry);
    }

  },
  filters:{
    trueOrFalse: function(value){

      return filter.trueOrFalse(this,value);
    }
  },
}
</script>
