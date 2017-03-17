<script>


import  validate  from '../../../js/utilities/validate.js';
import  service  from '../../../js/utilities/service.js';
import { translations } from '../../../js/translations.js';
import { HTTP,EXPERIENCEWTC_NEW,ADMINS } from '../../../js/constants_restful.js';
import Datepicker from 'vuejs-datepicker';



export default{
  template: require('./add-experiencewtc.html'),
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  http: HTTP,
  props:{
    add: Function,
    candidate: Number
  },
  components:{
    'datepicker': Datepicker
  },
  data: function(){
    return{
      experience:{
        name_company:'',
        name_job:'',
        date:'',
        comments:'',
        consultant:''


      },
      consultants:[]
    }
  },
  computed: {
    validation: function () {

      var date = /(\d+)(-|\/)(\d+)(?:-|\/)(?:(\d+)\s+(\d+):(\d+)(?::(\d+))?(?:\.(\d+))?)?/

      return {
        name_company: !!this.experience.name_company.trim(),
        name_job: !!this.experience.name_job.trim(),
        consultant: !!this.experience.consultant.trim(),
        date:date.test(this.experience.date),
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


      return validate.valid(this,this.validation, validate.countProperties(this,this.validation));
    },
    fetchConsultants: function(){

      var resource= this.$resource(ADMINS);
      resource.get().then(function(response) {
        this.consultants=response.body;
      }, function(error){
          service.showError(this, error);

      });

    },
    addExperince: function(){

      var experience = this.experience;
      experience.candidate_id=this.candidate;

      var resource=this.$http.post(EXPERIENCEWTC_NEW, experience);
      resource.then(function(response){
        service.showSuccess(this, "Operacion exitosa");
        this.add(response.body);
      }, function (error){
          this.add(null);
          service.showError(this, error);


      });


    }
  },
  created: function(){
    this.fetchConsultants();
  }
}
</script>
