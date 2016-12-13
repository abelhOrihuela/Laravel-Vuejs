export const http={
  root: '/api',
  headers: {
    'X-CSRF-TOKEN' : document.querySelector('#token').getAttribute('value')
  }
}

export const apiRoot= "/api"
export const loginAdmin= "admin/login"
export const admins= "admins"
export const candidates= "candidates"
export const candidates_admin="admin/candidates{/id}"
export const candidates_experince="candidate{/id}"
