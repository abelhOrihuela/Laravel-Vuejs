<script>
/**
 * Component: delete-customer
 * Modul: MntCustomers
 * {params}
 * customer type:object
 */

 // Include Services
import { translations } from '../../../js/translations.js';
import  service  from '../../../js/utilities/service.js';
import { HTTP, CUSTOMER_DELETE} from '../../../js/constants_restful.js';


export default{
  template: require('./delete-customer.html'),
  props:{
    customer: Object,
    after: Function
  },
  http:HTTP,
  mixins: [require('vue-i18n-mixin')],
  translations: translations,
  data: function(){
    return {
      null
    }
  },
  methods:{
    /**
     * function: deleteCustomer
     * {params} entry:Object#customer
     */
    deleteCustomer: function(entry){
      var resource= this.$resource(CUSTOMER_DELETE);
      resource.delete({id : entry.id }).then(function(response){
        service.showSuccess(this, 'Operacion Exitosa');
        this.after();
      }, function(error){
        service.showError(this, error);

      });
    }
  },
  created: function(){

  }
}
</script>
