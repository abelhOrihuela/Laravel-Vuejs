import  service  from '../../js/utilities/service.js';
export default {


  countProperties(context, data){
    var cont=0;
    for(var i in data){
        cont++;
    }
    return cont;
  },
  valid(context, data, size){
    var cont=0;
    for(var i in data){
      if(data[i]){
        cont++;
      }
    }

    if(cont==size){
      return true;
    }else{
      return false;
    }
  }
}
