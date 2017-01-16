<script>
import { translations } from '../../../js/translations.js';
import  service  from '../../../js/utilities/service.js';
import { HTTP, EXPERIENCE_DELETE} from '../../../js/constants_restful.js';


export default{

  template: require('./delete-experience.html'),
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  props:{
    experience: Object,
    remove: Function
  },
  data: function(){
    return {
      null
    }
  },
  http: HTTP,
  methods: {

    deleteExperience: function(entry){

      var resource= this.$resource(EXPERIENCE_DELETE);
      resource.delete({id : entry.experience_id }).then(function(response){
        this.remove(entry.experience_id);
        service.showSuccess(this, 'Operacion Exitosa');
      }, function(error){
        service.showError(this, error);

      });


    }
  }
}
</script>
