<script>
import  validate  from '../../../js/utilities/validate.js';
import  service  from '../../../js/utilities/service.js';
import { translations } from '../../../js/translations.js';
import { HTTP, ACADEMIC_EDIT} from '../../../js/constants_restful.js';
export default{

  template: require('./edit-academic.html'),
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  props:{
    replace: Function,
    academic: Object,
    academicnow: Object,
    update:  Function
  },
  data: function(){
    return {
      locale: 'es',
      academicOriginal:{},
      flagShowYearExit: true
    }
  },
  http: HTTP,
  created: function(){
    if(this.academic.now==1){
      this.academicChange();
    }
  }
  ,
  computed: {
    validation: function () {

      //var date = /(\d+)(-|\/)(\d+)(?:-|\/)(?:(\d+)\s+(\d+):(\d+)(?::(\d+))?(?:\.(\d+))?)?/
      var date = /^\d{4}$/;

      var numberEx=/^[0-9\b]+$/;

      return {
        name_academic: this.academic.name_academic!='',
        career: this.academic.career!='',
        level_academic: this.academic.level_academic!='',
        year_entry: date.test(this.academic.year_entry),
        year_exit: date.test(this.academic.year_exit)
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
      academicChange: function(){

        return !service.equals(this, this.academic, this.academicnow);

      },
      academicNow: function(){

        if(this.academic.now==1){

          this.flagShowYearExit=false;
          this.academic.year_exit='';

        }else{
          this.flagShowYearExit=true;
        }

      },
      editAcademic: function(){
        service.loading(true);

        var academic = new Object();
        academic.academic_id=this.academic.academic_id;

        if(this.academic.name_academic!=this.academicnow.name_academic){
          academic.name_academic=this.academic.name_academic;
        }

        if(this.academic.career!=this.academicnow.career){
          academic.career=this.academic.career;
        }

        if(this.academic.level_academic!=this.academicnow.level_academic){
          academic.level_academic=this.academic.level_academic;
        }

        if(this.academic.year_entry!=this.academicnow.year_entry){
          academic.year_entry=this.academic.year_entry;
        }

        if(this.academic.year_exit!=this.academicnow.year_exit){
          academic.year_exit=this.academic.year_exit;
        }

        if(this.academic.comments!=this.academicnow.comments){
          academic.comments=this.academic.comments;
        }

        if(this.academic.now!=this.academicnow.now){
          academic.now=this.academic.now;
        }

        var resource=this.$http.put(ACADEMIC_EDIT, academic);
        resource.then(function(response){
          this.update(this.academic);
          service.loading(false);

          service.showSuccess(this, null);
        }, function (error){
          service.loading(false);

          service.showError(this, error);

          this.updateAcademic(null);

        });

      }
    }

  }

  </script>
