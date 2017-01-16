<script>

import { translations } from '../../../js/translations.js';
import  service  from '../../../js/utilities/service.js';
import { HTTP, ECONOMIC_EDIT} from '../../../js/constants_restful.js';




  export default{
    template: require('./edit-economic.html'),
    props:{
      economic: Object,
      economicnow: Object,
      update: Function

    },
    translations: translations,
    mixins: [require('vue-i18n-mixin')],
    http: HTTP,
    data: function (){
      return{
        locale: 'es'
      }
    },
    computed: {
      validation: function () {

        var date = /(\d+)(-|\/)(\d+)(?:-|\/)(?:(\d+)\s+(\d+):(\d+)(?::(\d+))?(?:\.(\d+))?)?/;
        var currency = /(?=.)^\$?(([1-9][0-9]{0,2}(,[0-9]{3})*)|0)?(\.[0-9]{1,2})?$/;

        return {
           current_salary: currency.test(this.economic.current_salary),
           salary_expectation: currency.test(this.economic.salary_expectation),
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
      economicChange: function(){
        return !service.equals(this, this.economic, this.economicnow);

      },
      editEconomic: function(){
        var economic= new Object();

        economic.id=this.economic.id;

        if(this.economic.current_salary!= this.economicnow.current_salary){
          economic.current_salary=this.economic.current_salary;
        }

        if(this.economic.economic_package!= this.economicnow.economic_package){
          economic.economic_package=this.economic.economic_package;
        }

        if(this.economic.relocation!= this.economicnow.relocation){
          economic.relocation=this.economic.relocation;
        }

        if(this.economic.salary_expectation!= this.economicnow.salary_expectation){
          economic.salary_expectation=this.economic.salary_expectation;
        }

        if(this.economic.comments!= this.economicnow.comments){
          economic.comments=this.economic.comments;
        }


        var resource=this.$http.put(ECONOMIC_EDIT, economic);
        resource.then(function(response){
          this.update(this.economic);

          service.showSuccess(this, null);
        }, function (error){

          service.showError(this, error);

          this.update(null);

        });



      }
    }
  }
</script>
