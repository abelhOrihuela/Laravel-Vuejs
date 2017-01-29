<script>
import { translations } from '../../../js/translations.js';
import  service  from '../../../js/utilities/service.js';
import { HTTP, GROUP_DELETE} from '../../../js/constants_restful.js';

  export default{
    template: require('./delete-group.html'),
    translations: translations,
    mixins: [require('vue-i18n-mixin')],
    http: HTTP,
    data: function(){
      return {
        locale: 'es'
      }
    },
    props:{
      after: Function,
      group: Object
    },
    methods:{
      deleteGroup: function(){

        var resource= this.$resource(GROUP_DELETE);
        resource.delete({id : this.group.id }).then(function(response){
          this.after(true);
          service.showSuccess(this, 'Operacion Exitosa');
        }, function(error){
          service.showError(this, error);
          this.after(null);

        });
      }
    }
  }
</script>
