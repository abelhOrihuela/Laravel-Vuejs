<script>
import { translations } from '../../../js/translations.js';
import { HTTP, GROUPS, GROUP_CANDIDATE_NEW, DELETE_GROUP_CANDIDATE, USER_PERMISSIONS} from '../../../js/constants_restful.js';
import  service  from '../../../js/utilities/service.js';
import  runblock  from '../../../js/runblock.js';


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
      permissions:{},
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
      var resource=this.$http.post(GROUP_CANDIDATE_NEW, group);
      resource.then(function(response){

        console.log(response);
        var body=response.body;
        body.pivot={
          candidate_id: this.candidate.id
        }

        this.candidate.groups.push(body);

        this.groupSelect={
          id:''
        }

        //service.showSuccess(this, null);
      }, function (error){
        console.log(error);
        service.showError(this, error);

      });
    },
    deleteGroup: function(group){

      var resource= this.$resource(DELETE_GROUP_CANDIDATE);
      resource.delete({id_group: group.id, id : this.candidate.id }).then(function(response){
        var index=service.getIndiceObject(this, this.candidate.groups, 'id',group.id );
        if(index>-1){
          this.candidate.groups.splice(index, 1);
        }
        this.groupSelect={id:''}
      }, function(error){
        service.showError(this, error);
      });
    },
    getPermissions: function(){

      var user=runblock.getUserSession();

      var resource=this.$http.post(USER_PERMISSIONS, user);
      resource.then(function(response){
        this.permissions=response.body;
      }, function (error){
        service.showError(this, error);
      });
    }
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
    this.getPermissions();
  }
}
</script>
