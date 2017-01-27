<script>

import { translations } from '../../../js/translations.js';
import  service  from '../../../js/utilities/service.js';
import { HTTP, GROUP_NEW} from '../../../js/constants_restful.js';

export default{
  template: require('./add-group.html'),
  props:{
    after: Function

  },
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  http: HTTP,
  data: function (){
    return{
      locale: 'es',
      categories: [],
      subcategories:[],
      group:{
        name_group:'',
        category:'',
        subcategory:'',
        visible:''
      }

    }
  },
  computed: {
    validation: function () {
      return {
        category: !!this.group.category!='',
        subcategory: !!this.group.subcategory!='',
        name_group: !!this.group.name_group!='',
      }
    },
    isValid: function () {
      var validation = this.validation
      return Object.keys(validation).every(function (key) {
        return validation[key]
      })
    }
  }
  ,
  methods: {

    addGroup: function(){
      var group= this.group;

      var resource=this.$http.post(GROUP_NEW, group);
      resource.then(function(response){

        this.after(response.body);

        service.showSuccess(this, null);
      }, function (error){

        service.showError(this, error);


      });
    }
    ,  fetchCategories: function(){

      this.$http.get('categories' )
      .then((response) => {
        if(response){
          response.json();
          this.categories= response.body;

        }
      },(response) => {


      }
    );
  },
  fetchSubCategories: function(){

    var resource= this.$resource('subcategories{/id}');

    resource.get({id : this.group.category }).then((response) => {
      this.subcategories= response.body;
    });

  }



},
created: function(){
  this.fetchCategories();
}
}
</script>
