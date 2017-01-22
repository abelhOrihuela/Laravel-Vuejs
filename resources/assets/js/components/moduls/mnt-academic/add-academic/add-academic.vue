<script>
import  validate  from '../../../js/utilities/validate.js';
import  service  from '../../../js/utilities/service.js';
import { translations } from '../../../js/translations.js';
import { HTTP, ACADEMIC_NEW } from '../../../js/constants_restful.js';

export default{

  template: require('./add-academic.html'),
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  props:{
    add: Function,
    candidate: Number
  },
  data: function(){
    return {
      locale: 'es',
      academic:{
        name_academic:'',
        career:'',
        level_academic: '',
        year_entry: '',
        year_exit:'',
        comments:'',
        now:''
      },
      flagShowYearExit: true
    }
  },
  http: HTTP,
  computed: {
    validation: function () {

      var date = /(\d+)(-|\/)(\d+)(?:-|\/)(?:(\d+)\s+(\d+):(\d+)(?::(\d+))?(?:\.(\d+))?)?/
      var numberEx=/^[0-9\b]+$/;

      return {
        name_academic: !!this.academic.name_academic.trim(),
        career: !!this.academic.career.trim(),
        level_academic: !!this.academic.level_academic.trim(),
        year_entry: numberEx.test(this.academic.year_entry),
        year_exit: numberEx.test(this.academic.year_exit)
      }
    },
    isValid: function () {
      var validation = this.validation
      return Object.keys(validation).every(function (key) {
        return validation[key]
      })
    }
  },
  methods:{
    formIsValid: function(){

      return validate.valid(this,this.validation, this.academic.now==1 ?
        validate.countProperties(this,this.validation)-1 : validate.countProperties(this,this.validation));
      },
      academicNow: function(){

        if(this.academic.now==1){

          this.flagShowYearExit=false;
          this.academic.year_exit='';

        }else{
          this.flagShowYearExit=true;
        }
      },
      addAcademic: function(){

        var academic = this.academic;
        academic.candidate_id=this.candidate;

        var resource=this.$http.post(ACADEMIC_NEW, academic);
        resource.then(function(response){
          service.showSuccess(this, 'Operacion Exitosa');

          this.academic={
            name_academic:'',
            career:'',
            level_academic: '',
            year_entry: '',
            year_exit:'',
            comments:'',
            now:''
          }

          this.add(response.body);
        }, function (error){

          this.add(null);
          service.showError(this, 'Operacion Fallida');

        });
      }
    }
  }
  </script>
