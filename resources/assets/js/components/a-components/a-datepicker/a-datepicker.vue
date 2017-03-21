<script>
import moment from 'moment'
export default{
  template: require('./a-datepicker.html'),
  props: ['value', 'id', 'format'],
  data: function(){
    return{
      dateInput: '',
      formatDatePicker:''
    }
  },
  methods: {
    updateValue: function (value) {
      this.$emit('input',value)
    }
  },
  created: function(){
    if(this.value!=null && this.value!=undefined && this.value!=''){
      this.dateInput = moment(this.value).format(this.format);
      this.$emit('input',this.dateInput)
    }
    if(this.format){
      if(this.format=="DD/MM/YYYY"){
        this.formatDatePicker="dd/mm/yy";
      }else if(this.format=="YYYY"){
        this.formatDatePicker="yy";
      }
    }
  },
  mounted: function() {
    var here=this;

    $(this.$refs.input).datepicker({
      dateFormat: here.formatDatePicker,
      monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'], // set month names
      onClose:  function (date) {
        here.updateValue(date);
      }
    });
  }
}
</script>
