<script>
import  runblock  from '../../js/runblock.js';

export default{
  template: require('./a-menu.html'),
  data: function(){
    return{
      menu:[],
      menu_dashboard:[],}
  },
  methods: {
    logout: function(){

      sessionStorage.clear();

      var router= this.$router;
      router.push({name: 'login'});
    }
  }
  ,created: function(){
    var user=runblock.getUserSession();

    var dashboard={
      name: 'dashboard',
      class: 'glyphicon-th-large',
      description: 'Dashboard',
      dashboard:{

      }
    }

    var admins={
      name: 'admins',
      class: 'glyphicon-cog',
      description: 'Administradores',
      style: 'color: #E94B3B !important;',
      dashboard:{
      }

    }

    var candidates={
      name: 'candidates',
      class: 'glyphicon-user',
      description: 'Candidates',
      style: 'color: #F98E33 !important;',
      dashboard:{
      }

    }
    var groups={
      name: 'groups',
      class: 'glyphicon-modal-window',
      description: 'Grupos',
      style: 'color: #23AE89 !important;',
      dashboard:{
      }

    }

    var customers={
      name: 'customers',
      class: 'glyphicon-briefcase',
      description: 'customers',
      style: 'color: #1C7EBB !important;',
      dashboard:{
      }

    }

    this.menu.push(dashboard);
    this.menu.push(admins);
    this.menu.push(candidates);
    this.menu.push(customers);
    this.menu.push(groups);

    this.menu_dashboard.push(admins);
    this.menu_dashboard.push(candidates);
    this.menu_dashboard.push(customers);
    this.menu_dashboard.push(groups);
    

    sessionStorage.setItem('menu', JSON.stringify(this.menu_dashboard));


    if(user.profile==="A"){
    }else if (user.profile==="C") {
    }
  }
}
</script>
