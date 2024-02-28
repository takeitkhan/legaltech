import axios from 'axios'
import authConfig from './auth/authConfig'
import apiConfig from './apiConfig'

const BaseApi = axios.create({
  baseURL: apiConfig.baseURL,
})

const Api = function () {
  const token = localStorage.getItem(authConfig.storageTokenKeyName)
  if (token) {
    BaseApi.defaults.headers.common.Authorization = `${authConfig.tokenType} ${token}`
  }
  BaseApi.defaults.headers.common['Content-Type'] = 'application/form-data'
  BaseApi.defaults.headers.common['Access-Control-Allow-Origin'] = '*'
  BaseApi.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
  BaseApi.defaults.headers.common['Access-Control-Allow-Headers'] = 'Origin,X-Requested-With,Accept,Authorization,Content-Type'
  return BaseApi
}

export default Api
