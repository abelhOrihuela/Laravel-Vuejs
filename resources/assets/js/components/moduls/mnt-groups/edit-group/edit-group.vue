<script>
import { translations } from '../../../js/translations.js';
import  service  from '../../../js/utilities/service.js';
import { HTTP, GROUP_EDIT, CATEGORIES, SUBCATEGORIES} from '../../../js/constants_restful.js';

export default{
  template: require('./edit-group.html'),
  props:{
    after: Function,
    group: Object,
    groupnow: Object

  },
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  http: HTTP,
  data: function (){
    return{
      locale: 'es',
      categories: [],
      subcategories:[]
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
  },
  methods: {

    editGroup: function(){

      var group= new Object();

      group.id=this.group.id;

      if(this.group.name_group!= this.groupnow.name_group){
        group.name_group=this.group.name_group;
      }
      if(this.group.category!= this.groupnow.category){
        group.category=this.group.category;
      }
      if(this.group.subcategory!= this.groupnow.subcategory){
        group.subcategory=this.group.subcategory;
      }
      if(this.group.visible!= this.groupnow.visible){
        group.visible=this.group.visible;
      }


      var resource=this.$http.put(GROUP_EDIT, group);
      resource.then((response)=>{
        this.after(response.body);

        service.showSuccess(this, null);
      }, (error) =>{

        service.showError(this, error);

        this.after(null);

      });


    },
    fetchCategories: function(){

      this.$http.get(CATEGORIES).then((response) => {
        if(response){
          response.json();
          this.categories= response.body;
        }
      },(error) => {
        service.showError(this, error);

      }
    );
  },
  fetchSubCategories: function(edit){
    if(edit){
      this.group.subcategory='';
    }
    var resource= this.$resource(SUBCATEGORIES);
    resource.get({id : this.group.category }).then((response) => {
      this.subcategories= response.body;
    },(error) => {
      service.showError(this, error);
    });
  },
  groupChange: function(){
    return !service.equals(this, this.groupnow, this.group);
  }
},created: function(){
  this.fetchCategories();
  this.fetchSubCategories();
}
}
</script>
