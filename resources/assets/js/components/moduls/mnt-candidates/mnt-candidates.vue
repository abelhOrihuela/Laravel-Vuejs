<script>
/*-----------------------------------------------------------*/
import ATable from '../../a-components/a-table/a-table.vue';
import AddCandidate from './add-candidate/add-candidate.vue';
import ACandidate from '../../a-components/a-candidate/a-candidate.vue';

import  service  from '../../js/utilities/service.js';
import  filter  from '../../js/utilities/filters.js';

import { HTTP, candidates } from '../../js/constants_restful.js';
import { translations } from '../../js/translations.js';
import { tableCandidates } from '../../js/config-app/tables.js';


export default{
  /*TEMPLATE*/
  template: require('./mnt-candidates.html'),
  /*RESOURCE HTTP*/
  http:HTTP,
  /*TRANSLATIONS*/
  translations: translations,
  mixins: [require('vue-i18n-mixin')],
  /*PROPERTIES*/
  props:{},
  /*COMPONENTS*/
  components:{
    'a-candidate': ACandidate,
    'a-table': ATable,
    'add-candidate': AddCandidate
  },
  filters:{
    trueOrFalse: function(value){
      console.log(value);
      return filter.trueOrFalse(this,value);
    }
  },

  data: function(){
    return {
      searchQuery: '',
      experiences: [],
      candidates: [],
      categories: [],
      subcategories: [],
      columns: tableCandidates,
      flagTable: false,
      flagDetailSelected: false,
      locale: 'es',
      showModal: false,
      showNewCandidate: false,
      showPersonalInformation: false,
      showModalPhoto: false,
      optionTab: 0,
      experienceSelect:{},
      searchCand:{
        category: '',
        subcategory: ''
      }

    }
  },
  methods:{


    getAdmins: function(){

      var resource= this.$resource(candidates);
      resource.get().then((response) => {
        this.candidates=response.body;
      });

    },
    search: function(){

      var searchCand=this.searchCand;

      console.log("---------------------------");
      console.log(searchCand);
      console.log("---------------------------");

      this.$http.post('candidates/search', searchCand)
      .then(function(response){

      }, function (error){

      });

    }
    ,
    select: function(data){


      this.flagTable=false;
      this.flagDetailSelected=true;
      this.candidateSelected=data;

    },
    showTable: function(){
      this.candidateSelected={};
      this.flagTable=true;
      this.flagDetailSelected=false;
    },
    addCandidate: function(){
      this.flagTable=false;
      this.flagDetailSelected=false;
      this.showNewCandidate=true;

    },
    cancelAddCandidate:  function(){
      this.flagTable=true;
      this.flagDetailSelected=false;
      this.showNewCandidate=false;
    },
    getNewCandidate: function(data){
      this.candidates.push(data);
      this.showNewCandidate=false;
      this.select(data);
    },
    selectTab: function(option){
      this.optionTab=option;
    },
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

    resource.get({id : this.searchCand.category }).then((response) => {
      this.subcategories= response.body;
    });

  }
  },
  created: function(){
    //this.getAdmins();
    this.fetchCategories();
  },
  computed: {
    validation: function () {
      var date = /(\d+)(-|\/)(\d+)(?:-|\/)(?:(\d+)\s+(\d+):(\d+)(?::(\d+))?(?:\.(\d+))?)?/
      var emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      var numberEx=/^[0-9\b]+$/;
      return {

        category: !!this.search.category!='',
        subcategory: !!this.search.subcategory!='',

      }
    },
    isValid: function () {
      var validation = this.validation
      return Object.keys(validation).every(function (key) {
        return validation[key]
      })
    }
  }
}
</script>
