<script>
import  runblock  from '../../js/runblock.js';

export default{
  template: require('./a-menu.html'),
  data: function(){
    return{ menu:[]}
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
      description: 'Dashboard'
    }

    var admins={
      name: 'admins',
      class: 'glyphicon-cog',
      description: 'Administradores'
    }

    var candidates={
      name: 'candidates',
      class: 'glyphicon-user',
      description: 'Candidates'
    }
    var groups={
      name: 'groups',
      class: 'glyphicon-modal-window',
      description: 'Grupos'
    }

    var customers={
      name: 'candidates',
      class: 'glyphicon-briefcase',
      description: 'customers'
    }

    this.menu.push(dashboard);
    this.menu.push(admins);
    this.menu.push(candidates);
    this.menu.push(customers);
    this.menu.push(groups);

    if(user.profile==="A"){

    }else if (user.profile==="C") {

    }
  }
}
</script>
