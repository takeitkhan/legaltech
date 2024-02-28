import { ref } from '@vue/composition-api'
import AuthApi from '@/api/auth/AuthApi.js'
import authConfig from '@/api/auth/authConfig'

export default function UseLogin(root, route) {
  const form = ref({
    email: null,
    password: null,
    remember_me: false,
  })
  const Login = async () => {
    const formData = new FormData()
    formData.append('email', form.value.email)
    formData.append('password', form.value.password)
    formData.append('remember_me', form.value.remember_me)
    console.log(root)
    try {
      const { data: { data } } = await AuthApi.login(formData)
      localStorage.setItem(authConfig.storageTokenKeyName, data.token)
      root.$store.commit('UPDATE_IS_AUTHENTICATED_USER', true)
      root.$store.commit('UPDATE_AUTH_USER', data.user)
      route.push({ name: 'dashboard' })
    } catch {
      console.log('some error occured Please try again!!')
    }
  }
  return {
    Login,
    form,
  }
}
