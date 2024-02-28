import authConfig from '@/api/auth/authConfig'
import Vue from 'vue'
import VueRouter from 'vue-router'

import companies from '@/router/companies'
import profile from '@/router/profile'
import admin from '@/router/admin'
import report from '@/router/report'
import Login from '@/views/Login.vue'
import Dashboard from '@/views/Dashboard.vue'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  scrollBehavior() {
    return { x: 0, y: 0 }
  },
  routes: [
    ...companies,
    ...profile,
    ...admin,
    ...report,
    {
      path: '/login',
      name: 'login',
      // component: () => import('@/views/Login.vue'),
      component: Login,
      meta: {
        layout: 'full',
        guard: true,
      },
    },
    {
      path: '/',
      name: 'home',
      // component: () => import('@/views/Dashboard.vue'),
      component: Dashboard,
      meta: {
        auth: true,
      },
    },
    // {
    //   path: '/second-page',
    //   name: 'second-page',
    //   component: () => import('@/views/SecondPage.vue'),
    //   meta: {
    //     pageTitle: 'Second Page',
    //     breadcrumb: [
    //       {
    //         text: 'Second Page',
    //         active: true,
    //       },
    //     ],
    //     auth: true,
    //   },
    // },

    {
      path: '/error-404',
      name: 'error-404',
      component: () => import('@/views/error/Error404.vue'),
      meta: {
        layout: 'full',
        auth: true,
        guard: true,
      },
    },

    {
      path: '*',
      redirect: 'error-404',
    },

  ],
})

// ? For splash screen
// Remove afterEach hook if you are not using splash screen
router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
  if (appLoading) {
    appLoading.style.display = 'none'
  }
})

router.beforeEach(async (to, from, next) => {
  if (localStorage.getItem(authConfig.storageTokenKeyName) && to.meta.auth) {
    next()
  } else if (to.meta.guard) {
    if (localStorage.getItem(authConfig.storageTokenKeyName)) {
      next({ name: 'home' })
    } else {
      next()
    }
  } else {
    next()
  }

  // // console.log(store?.state?.authUser, to.meta.auth, 'from guard')
  // console.log(store)
  // if (!store?.state?.authUser && to.meta.guard) {
  //   next()
  // } else if (store?.state?.authUser && to.meta.auth) {
  //   next()
  // }
  // if (store?.state?.authUser && to.meta.auth) {
  //   next()
  // }
  //  else {
  //   next({ name: 'login' })
  // }
  // next()
  // next(vm=>{
  //   console.log(vm.$store);
  // });
  // next(vm=>{

  // })
})

export default router
