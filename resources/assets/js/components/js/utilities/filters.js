import  service  from '../../js/utilities/service.js';
export default {

  trueOrFalse(context, value){

    if(value==='1' || value==1){
        return "\u2714";
    }else{
      return "\u2717";
    }
  }
}
