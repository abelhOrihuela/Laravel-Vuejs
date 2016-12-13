import  service  from '../../js/utilities/service.js';
export default {

  trueOrFalse(context, value){
    console.log(value);
    console.log(service.validateValue(value));
    if(value>0){
        return "\u2714";
    }else{
      return "\u2717";
    }
  }
}
