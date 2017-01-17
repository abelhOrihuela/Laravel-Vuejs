<script>
import ATable from '../../a-components/a-table/a-table.vue';
import  service  from '../../js/utilities/service.js';
import  filter  from '../../js/utilities/filters.js';

import { HTTP, CUSTOMERS } from '../../js/constants_restful.js';
import { translations } from '../../js/translations.js';
import { tableCustomers } from '../../js/config-app/tables.js';

export default{
  template: require('./mnt-customers.html'),
  data: function(){
    return {
      columns: tableCustomers,
      customers:[]
    }
  },
  http: HTTP,
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  components:{
    'a-table': ATable
  },
  methods:{

    getCustomers: function(){

      var resource= this.$resource(CUSTOMERS);
      resource.get().then((response) => {
        this.customers=response.body;
      });

    },
    select: function(entry){

    }

  },
  created: function(){
    this.getCustomers();

  }
}
</script>
