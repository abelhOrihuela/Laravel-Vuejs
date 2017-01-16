<script>
import { translations } from '../../../js/translations.js';
import { HTTP, GROUPS, GROUPNEW} from '../../../js/constants_restful.js';
import  service  from '../../../js/utilities/service.js';

export default{
  template: require('./add-candidate-to-group.html'),
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  http:HTTP,
  props:{
    candidate: Object,
    add: Function
  },
  data: function(){
    return{
      groups: [],
      locale: 'es',
      groupSelect:{
        id:''
      }
    }
  },
  methods:{

    getGroups: function(){

      var resource= this.$resource(GROUPS);

      resource.get()
      .then(function(response){
        this.groups=response.body;

      }, function(error){
        service.showError(this, error);
      });
    },
    addCandidate: function(){

      var group=this.groupSelect;
      group.candidate_id=this.candidate.id;
      var resource=this.$http.post(GROUPNEW, group);
      resource.then(function(response){

        this.candidate.groups.push(response.body);

        service.showSuccess(this, null);
      }, function (error){

        service.showError(this, error);

      });
    },
  },
  computed: {
    validation: function () {

      return {
        id: !!this.groupSelect.id!='',
      }
    },
    isValid: function () {
      var validation = this.validation
      return Object.keys(validation).every(function (key) {
        return validation[key]
      })
    }
  },
  created: function(){
    this.getGroups();
  }
}
</script>
