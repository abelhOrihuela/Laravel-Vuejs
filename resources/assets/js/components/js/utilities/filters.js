import  service  from '../../js/utilities/service.js';
import moment from 'moment'

export default {



  trueOrFalse(context, value){

    if(value==='1' || value==1 || value == 'S'){
      return "\u2714";
    }else{
      return "\u2717";
    }
  }
  ,
  shortDate(context,date){
    console.log("--------------------");
    console.log(date);
    console.log("--------------------");

    if (date == undefined || date == null) {
      return "--/--/----"
    } else {
      var myDate = moment(date);
      var fec = myDate.format("DD/MM/YYYY");

      if (fec == 'Invalid date') {
        return date;
      }
      else {
        return fec;
      }
    }


  }

}
