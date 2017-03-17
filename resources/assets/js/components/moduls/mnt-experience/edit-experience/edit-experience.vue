<script>

import  validate  from '../../../js/utilities/validate.js';
import  service  from '../../../js/utilities/service.js';
import { translations } from '../../../js/translations.js';
import { HTTP, EXPERIENCE_EDIT} from '../../../js/constants_restful.js';

import ADatepicker from '../../../a-components/a-datepicker/a-datepicker.vue';


export default{

  template: require('./edit-experience.html'),
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  props:{
    experience: Object,
    experiencenow: Object,
    update: Function
  },
  components:{
    'a-datepicker': ADatepicker
  },
  data: function(){
    return {

      locale: 'es',
      flagShowDepartureDate: true
    }
  },
  http: HTTP,
  computed: {
    validation: function () {

      var date = /(\d+)(-|\/)(\d+)(?:-|\/)(?:(\d+)\s+(\d+):(\d+)(?::(\d+))?(?:\.(\d+))?)?/

      return {
        name_business: !!this.experience.name_business.trim(),
        turn_business: !!this.experience.turn_business.trim(),
        name_job: !!this.experience.name_job.trim(),
        admission_date:date.test(this.experience.admission_date),
        departure_date:date.test(this.experience.departure_date),
      }
    },
    isValid: function () {
      var validation = this.validation
      return Object.keys(validation).every(function (key) {
        return validation[key]
      })
    }
  },
  methods: {

    formIsValid: function(){


      return validate.valid(this,this.validation, this.experience.now==1 ?
        validate.countProperties(this,this.validation)-1 : validate.countProperties(this,this.validation));
      },
      experienceChange: function (){
        return !service.equals(this, this.experience, this.experiencenow);
      },
      editExperience: function(){

        var experience = {};

        experience.experience_id=this.experience.experience_id;

        if(this.experience.name_business!=this.experiencenow.name_business){
          experience.name_business=this.experience.name_business;
        }
        if(this.experience.name_job!=this.experiencenow.name_job){
          experience.name_job=this.experience.name_job;
        }
        if(this.experience.now!=this.experiencenow.now){
          experience.now=this.experience.now;
        }

        if(this.experience.turn_business!=this.experiencenow.turn_business){
          experience.turn_business=this.experience.turn_business;
        }

        if(this.experience.comments!=this.experiencenow.comments){
          experience.comments=this.experience.comments;
        }

        if(this.experience.admission_date!=this.experiencenow.admission_date){
          experience.admission_date=this.experience.admission_date;
        }

        if(this.experience.departure_date!=this.experiencenow.departure_date){
          experience.departure_date=this.experience.departure_date;
        }

        this.$http.put(EXPERIENCE_EDIT, experience)
        .then(function(response){
          this.update(this.experience);

          service.showSuccess(this, null);
        }, function (error){

          service.showError(this, error);

          this.update(null);

        });

      },
      experienceNow: function(){
        if(this.experience.now==1){

          this.experience.departure_date='';

        }
      }
      ,
      validateDates: function(){

        var admission_date=new Date(this.experience.admission_date);
        var departure_date=new Date(this.experience.departure_date);

        if(departure_date<=admission_date){
          this.experience.departure_date='';
        }
      }
    }
  }
  </script>
