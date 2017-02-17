<script>
  export default{
    template: require('./a-datepicker.html'),
    props: {
    date: {
      twoWay: true
    }
  },

  created: function()
  {

    /*
    console.log(jQuery.datetimepicker);
    jQuery.datetimepicker.setLocale('es');
    var calendar=jQuery('#datetimepicker').datetimepicker();

    console.log(calendar);
    */
  }
  }
</script>
