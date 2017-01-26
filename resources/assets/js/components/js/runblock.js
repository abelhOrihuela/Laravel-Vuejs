
export default {

/*
* RUNBLOCK :
* config runblock load variables session
* get config session
*/


/**
*load type profile A/C
*/
  loadProfile(data){
    sessionStorage.setItem('profile', data.type);
  },

  /*
  *return type_profile
  */
  getProfile(){
    return sessionStorage.getItem('profile');
  },
  /*
  * load user session
  */
  loadUserSession(data){

    sessionStorage.setItem('type_profile', data.user.type);
    sessionStorage.setItem('username', data.user.email);

  },

  /*
  * return load user session
  */
  getUserSession(){

    var user=new Object();

    user={
      profile: sessionStorage.getItem('profile'),
      username: sessionStorage.getItem('username'),
      type_profile: sessionStorage.getItem('type_profile')
    }
    return user;
  }
}
