<script>

import  service  from '../../../js/utilities/service.js';
import  filter  from '../../../js/utilities/filters.js';

import { HTTP, CATEGORIES, SUBCATEGORIES,CUSTOMER_EDIT } from '../../../js/constants_restful.js';
import { translations } from '../../../js/translations.js';

export default{
  template: require('./edit-customer.html'),
  props:{
    customer: Object,
    customernow: Object
  },
  data: function(){

    return{
      locale: 'es',
      categories: [],
      subcategories:[],
    }

  },
  http: HTTP,
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  computed: {
    validation: function () {
      var date = /(\d+)(-|\/)(\d+)(?:-|\/)(?:(\d+)\s+(\d+):(\d+)(?::(\d+))?(?:\.(\d+))?)?/
      var emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      var numberEx=/^[0-9\b]+$/;
      return {
        username: !!this.customer.username.trim(),
        gender: !!this.customer.gender!='',
        email: emailRE.test(this.customer.email),
        company: !!this.customer.company!='',
        category: !!this.customer.category!='',
        subcategory: !!this.customer.subcategory!='',
        type: !!this.customer.type!='',
        comments: !!this.customer.comments.trim(),


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
    fetchCategories: function(){

      this.$http.get(CATEGORIES).then((response) => {
        if(response){
          response.json();
          this.categories= response.body;
        }
      },(response) => {

      }
    );
    this.fetchSubCategories();
  },
  fetchSubCategories: function(){
    var resource= this.$resource(SUBCATEGORIES);

    resource.get({id : this.customer.category }).then((response) => {
      this.subcategories= response.body;
    });
  },
  changeCustomer: function(){
    return !service.equals(this, this.customer, this.customernow);
  },
  editCustomer: function(){
    var customer= new Object();

    customer.id=this.customer.id;

    if(this.customer.username!= this.customernow.username){
      customer.username=this.customer.username;
    }
    if(this.customer.gender!= this.customernow.gender){
      customer.gender=this.customer.gender;
    }
    if(this.customer.company!= this.customernow.company){
      customer.company=this.customer.company;
    }
    if(this.customer.category!= this.customernow.category){
      customer.category=this.customer.category;
    }
    if(this.customer.subcategory!= this.customernow.subcategory){
      customer.subcategory=this.customer.subcategory;
    }
    if(this.customer.type!= this.customernow.type){
      customer.type=this.customer.type;
    }
    if(this.customer.comments!= this.customernow.comments){
      customer.comments=this.customer.comments;
    }
    console.log("---------------------------");
    console.log(customer);
    console.log("---------------------------");

    var resource=this.$http.put(CUSTOMER_EDIT, customer);
    resource.then(function(response){

      service.showSuccess(this, null);

    }, function (error){

      service.showError(this, error);

    });
  }
},
created: function(){

  this.fetchCategories();

  this.genders=[
    {'description': this.translate('people.men'), 'code':'Hombre'},
    {'description':this.translate('people.women'), 'code':'Mujer'}
  ];

  this.types=[
    {'description': this.translate('people.basic'), 'code':1},
    {'description':this.translate('people.premium'), 'code':2}
  ];

}
}
</script>
