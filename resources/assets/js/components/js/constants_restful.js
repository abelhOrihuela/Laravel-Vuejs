
/*---------------------------------ROOT API----------------------------------*/
export const API_ROOT= "/api"
export const mixins= [require('vue-i18n-mixin')];

/*-------------------------------RESOURCE HHTP-------------------------------*/
export const HTTP={
  root: API_ROOT,
  headers: {
    'X-CSRF-TOKEN' : document.querySelector('#token').getAttribute('value')
  }
}
/*------------------------------LOGIN ADMINS---------------------------------*/
export const LOGIN_ADMIN= "admin/login"
export const LOGOUT= "logout"
export const ADMINS= "admins"

/*----------------------------CANDIDATE ACADEMIC-----------------------------*/

export const ACADEMIC="academic{/id}"
export const ACADEMIC_NEW="academic/new"
export const ACADEMIC_DELETE="academic/delete{/id}"
export const ACADEMIC_EDIT="academic/edit"

/*---------------------------CANDIDATE EXPERIENCE----------------------------*/
export const EXPERIENCE="experience{/id}"
export const EXPERIENCE_NEW="experience/new"
export const EXPERIENCE_DELETE="experience/delete{/id}"
export const EXPERIENCE_EDIT="experience/edit"

/*---------------------------CANDIDATE EXPERIENCE----------------------------*/
export const EXPERIENCEWTC="experiencewtc{/id}"
export const EXPERIENCEWTC_NEW="experiencewtc/new"
export const EXPERIENCEWTC_DELETE="experiencewtc/delete{/id}"
export const EXPERIENCEWTC_EDIT="experiencewtc/edit"

/*---------------------------CANDIDATE ECONOMIC------------------------------*/
export const ECONOMIC="economic{/id}"
export const ECONOMIC_NEW="economic/new"
export const ECONOMIC_EDIT="economic/edit"

/*-----------------------------------GROUPS---------------------------------*/
export const GROUPS="groups"
export const GROUPNEW="group/new"
export const GROUPCANDIDATES="group/candidates{/id}"
export const DELETE_GROUP_CANDIDATE="group{/id_group}/candidate/delete{/id}"


export const LANGUAGE_NEW="language/new"
export const LANGUAGE_DELETE="language/delete{/id}"

export const IDIOM_NEW="idiom/new"
export const IDIOM_DELETE="idiom/delete{/id}"

export const CUSTOMERS="customers"
