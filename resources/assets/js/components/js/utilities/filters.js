import  service  from '../../js/utilities/service.js';
import { translations } from '../../js/translate/table.js';
import moment from 'moment'

export default {

  mixins: [
    require('vue-i18n-mixin')
  ],
  translations: translations,



  trueOrFalse(context, value){

    if(value==='1' || value==1 || value == 'S'){
      return "\u2714";
    }else{
      return "\u2717";
    }
  }
  ,
  shortDate(context,date){

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
  },
  customers(context, type){

    if(type=='1' || type==1){
      return 'Basico';
    }else if(type=='2' || type==2){
      return 'Premium';

    }

  },
  admins(context, type){

    if(type=='1' || type==1){
      return 'Usuario';
    }else if(type=='2' || type==2){
      return 'Administrador';

    }

  }

}
