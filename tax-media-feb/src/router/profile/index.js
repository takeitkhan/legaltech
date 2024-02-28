// import AllExpensesPage from '../../views/AllExpensesPage.vue'
import Profile from '../../views/profile/Profile.vue'

export default [
  // {path:'/all-expenses',component:AllExpensesPage,name:'allExpenses'},
  {
    path: '/profile',
    // component: () => import('@/views/profile/Profile.vue'),
    component: Profile,
    name: 'profile',
    props: true,
    meta: {
      pageTitle: 'User Profile',
      auth: true,
      breadcrumb: [
        {
          text: 'Profile',
          active: true,
        },
      ],
    },
  },

]
