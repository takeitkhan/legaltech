import Vue from 'vue'
import Vuex from 'vuex'
// Modules
import app from './app'
import appConfig from './app-config'
import verticalMenu from './vertical-menu'
import transactions from './transactions'
import reportninepointone from './reportninepointone'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    app,
    appConfig,
    verticalMenu,
    transactions,
    reportninepointone,
  },
  // strict: process.env.DEV,
  state: {
    authUser: null,
    isAuth: false,
    entities: [],
    currentEntity: {},
    AuthUserEntityRole: {},
    isLoaderOpen: false,
    reportDate: null,
    reportDateRange: [],
    // userPermissions: [],
  },
  getters: {
    AUTH_USER_GETTERS(state) {
      return state.authUser
    },
    isAuth(state) {
      return state.isAuth
    },
    GET_ENTITES(state) {
      return state.entities
    },
    GET_AUTH_USER_ENTITY_ROLE(state) {
      return state.AuthUserEntityRole
    },
    GET_CURRENT_ENTITY(state) {
      return state.currentEntity
    },
    errorGetter() {
      throw new Error('Error from Company root getters')
    },
  },
  mutations: {
    SET_AUTH_USER(state, authUser) {
      state.authUser = authUser
      state.isAuth = true
    },
    UPDATE_ENTITES(state, payload) {
      state.entities = payload
    },
    UPDATE_CURRENT_ENTITY(state, payload) {
      state.currentEntity = payload
    },
    UPDATE_IS_LOADER(state, bool) {
      state.isLoaderOpen = bool
    },
    UPDATE_AUTH_USER_ENTITY_ROLE(state, payload) {
      state.AuthUserEntityRole = payload
    },
    UPDATE_REPORT_DATE_RANGE(state, payload) {
      state.reportDateRange = payload
    },
    UPDATE_REPORT_DATE(state, payload) {
      state.reportDate = payload
    },
  },
})
