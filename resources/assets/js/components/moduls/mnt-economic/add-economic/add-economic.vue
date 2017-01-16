<script>

import { translations } from '../../../js/translations.js';
import  service  from '../../../js/utilities/service.js';
import { HTTP, ECONOMIC_NEW} from '../../../js/constants_restful.js';




  export default{
    template: require('./add-economic.html'),
    props:{
      candidate: Number,
      add: Function

    },
    translations: translations,
    mixins: [require('vue-i18n-mixin')],
    http: HTTP,
    data: function (){
      return{
        locale: 'es',
        economic:{
          economic_package:'',
          current_salary:0,
          salary_expectation:0

        }
      }
    },
    computed: {
      validation: function () {

        var date = /(\d+)(-|\/)(\d+)(?:-|\/)(?:(\d+)\s+(\d+):(\d+)(?::(\d+))?(?:\.(\d+))?)?/;
        var currency = /(?=.)^\$?(([1-9][0-9]{0,2}(,[0-9]{3})*)|0)?(\.[0-9]{1,2})?$/;

        return {
           current_salary: (currency.test(this.economic.current_salary) && this.economic.current_salary !=0),
           salary_expectation: (currency.test(this.economic.salary_expectation) && this.economic.salary_expectation!=0),
           economic_package: this.economic.economic_package.length>5
        }
      },
      isValid: function () {
        var validation = this.validation
        return Object.keys(validation).every(function (key) {
          return validation[key]
        })
      }
    }
    ,
    methods: {

      addEconomic: function(){
        var economic= this.economic;

        economic.candidate_id=this.candidate;


        var resource=this.$http.post(ECONOMIC_NEW, economic);
        resource.then(function(response){
          this.add(response.body);

          service.showSuccess(this, null);
        }, function (error){

          service.showError(this, error);

          this.add(null);

        });
      }
    }
  }
</script>
