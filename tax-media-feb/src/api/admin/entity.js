import Api from '../Api'
import adminConfig from './adminConfig'

export default {
  entities() {
    return Api().get(adminConfig.entitiesEndpoint)
  },
  entity(entityId) {
    return Api().get(`${adminConfig.entityDetailEndpoint}/${entityId}`)
  },

}
