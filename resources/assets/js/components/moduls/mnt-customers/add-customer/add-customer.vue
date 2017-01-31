<script>
import  validate  from '../../../js/utilities/validate.js';
import { translations } from '../../../js/translations.js';
import  service  from '../../../js/utilities/service.js';
import { HTTP, ECONOMIC_EDIT} from '../../../js/constants_restful.js';


    export default{

      template: require('./add-customer.html'),
      translations: translations,
      http:HTTP
      ,
      props:{
before: Function
      },
      mixins: [require('vue-i18n-mixin')],
      data: function(){
        return{
          customer: {
            username:   '',
            gender: '',
            email:  '',
            password: '',
            password_confirm:   '',
            company:   '',
            category:'',
            subcategory: '',
            type:   '',
            comments: ''

          },
          locale: 'es',
          categories: [],
          subcategories:[],
          genders:[],
          types: []
        }
      },
      computed: {
        validation: function () {
          var date = /(\d+)(-|\/)(\d+)(?:-|\/)(?:(\d+)\s+(\d+):(\d+)(?::(\d+))?(?:\.(\d+))?)?/
          var emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          var numberEx=/^[0-9\b]+$/;
          return {
            username: !!this.customer.username.trim(),
            gender: !!this.customer.gender!='',
            email: emailRE.test(this.customer.email),
            password: (this.customer.password!='' && this.customer.password.length>5),
            password_confirm: (this.customer.password_confirm==this.customer.password) && this.customer.password_confirm!='',
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
      methods: {
        fetchCategories: function(){

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

        resource.get({id : this.customer.category }).then((response) => {
          this.subcategories= response.body;
        });

      },
      newCustomer: function(){
        var customer = this.customer;

        this.$http.post('customer/new', customer)
        .then(function(response){

          this.before(response.body);


        }, function (error){

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
