<script>

import { translations } from '../../js/translations.js';
import  filter  from '../../js/utilities/filters.js';
import  service  from '../../js/utilities/service.js';
import  runblock  from '../../js/runblock.js';

import { HTTP , GROUPS, mixins, GROUPCANDIDATES, USER_PERMISSIONS} from '../../js/constants_restful.js';

import ATable from '../../a-components/a-table/a-table.vue';
import ACandidate from '../../a-components/a-candidate/a-candidate.vue';
import { tableGroups } from '../../js/config-app/tables.js';
import { tableCandidates } from '../../js/config-app/tables.js';

import AddGroup from './add-group/add-group.vue';
import EditGroup from './edit-group/edit-group.vue';
import DeleteGroup from './delete-group/delete-group.vue';

export default {
  template: require('./mnt-groups.html'),
  http:HTTP,
  translations: translations,
  mixins: mixins,
  components:{
    'a-table': ATable,
    'a-candidate': ACandidate,
    'add-group': AddGroup,
    'edit-group': EditGroup,
    'delete-group': DeleteGroup
  },
  data: function () {
    return {
      groups:[],
      columns:tableGroups,
      columnsCandidates:tableCandidates,
      groupSelect:null,
      groupClone :null,
      flagShowTable: true,
      flagDetailSelected: false,
      flagDetailSelectedCandidate: false,
      flagShowTableCandidates: false,
      flagAddGroup: false,
      flagEditGroup: false,
      flagDeleteGroup: false,
      candidates: [],
      permissions: {},
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
      this.groupClone=service.clone(entry);
      this.flagEditGroup=false;
      this.getCandidates(entry.id);

    },

    showTable: function(){
      this.groupSelect=null;
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
      this.select(entry);

    },

    beforeEditGroup(){
      this.flagEditGroup=true;
    },

    afterEditGroup: function(entry){
      if(entry!=null){
        var index=service.getIndiceObject(this, this.groups, 'id', entry.id);
        if(index>-1){
          entry.descrCategory=entry.category_group.name;
          entry.descrSubCategory=entry.subcategory_group.name;
          this.select(entry);
          this.groups[index]=entry;
        }
      }
    },
    beforeDeleteGroup: function(){
      this.flagDeleteGroup=true;


    },
    afterDeleteGroup: function(valido){

      if(valido){
        var index=service.getIndiceObject(this, this.groups, 'id', this.groupSelect.id );
        if(index>-1){
          this.groups.splice(index, 1);
        }

        this.showTable();
      }
    },
    getPermissions: function(){

      var user=runblock.getUserSession();

      var resource=this.$http.post(USER_PERMISSIONS, user);
      resource.then(function(response){
        this.permissions=response.body;
      }, function (error){
        service.showError(this, error);
      });
    }
  },
  created: function(){
    this.getGroups();
    this.getPermissions();
  },
  filters:{
    trueOrFalse: function(value){

      return filter.trueOrFalse(this,value);
    },

    shortDate: function(value){

      return filter.shortDate(this,value);
    }
  }
}
</script>
