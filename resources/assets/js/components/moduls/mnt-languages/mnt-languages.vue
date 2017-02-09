<script>
import { translations } from '../../js/translations.js';
import { HTTP, LANGUAGE_DELETE, LANGUAGE_NEW, USER_PERMISSIONS } from '../../js/constants_restful.js';
import  service  from '../../js/utilities/service.js';
import  runblock  from '../../js/runblock.js';

export default{
  template: require('./mnt-languages.html'),
  props:{
    candidate: Object
  },
  http:HTTP,
  data: function(){
    return {
      locale: 'es',
      permissions: {},
      language:{
        name_language: '',
        level_language: ''
      }
    }
  },
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  computed: {
    validation: function () {

      var reg = /^[0-9]{1,10}$/;

      return {
        name_language: !!this.language.name_language!='',
        level_language: reg.test(this.language.level_language),
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
    deleteLanguage: function(entry){
      var resource= this.$resource(LANGUAGE_DELETE);
      resource.delete({id : entry.id }).then(function(response){
        var index=service.getIndiceObject(this,this.candidate.languages,'id', entry.id );
        if(index>-1){
          this.candidate.languages.splice(index, 1);
        }
      }, function(error){

      });
    },
    addLanguage: function(){
      var language=this.language;
      language.candidate_id=this.candidate.id;
      var resource=this.$http.post(LANGUAGE_NEW, language);
      resource.then(function(response){

        this.candidate.languages.push(response.body);
        this.language.name_language='';
        this.language.level_language='';

      }, function (error){

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
  created: function(){
    this.getPermissions();
  }
}
</script>
