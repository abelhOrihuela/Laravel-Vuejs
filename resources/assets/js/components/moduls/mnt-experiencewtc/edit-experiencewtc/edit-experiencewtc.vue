<script>


import  validate  from '../../../js/utilities/validate.js';
import  service  from '../../../js/utilities/service.js';
import { translations } from '../../../js/translations.js';
import { HTTP,EXPERIENCEWTC_EDIT,ADMINS } from '../../../js/constants_restful.js';
import Datepicker from 'vuejs-datepicker';




export default{
  template: require('./edit-experiencewtc.html'),
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  http: HTTP,
  props:{
    experience: Object,
    experiencenow: Object,
    update: Function
  },
  components:{
    'datepicker': Datepicker
  },
  data: function(){
    return{
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
        date:this.experience.date!='',
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
    experienceChange: function (){
      return !service.equals(this, this.experience, this.experiencenow);
    },
    fetchConsultants: function(){

      var resource= this.$resource(ADMINS);
      resource.get().then(function(response) {
        this.consultants=response.body;
      }, function(error){
  service.showError(this, error);
      });

    },
    editExperience: function(){

      var experience = new Object();;
      experience.wtc_id=this.experience.wtc_id;

      if(this.experience.name_company!= this.experiencenow.name_company){
        experience.name_company=this.experience.name_company;
      }
      if(this.experience.name_job!= this.experiencenow.name_job){
        experience.name_job=this.experience.name_job;
      }
      if(this.experience.date!= this.experiencenow.date){
        experience.date=this.experience.date;
      }
      if(this.experience.comments!= this.experiencenow.comments){
        experience.comments=this.experience.comments;
      }
      if(this.experience.consultant!= this.experiencenow.consultant){
        experience.consultant=this.experience.consultant;
      }

      var resource=this.$http.put(EXPERIENCEWTC_EDIT, experience);
      resource.then(function(response){
        service.showSuccess(this, "Operacion exitosa");
        this.update(this.experience);
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
