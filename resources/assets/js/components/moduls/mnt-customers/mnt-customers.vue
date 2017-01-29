<script>
import ATable from '../../a-components/a-table/a-table.vue';
import  service  from '../../js/utilities/service.js';
import  filter  from '../../js/utilities/filters.js';

import { HTTP, CUSTOMERS } from '../../js/constants_restful.js';
import { translations } from '../../js/translations.js';
import { tableCustomers } from '../../js/config-app/tables.js';

import AddCustomer from './add-customer/add-customer.vue';


export default{
  template: require('./mnt-customers.html'),
  data: function(){
    return {
      columns: tableCustomers,
      customers:[],
      flagShowTable: true,
      flagDeatilSelect: false,
      flagAddCustomer: false,
      selected: null,
      locale: 'es'
    }
  },
  http: HTTP,
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  components:{
    'a-table': ATable,
    'add-customer': AddCustomer
  },
  methods:{

    getCustomers: function(){

      var resource= this.$resource(CUSTOMERS);
      resource.get().then((response) => {
        this.customers=response.body;
      });

    },
    select: function(entry){
      this.flagShowTable=false;
      this.flagDeatilSelect=true;
      this.flagAddCustomer=false;
      this.selected=entry;

    },
    showTable: function(){
      this.flagShowTable=true;
      this.flagDeatilSelect=false;
          this.selected=null;
    },
    addCustomer: function(){
      this.flagShowTable=false;
      this.flagDeatilSelect=false;
      this.flagAddCustomer=true;


    },
    cancelAddCustomer: function(){
      this.flagShowTable=true;
      this.flagDeatilSelect=false;
      this.flagAddCustomer=false;
    }
    ,
    beforeAddCustomer: function(entry){
this.customers.push(entry);

this.select(entry);
    }

  },
  created: function(){
    this.getCustomers();

  },  filters:{
      trueOrFalse: function(value){

        return filter.trueOrFalse(this,value);
      },
      shortDate: function(value){

        return filter.shortDate(this,value);
      },
      customers: function(value){

        return filter.customers(this,value);
      }
    }
}
</script>
