
<script>
import { translations } from '../../js/translations.js';
import  filter  from '../../js/utilities/filters.js';
import EditEconomic from './edit-economic/edit-economic.vue';
import AddEconomic from './add-economic/add-economic.vue';
import  service  from '../../js/utilities/service.js';
import  runblock  from '../../js/runblock.js';
import { HTTP,ECONOMIC, USER_PERMISSIONS } from '../../js/constants_restful.js';



export default {
  template: require('./mnt-economic.html'),
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  http:HTTP,
  data: function(){
    return{
      economicSelect:null,
      economicNow: null,
      permissions: {},
      showModalEditEconomic: false,
      showModalAddEconomic: false,
      locale: 'es',
      economics: []
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
    getEconomic: function(){

      var resource= this.$resource(ECONOMIC);
      resource.get({id : this.candidate.id }).then(function(response){
        this.economics=response.body;

      }, function(error){
        service.showError(this, error);
      });
    },

    addMoreEconomic: function (){
      this.showModalAddEconomic=true;

    },

    addEconomic: function(entry){
      this.showModalAddEconomic=false;

      if(entry!=null){
        this.economics.push(entry);
      }

    },

    editEconomic: function(){
      this.showModalEditEconomic=true;
    },
    update: function(entry){

      if(entry!=null){
        var index=service.getIndiceObject(this, this.economics, 'id', entry.id);
        if(index>-1){
          this.economic[index]=entry;
        }

      }
      this.showModalEditEconomic=false;

    },
    select: function(entry){
      this.economicSelect=entry;
      this.economicNow=service.clone(entry);
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
    this.getPermissions();
    this.getEconomic();
  },
  filters:{
    trueOrFalse: function(value){

      return filter.trueOrFalse(this,value);
    }
  },
}
</script>
