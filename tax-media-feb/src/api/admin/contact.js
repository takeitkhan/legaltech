import Api from '../Api'
import adminConfig from './adminConfig'

export default {
  contacts() {
    return Api().get(adminConfig.contactsEndpoint)
  },
  show(contactId) {
    return Api().get(`${adminConfig.singleContactEndpoint}/${contactId}`)
  },
  store(form) {
    return Api().post(`${adminConfig.storeContactEndpoint}`, form)
  },
  update(contactId, form) {
    return Api().post(`${adminConfig.updateContactEndpoint}/${contactId}`, form)
  },

}
