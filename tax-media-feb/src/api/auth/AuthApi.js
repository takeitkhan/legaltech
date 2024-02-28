import Api from '../Api'
import authConfig from './authConfig'

export default {
  login(form) {
    return Api().post(authConfig.loginEndpoint, form)
  },
  user() {
    return Api().get(authConfig.authUserEndpoint)
  },
  logout() {
    return Api().post(authConfig.logoutEndpoint)
  },
}
