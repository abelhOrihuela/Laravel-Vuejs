
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
export const CANDIDATES_SEARCH= "candidates/search"
export const CATEGORIES= "categories"
export const SUBCATEGORIES= "subcategories{/id}"
export const USER_PERMISSIONS= "user/permissions"

export const IMAGE_PROFILE= "image/profile"

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
export const GROUP_NEW="group/new"
export const GROUP_EDIT="group/edit"
export const GROUP_DELETE="group/delete{/id}"


export const GROUP_CANDIDATE_NEW="group/candidate/new"
export const GROUPCANDIDATES="group/candidates{/id}"
export const DELETE_GROUP_CANDIDATE="group{/id_group}/candidate/delete{/id}"

/*---------------------------------LANGUAGES-------------------------------*/
export const LANGUAGE_NEW="language/new"
export const LANGUAGE_DELETE="language/delete{/id}"

/*----------------------------------IDIOMS--------------------------------*/
export const IDIOM_NEW="idiom/new"
export const IDIOM_DELETE="idiom/delete{/id}"

export const CUSTOMERS="customers"
export const CUSTOMER_EDIT="customer/edit"
export const CUSTOMER_DELETE="customer/delete{/id}"
