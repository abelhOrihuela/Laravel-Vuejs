<script>
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

  }
},


}
</script>
