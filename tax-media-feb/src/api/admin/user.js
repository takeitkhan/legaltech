import Api from '../Api'
import adminConfig from './adminConfig'

export default {
  entitesforNewUser() {
    return Api().get(adminConfig.entitiesForNewUserEndpoint)
  },
  addNewUser(form) {
    return Api().post(adminConfig.addNewUserEndpoint, form)
  },
  deleteUser(entityId, userId) {
    return Api().post(`${adminConfig.deleteUserEndpoint}/${entityId}/${userId}`)
  },
  updateUser(form) {
    return Api().post(adminConfig.updateUserEndpoint, form)
  },
  updateProfile(form) {
    return Api().post(adminConfig.updateprofileEndPoint, form)
  },
  users(entityId) {
    return Api().get(`${adminConfig.usersEndpoint}/${entityId}`)
  },
  getUserViaPhone(phone) {
    return Api().get(`${adminConfig.getUserViaPhoneEndpoint}/${phone}`)
  },
  getUserViaId(entityId, id) {
    return Api().get(`${adminConfig.getUserViaIdEndpoint}/${entityId}/${id}`)
  },
}
