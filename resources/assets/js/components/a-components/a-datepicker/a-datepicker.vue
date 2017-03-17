<script>
import moment from 'moment'

export default{
  template: require('./a-datepicker.html'),
  props: ['value', 'id', 'format'],
  data: function(){
    return{
      dateInput: ''
    }
  },
  methods: {
    updateValue: function (value) {
      this.$emit('input',value)
    }
  },
  created: function(){

    console.log("--------value--------");
    console.log(this.value);

  if(this.value!=null && this.value!=undefined && this.value!=''){
    this.dateInput = moment(this.value).format("DD/MM/YYYY");
    this.$emit('input',this.dateInput)
  }



  },
  mounted: function() {

    var here=this;

    $(this.$refs.input).datepicker({
      dateFormat: "dd/mm/yy",
      onClose:  function (date) {

        here.updateValue(date);

      }

    });
  }
}
</script>
