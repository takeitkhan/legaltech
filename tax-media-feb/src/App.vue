<template>
  <div
    id="app"
    class="h-100"
    :class="[skinClasses]"
  >

    <component :is="layout">
      <router-view />
    </component>
    <loader v-if="isLoaderOpen" />
  </div>
</template>

<script>

// This will be populated in `beforeCreate` hook
import { $themeColors, $themeBreakpoints, $themeConfig } from '@themeConfig'
import { provideToast } from 'vue-toastification/composition'
import { watch } from '@vue/composition-api'
import useAppConfig from '@core/app-config/useAppConfig'
import authConfig from '@/api/auth/authConfig'
import { useWindowSize, useCssVar } from '@vueuse/core'
import { mapState } from 'vuex'
import AuthApi from '@/api/auth/AuthApi'
import store from '@/store'
import Loader from '@/layouts/components/Loader.vue'

const LayoutVertical = () => import('@/layouts/vertical/LayoutVertical.vue')
const LayoutHorizontal = () => import('@/layouts/horizontal/LayoutHorizontal.vue')
const LayoutFull = () => import('@/layouts/full/LayoutFull.vue')

export default {
  components: {
    LayoutHorizontal,
    LayoutVertical,
    LayoutFull,
    Loader,

  },
  // ! We can move this computed: layout & contentLayoutType once we get to use Vue 3
  computed: {
    layout() {
      if (this.$route.meta.layout === 'full') return 'layout-full'
      return `layout-${this.contentLayoutType}`
    },
    contentLayoutType() {
      return this.$store.state.appConfig.layout.type
    },
    ...mapState(['isLoaderOpen']),
  },
  beforeCreate() {
    // Set colors in theme
    const colors = ['primary', 'secondary', 'success', 'info', 'warning', 'danger', 'light', 'dark']

    // eslint-disable-next-line no-plusplus
    for (let i = 0, len = colors.length; i < len; i++) {
      $themeColors[colors[i]] = useCssVar(`--${colors[i]}`, document.documentElement).value.trim()
    }

    // Set Theme Breakpoints
    const breakpoints = ['xs', 'sm', 'md', 'lg', 'xl']

    // eslint-disable-next-line no-plusplus
    for (let i = 0, len = breakpoints.length; i < len; i++) {
      $themeBreakpoints[breakpoints[i]] = Number(useCssVar(`--breakpoint-${breakpoints[i]}`, document.documentElement).value.slice(0, -2))
    }

    // Set RTL
    const { isRTL } = $themeConfig.layout
    document.documentElement.setAttribute('dir', isRTL ? 'rtl' : 'ltr')
  },
  mounted() {
    this.setAuthUser()
  },
  methods: {
    async setAuthUser() {
      // console.log(this.$router.currentRoute.name)
      // please check current route
      if (this.$router?.currentRoute?.name === 'login') {
        return
      }
      try {
        const { data: { user } } = await AuthApi.user()
        this.$store.commit('SET_AUTH_USER', user)
        if (user?.entities?.length) {
          this.$store.commit('UPDATE_CURRENT_ENTITY', user.entities[0])
          // if user has entity role then update current entity
          const role = user.main_role.find(rol => rol.user_role?.entity_id === user?.entities?.[0].id)
          if (role) {
            this.$store.commit('UPDATE_AUTH_USER_ENTITY_ROLE', role)
          }
        }
      } catch {
        localStorage.removeItem(authConfig.storageTokenKeyName)
        this.$router.push({ name: 'login' })
      }
    },
  },
  setup() {
    const { skin, skinClasses } = useAppConfig()

    // If skin is dark when initialized => Add class to body
    if (skin.value === 'dark') document.body.classList.add('dark-layout')

    // Provide toast for Composition API usage
    // This for those apps/components which uses composition API
    // Demos will still use Options API for ease
    provideToast({
      hideProgressBar: true,
      closeOnClick: false,
      closeButton: false,
      icon: false,
      timeout: 3000,
      transition: 'Vue-Toastification__fade',
    })

    // Set Window Width in store
    store.commit('app/UPDATE_WINDOW_WIDTH', window.innerWidth)
    const { width: windowWidth } = useWindowSize()
    watch(windowWidth, val => {
      store.commit('app/UPDATE_WINDOW_WIDTH', val)
    })

    return {
      skinClasses,
    }
  },
}
</script>

<style>
/* @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,600;0,900;1,300&display=swap'); */
.text-rose-500{
  color:#f43f5e;
}
.border-gray-200{
  border-color: rgb(229 231 235);
}
.bg-gray-50{
  background:rgb(249 250 251);
}
.folder-color{
    color:#F37C23;
}
</style>
