<script>

import  validate  from '../../../js/utilities/validate.js';


import { translations } from '../../../js/translations.js';
import  service  from '../../../js/utilities/service.js';
import { HTTP, ECONOMIC_EDIT} from '../../../js/constants_restful.js';

export default{

  template: require('./edit-candidate.html'),
  props:{
    candidate: Object
  },

  translations: translations,
  mixins: [require('vue-i18n-mixin')],

  data: function(){
    return {
      locale: 'es',
      categories: [],
      subcategories:[],
      genders:[]
    }

  }
  ,
  http:HTTP
  ,
  created: function(){
    this.fetchCategories();
  },
  computed: {
    validation: function () {
      var date = /(\d+)(-|\/)(\d+)(?:-|\/)(?:(\d+)\s+(\d+):(\d+)(?::(\d+))?(?:\.(\d+))?)?/
      var emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      var numberEx=/^[0-9\b]+$/;
      return {
        username: !!this.candidate.username.trim(),
        email: emailRE.test(this.candidate.email),
        code: numberEx.test(this.candidate.code),
        phone: numberEx.test(this.candidate.phone),
        birthday: date.test(this.candidate.birthday),
        position: !!this.candidate.position.trim(),
        category: !!this.candidate.category!='',
        subcategory: !!this.candidate.subcategory!='',
        location: !!this.candidate.location!='',
        gender: !!this.candidate.gender!='',
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
    fetchCategories: function(){
      service.loading(true);

      this.$http.get('categories' )
      .then((response) => {
        if(response){
          response.json();
          this.categories= response.body;

        }
        service.loading(false);

      },(error) => {
        service.loading(false);


      }
    );
  },
  fetchSubCategories: function(){
    service.loading(true);

    var resource= this.$resource('subcategories{/id}');

    resource.get({id : this.candidate.category }).then((response) => {
      this.subcategories= response.body;
      service.loading(false);

    });

  },
  newCandidate: function(){
    var candidate = this.candidate;
    service.loading(true);

    this.$http.post('candidate/new', candidate)
    .then(function(response){

      this.getCandidateNew(response.body);
      service.loading(false);


    }, function (error){
      service.loading(false);


    });
  },
  getCandidateNew: function($id){
    service.loading(true);

    var resource= this.$resource('candidate{/id}');

    resource.get({id : $id }).then((response) => {
    //  this.getcandidate(response.body);
      service.loading(false);

    });

  },
  formIsValid: function(){
    return validate.valid(this,this.validation, validate.countProperties(this,this.validation));
  }

},
created: function(){

  this.fetchCategories();

  this.genders=[
    {'description': this.translate('people.men'), 'code':'Hombre'},
    {'description':this.translate('people.women'), 'code':'Mujer'}
  ];
}
}
</script>
