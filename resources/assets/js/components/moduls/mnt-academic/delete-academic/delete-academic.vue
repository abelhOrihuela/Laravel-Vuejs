<script>
import  validate  from '../../../js/utilities/validate.js';
import  service  from '../../../js/utilities/service.js';
import { translations } from '../../../js/translations.js';

import { HTTP, ACADEMIC_DELETE } from '../../../js/constants_restful.js';

export default{

  template: require('./delete-academic.html'),
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  props:{
    remove: Function,
    academic: Object
  },
  data: function(){
    return {
      locale: 'es'
    }
  },
  http: HTTP,
  methods:{

    deleteAcademic: function(academic){

      var resource= this.$resource(ACADEMIC_DELETE);

      resource.delete({id : academic.academic_id }).then(function(response){
        this.remove(academic.academic_id);
        service.showSuccess(this, 'Operacion Exitosa');
      }, function(error){
        this.remove(null);
        service.showError(this, 'Ocurrio un error');

      });
    }
  }
}
</script>
