<script>

import ATable from '../../a-components/a-table/a-table.vue';
import AddCandidate from './add-candidate/add-candidate.vue'



import Toast from 'vue-toast-mobile';
import { candidates, candidates_experince } from '../../js/constants_restful.js';
import { translations } from '../../js/translations.js';
import { tableCandidates , tableExperience} from '../../js/config-app/tables.js';


export default{

  template: require('./mnt-candidates.html'),
  translations: translations,
  mixins: [
    require('vue-i18n-mixin')
  ],
  props:{

  },

  components:{
    'a-table': ATable,
    'add-candidate': AddCandidate

  },

  data: function(){
    return {
      searchQuery: '',
      experiences: [],
      candidates: [],
      columns: tableCandidates,
      columnsExperience: tableExperience,
      flagTable: true,
      flagDetailSelected: false,
      locale: 'es',
      showModal: false,
      showNewCandidate: false
    }

  },


  http: {
    root: '/api',
    headers: {
      'X-CSRF-TOKEN' : document.querySelector('#token').getAttribute('value')
    }
  },

  methods:{

    /*function: fetchImageProfile
    *
    * Get image profile
    *
    */
    getAdmins: function(){

      var resource= this.$resource(candidates);
      resource.get().then((response) => {
        this.candidates=response.body;
      });

    },
    getExperience: function(id){
      var resource= this.$resource(candidates_experince);
      resource.get({id: id}).then((response) => {
        this.experiences=response.body;
      });
    }
    ,
    select: function(entry){
      this.candidateSelected=entry;
      this.flagTable=false;
      this.flagDetailSelected=true;
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
    getNewCandidate: function(entry){
      this.candidates.push(entry);
      this.showNewCandidate=false;
      this.select(entry);
    }
  },
  created: function(){
    this.getAdmins();
  },
}
</script>
