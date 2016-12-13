
import Toast from 'vue-toast-mobile';
export default {


  getIndiceObject(context, list ,property,data){
    for (var i = 0; i < list.length; i++) {
      if(list[i].hasOwnProperty(property)){
        if(list[i][property]===data){
          return i;
          break;
        }
      }
    }
    return -1;
  },

  showSuccess(context,  message){

    Toast({
      message: message,
      position: 'success',
      iconClass: 'glyphicon glyphicon-ok',
      duration: 4000
    });

  },
  showError(context,  message){
    Toast({
      message: message,
      position: 'error',
      iconClass: 'glyphicon glyphicon-fire',
      duration: 4000
    });
  },
  showWarning(context,  message){
    Toast({
      message: message,
      position: 'warning',
      iconClass: 'glyphicon glyphicon-warning-sign',
      duration: 4000
    });
  },
  validateValue(context, data){
    if(data!=null && data!=undefined && data!=''){
      return true;
    }
    return false;
  }
}
