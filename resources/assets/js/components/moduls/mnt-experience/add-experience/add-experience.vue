<script>

import  validate  from '../../../js/utilities/validate.js';
import  service  from '../../../js/utilities/service.js';
import { translations } from '../../../js/translations.js';
import { HTTP, EXPERIENCE_NEW} from '../../../js/constants_restful.js';
import ADatepicker from '../../../a-components/a-datepicker/a-datepicker.vue';


export default{

  template: require('./add-experience.html'),
  translations: translations,

  mixins: [require('vue-i18n-mixin')],
  props:{
    add: Function,
    candidate: Object
  },
  components:{
    'a-datepicker': ADatepicker
  },
  data: function(){
    return {
      experience:{
        name_business:'',
        name_job: '',
        turn_business:'',
        now:0,
        comments:'',
        admission_date: null,
        departure_date: null,
        locale: 'es'
      },
      flagShowDepartureDate: true,
      price: '',
      price2: ''

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
        admission_date: date.test(this.experience.admission_date),
        departure_date: date.test(this.experience.departure_date)



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
    addExperince: function(){

      var experience = this.experience;
      experience.candidate_id=this.candidate.id;

      this.$http.post(EXPERIENCE_NEW, experience)
      .then(function(response){

        this.experience={
          name_business:'',
          name_job: '',
          turn_business:'',
          now:0,
          comments:'',
          admission_date:'',
          departure_date:'',
          locale: 'es',
          state:{
            highlighted:{
        to: new Date(2016, 0, 5), // Highlight all dates up to specific date
        from: new Date(2016, 0, 26), // Highlight all dates after specific date

            }
          }
        }
        this.add(response.body);
      }, function (error){

      });

    },
    experienceNow: function(){
      if(this.experience.now==1){

        this.flagShowDepartureDate=false;
        this.experience.departure_date='';

      }else{
        this.flagShowDepartureDate=true;
      }
    }
    ,
    validateDates: function(){


      var admission_date=new Date(this.experience.admission_date);
      var departure_date=new Date(this.experience.departure_date);


      if(departure_date<=admission_date){
          this.experience.departure_date=null;

      }
    }
  }
}
</script>
