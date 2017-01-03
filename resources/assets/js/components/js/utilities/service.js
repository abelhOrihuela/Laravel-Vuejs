
import Toast from 'vue-toast-mobile';
export default {

  /**
  *return inxex object in to list
  */
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

  /**
  *show toast success
  */
  showSuccess(context,  message){

    if(message==null || message==undefined){
      message='Operacion Exitosa';
    }

    Toast({
      message: message,
      position: 'success',
      iconClass: 'glyphicon glyphicon-ok',
      duration: 4000
    });

  },
  /**
  *show toast error
  */
  showError(context,  message){
    Toast({
      message: message,
      position: 'error',
      iconClass: 'glyphicon glyphicon-fire',
      duration: 4000
    });
  },
  /**
  *show toast warning
  */
  showWarning(context,  message){
    Toast({
      message: message,
      position: 'warning',
      iconClass: 'glyphicon glyphicon-warning-sign',
      duration: 4000
    });
  },
  /**
  *validate value data
  */
  validateValue(context, data){
    if(data!=null && data!=undefined && data!=''){
      return true;
    }
    return false;
  },

  equals: function(context,x, y){


    if (Object.keys(x).length != Object.keys(y).length){

      return false;
    }




    for (var p in x)
    {
      if ( x.hasOwnProperty(p) && y.hasOwnProperty(p) ){
        if( x[p] != y[p]){
          return false;
        }
      }
    }

    return true;
  },
  clone:  function(obj) {
    var copy;

    // Handle the 3 simple types, and null or undefined
    if (null == obj || "object" != typeof obj) return obj;

    // Handle Date
    if (obj instanceof Date) {
      copy = new Date();
      copy.setTime(obj.getTime());
      return copy;
    }

    // Handle Array
    if (obj instanceof Array) {
      copy = [];
      for (var i = 0, len = obj.length; i < len; i++) {
        copy[i] = this.clone( obj[i]);
      }
      return copy;
    }

    // Handle Object
    if (obj instanceof Object) {
      copy = {};
      for (var attr in obj) {
        if (obj.hasOwnProperty(attr)) copy[attr] = this.clone(obj[attr]);
      }
      return copy;
    }

    throw new Error("Unable to copy obj! Its type isn't supported.");
  }
}
