
/*---------------------------------ROOT API----------------------------------*/
export const apiRoot= "/api"

/*-------------------------------RESOURCE HHTP-------------------------------*/
export const HTTP={
  root: apiRoot,
  headers: {
    'X-CSRF-TOKEN' : document.querySelector('#token').getAttribute('value')
  }
}
/*------------------------------LOGIN ADMINS---------------------------------*/
export const loginAdmin= "admin/login"
export const admins= "admins"
export const ADMINS= "admins"
export const candidates= "candidates"
export const candidates_admin="admin/candidates{/id}"
export const candidates_experince="candidate{/id}"

/*----------------------------CANDIDATE ACADEMIC-----------------------------*/
export const ACADEMIC_NEW="academic/new"
export const ACADEMIC_DELETE="academic/delete{/id}"
export const ACADEMIC_EDIT="academic/edit"

/*---------------------------CANDIDATE EXPERIENCE---------------------------*/
export const EXPERIENCE_NEW="experience/new"
export const EXPERIENCE_DELETE="experience/delete{/id}"
export const EXPERIENCE_EDIT="experience/edit"

/*---------------------------CANDIDATE EXPERIENCE---------------------------*/
export const EXPERIENCEWTC_NEW="experiencewtc/new"
export const EXPERIENCEWTC_DELETE="experiencewtc/delete{/id}"
export const EXPERIENCEWTC_EDIT="experiencewtc/edit"
