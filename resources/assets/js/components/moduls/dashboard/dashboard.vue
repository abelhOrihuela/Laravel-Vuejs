<script>
  export default {
    template: require('./dashboard.html'),
    data: function(){
      return {
        menu: []
      }
    },
    created: function(){
      this.menu=JSON.parse(sessionStorage.getItem('menu'));

    }
  }
</script>
