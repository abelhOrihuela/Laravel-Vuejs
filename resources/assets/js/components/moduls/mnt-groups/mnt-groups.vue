<script>

import { translations } from '../../js/translations.js';
import  filter  from '../../js/utilities/filters.js';
import  service  from '../../js/utilities/service.js';
import { HTTP , GROUPS, mixins, GROUPCANDIDATES} from '../../js/constants_restful.js';

import ATable from '../../a-components/a-table/a-table.vue';
import ACandidate from '../../a-components/a-candidate/a-candidate.vue';
import { tableGroups } from '../../js/config-app/tables.js';
import { tableCandidates } from '../../js/config-app/tables.js';

import AddGroup from './add-group/add-group.vue';



export default {
  template: require('./mnt-groups.html'),
  http:HTTP,
  translations: translations,
  mixins: mixins,
  components:{
    'a-table': ATable,
    'a-candidate': ACandidate,
    'add-group': AddGroup
  },
  data: function () {
    return {
      groups:[],
      columns:tableGroups,
      columnsCandidates:tableCandidates,
      groupSelect:null,
      flagShowTable: true,
      flagDetailSelected: false,
      flagDetailSelectedCandidate: false,
      flagShowTableCandidates: false,
      flagAddGroup: false,
      candidates: [],
      candidateSelected: {},
      locale: 'es'
    }
  },
  methods: {

    getGroups: function(){

      var resource= this.$resource(GROUPS);
      resource.get().then(function(response){

        response.body.forEach(function(entry) {

          entry.descrCategory=entry.category_group.name;
          entry.descrSubCategory=entry.subcategory_group.name;

          this.groups.push(entry);

        }, this);


      }, function(error){

        service.showError(this, error);


      });

    },
    select: function(entry){
      this.candidates=[];

      this.flagDetailSelected=true;
      this.flagShowTableCandidates=true;


      this.flagShowTable=false;



      this.groupSelect=entry;

      this.getCandidates(entry.id);

    },
    showTable: function(){
      this.groupSelect={};
      this.flagShowTable=true;
      this.flagDetailSelected=false;
      this.flagShowTableCandidates=false;
      this.flagDetailSelectedCandidate=false;
        this.flagShowTableCandidates=false;
    },
    getCandidates: function(id){


      var resource= this.$resource(GROUPCANDIDATES);
      resource.get({id: id}).then(function(response){

          this.candidates=response.body.candidates;

      }, function(error){
        service.showError(this, null);
      });



    },
    selectCandidate: function(entry){
      this.flagDetailSelectedCandidate=true;
        this.flagShowTableCandidates=false;
      this.candidateSelected=entry;

    },
    showTableCandidates: function(){
      this.flagDetailSelectedCandidate=false;
        this.flagShowTableCandidates=true;
    },
    beforeAddGroup(){
      this.flagAddGroup=true;
    },
    afterAddGroup(entry){

      entry.descrCategory=entry.category_group.name;
      entry.descrSubCategory=entry.subcategory_group.name;
      
      this.groups.push(entry);
    }

  },
  created: function(){
    this.getGroups();
  }

}
</script>
