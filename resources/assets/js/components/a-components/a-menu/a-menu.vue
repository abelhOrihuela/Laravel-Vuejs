<script>
import  runblock  from '../../js/runblock.js';
import  service  from '../../js/utilities/service.js';

import { HTTP, LOGOUT} from '../../js/constants_restful.js';

export default{
  template: require('./a-menu.html'),
  http: HTTP,
  data: function(){
    return{
      menu:[],
      loadingV: false,
      menu_dashboard:[],
    }
  },
  methods: {
    logout: function(){

      sessionStorage.clear();
      var router= this.$router;
      router.push({name: 'login'});


      var resource= this.$resource(LOGOUT);
      resource.delete().then(function(response){

        location.reload();

      }, function(error){
        service.showError(this, error);

      });
    },

    loadingView: function(){
      console.log("----");
      if(sessionStorage.getItem('loading')){
        service.showError(this, "");

        return true;
      }
      service.showError(this, "error");

        return false;


    },
  }
  ,created: function(){
    var user=runblock.getUserSession();

    sessionStorage.setItem('menu', JSON.stringify('[]'));
    var aed=[];

    var a={
      a: true
    };

    aed.push(a);
    var e={
      e: true
    };
    aed.push(e);

    var d={
      d: true
    };
    aed.push(d);

    sessionStorage.setItem('aed', JSON.stringify(aed));

    var dashboard={
      name: 'dashboard',
      class: 'glyphicon-th-large',
      description: 'dashboard',
      dashboard:{

      }
    }

    var admins={
      name: 'admins',
      class: 'glyphicon-cog',
      description: 'admins',
      style: 'color: #E94B3B !important;',
      dashboard:{
      }

    }

    var candidates={
      name: 'candidates',
      class: 'glyphicon-user',
      description: 'candidates',
      style: 'color: #F98E33 !important;',
      dashboard:{
      }

    }
    var groups={
      name: 'groups',
      class: 'glyphicon glyphicon-list-alt',
      description: 'groups',
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



    if(user.profile==="A"){

      this.menu.push(dashboard);
      this.menu.push(admins);
      this.menu.push(candidates);
      this.menu.push(customers);
      this.menu.push(groups);

      this.menu_dashboard.push(admins);
      this.menu_dashboard.push(candidates);
      this.menu_dashboard.push(customers);
      this.menu_dashboard.push(groups);

    }else if (user.profile==="C") {
      this.menu.push(dashboard);
      //this.menu.push(admins);
      this.menu.push(candidates);
      //this.menu.push(customers);
      this.menu.push(groups);

      //this.menu_dashboard.push(admins);
      this.menu_dashboard.push(candidates);
      //this.menu_dashboard.push(customers);
      this.menu_dashboard.push(groups);

    }

    sessionStorage.setItem('menu', JSON.stringify(this.menu));

  }
}
</script>
