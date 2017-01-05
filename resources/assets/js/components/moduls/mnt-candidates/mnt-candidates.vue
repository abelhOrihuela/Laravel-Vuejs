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
      columns: tableCandidates,
      flagTable: true,
      flagDetailSelected: false,
      locale: 'es',
      showModal: false,
      showNewCandidate: false,
      showPersonalInformation: false,
      showModalPhoto: false,
      optionTab: 0,
      experienceSelect:{}

    }
  },
  methods:{


    getAdmins: function(){

      var resource= this.$resource(candidates);
      resource.get().then((response) => {
        this.candidates=response.body;
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
  },
  created: function(){
    this.getAdmins();
  },
}
</script>
