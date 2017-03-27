<script>
/*-----------------------------------------------------------*/
import ATable from '../../a-components/a-table/a-table.vue';

import AddCandidate from './add-candidate/add-candidate.vue';
import EditCandidate from './edit-candidate/edit-candidate.vue';
import ACandidate from '../../a-components/a-candidate/a-candidate.vue';

import  service  from '../../js/utilities/service.js';
import  filter  from '../../js/utilities/filters.js';
import  runblock  from '../../js/runblock.js';


import { HTTP, candidates, CANDIDATES_SEARCH, CATEGORIES , SUBCATEGORIES, USER_PERMISSIONS } from '../../js/constants_restful.js';
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
    'add-candidate': AddCandidate,
    'edit-candidate': EditCandidate
  },
  filters:{
    trueOrFalse: function(value){
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
      reloadTable: true,
      flagDetailSelected: false,
      locale: 'es',
      showModal: false,
      showNewCandidate: false,
      showEditCandidate: false,
      showPersonalInformation: false,
      showModalPhoto: false,
      optionTab: 0,
      experienceSelect:{},
      showSearchContainer:true,
      showSearch:true,
      permissions:{},
      loading: false,
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
      this.flagDetailSelected=false;
      this.reloadTable=false;
      this.loading=true;

      var search_cand=this.searchCand;

      this.$http.post(CANDIDATES_SEARCH, search_cand)
      .then(function(response){

        this.reloadTable=true;
        this.candidates=response.body;
        this.flagTable=true;
        service.showSuccess(this, "Se encontraron : "+this.candidates.length + " resultados");
        this.loading=false;


      }, function (error){
        service.showError(this, error);
        this.loading=false;

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
      this.showSearchContainer=false;

    },
    beforeEditCandidate: function(){
      console.log("#######################################");

      this.flagTable=false;
      this.flagDetailSelected=false;
      this.showNewCandidate=false;
      this.showSearchContainer=false;
      this.showEditCandidate=true;

    },
    cancelAddCandidate:  function(){
      this.flagDetailSelected=false;
      this.showNewCandidate=false;
      this.showSearchContainer=true;

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
      service.loading(true);


      this.$http.get(CATEGORIES)
      .then(function(response) {
        service.loading(false);


        if(response){
          response.json();
          this.categories= response.body;
        }
      },function(error) {
        service.showError(this, error);
        service.loading(false);

      }
    );
  },
  fetchSubCategories: function(){

    this.searchCand.subcategory='';

    var resource= this.$resource(SUBCATEGORIES);
    var category=this.searchCand.category;
    service.loading(true);


    if(service.validateValue(this,category)){

      resource.get({id : this.searchCand.category })
      .then(function(response){
        service.loading(false);


        this.subcategories= response.body;
      }, function(error){
        service.loading(false);


        service.showError(this, error);
      });

    }



  },
  cleanSearch: function(){

    this.searchCand.category='';
    this.searchCand.subcategory='';
    this.searchCand.salary_expectation_min='';
    this.searchCand.salary_expectation_max='';
    this.flagTable=false;
    this.flagDetailSelected=false;
    this.showSearch=true;
    this.candidates=[];

  },
  getPermissions: function(){

    var user=runblock.getUserSession();
    service.loading(true);

    var resource=this.$http.post(USER_PERMISSIONS, user);
    resource.then(function(response){
      service.loading(false);

      this.permissions=response.body;
    }, function (error){
      service.showError(this, error);
      service.loading(false);

    });
  }
},
created: function(){
  this.fetchCategories();
  this.getPermissions();
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
