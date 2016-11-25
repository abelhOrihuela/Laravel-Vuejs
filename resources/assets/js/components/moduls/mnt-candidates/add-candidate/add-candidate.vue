<script>

import  validate  from '../../../js/utilities/validate.js';

export default{

  template: require('./add-candidate.html'),
  props:{
    getcandidate: Function
  },

  data: function(){
    return {
      candidate: {
        username:   '',
        gender: '',
        email:  '',
        location:   '',
        birthday: '',
        code:   '',
        phone:   '',
        position: '',
        category:'',
        subcategory: ''
      },
      categories: [],
      subcategories:[]
    }
  }
  ,
  http: {
    root: '/api',
    headers: {
      'X-CSRF-TOKEN' : document.querySelector('#token').getAttribute('value')
    }
  }
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

    resource.get({id : this.candidate.category }).then((response) => {
      this.subcategories= response.body;
    });

  },
  newCandidate: function(){
    var candidate = this.candidate;

    this.$http.post('candidate/new', candidate)
    .then(function(response){
      console.log("---------------------------------");
      console.log(response.body);
      console.log("---------------------------------");

      this.getCandidateNew(response.body);


    }, function (error){

    });
  },
  getCandidateNew: function($id){

    var resource= this.$resource('candidate{/id}');

    resource.get({id : $id }).then((response) => {
      this.getcandidate(response.body);
    });

  },
  formIsValid: function(){
    return validate.valid(this,this.validation, 9);
  }

},


}
</script>
