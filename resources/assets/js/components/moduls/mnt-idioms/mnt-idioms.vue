<script>

import { translations } from '../../js/translations.js';
import { HTTP, IDIOM_DELETE, IDIOM_NEW, IDIOMS_CANDIDATE, USER_PERMISSIONS } from '../../js/constants_restful.js';
import  service  from '../../js/utilities/service.js';
import  runblock  from '../../js/runblock.js';



export default{
  template: require('./mnt-idioms.html'),
  props:{
    candidate: Object
  },
  http:HTTP,
  data: function(){
    return {
      locale: 'es',
      idiom:{
        name_idioma: '',
        level_idioma: ''
      },
      levels:[],
      idioms:[],
      permissions:{}
    }
  },
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  computed: {
    validation: function () {

      return {
        name_idioma: !!this.idiom.name_idioma!='',
        level_idioma: !!this.idiom.level_idioma!='',
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

      console.log("entry");
      console.log(entry);
      console.log(this.candidate);


      var resource= this.$resource(IDIOM_DELETE);
      resource.delete({id : entry.idioma_id }).then(function(response){

        var index=service.getIndiceObject(this,this.idioms,'idioma_id', entry.idioma_id );
        console.log("index");
            console.log(index);

        if(index>-1){
          console.log("mayor");
          this.idioms.splice(index, 1);
        }
      }, function(error){

      });


    },
    addLanguage: function(){

      var idiom=this.idiom;
      idiom.candidate_id=this.candidate.id;
      var resource=this.$http.post(IDIOM_NEW, idiom);
      resource.then(function(response){

        this.getIdioms();
        this.idiom.name_idioma='';
        this.idiom.level_idioma='';

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
    },
    getIdioms: function(){

      var resource= this.$resource(IDIOMS_CANDIDATE);
      resource.get({id : this.candidate.id }).then(function(response){

        this.idioms=response.body;

      }, function(error){
        service.showError(this, error);

      });

    }
  },
  created: function(){
    this.levels=[
      {'description':this.translate('people.read'), 'code':'Leido'},
      {'description':this.translate('people.write'), 'code':'Escrito'},
      {'description':this.translate('people.read_write'), 'code':'Leido y Escrito'},
      {'description':this.translate('people.speak'), 'code':'Conversacional'},
      {'description':this.translate('people.speak_bussines'), 'code':'Conversacional de Negocios'}
    ];

    this.getPermissions();
    this.getIdioms();

  }
}
</script>
