import Api from '../Api'
import adminConfig from './adminConfig'

export default {
  roles() {
    return Api().get(adminConfig.rolesEndpoint)
  },
  modules() {
    return Api().get(adminConfig.modulesEndpoint)
  },
  permissions() {
    return Api().get(adminConfig.permissionsEndpoint)
  },
}
