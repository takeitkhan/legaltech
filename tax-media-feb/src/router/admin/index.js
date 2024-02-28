import AddUser from '@/views/admin/AddUser.vue'
import EditUser from '@/views/admin/EditUser.vue'

export default [
  {
    path: '/users',
    component: () => import('@/views/admin/Users.vue'),
    name: 'Users',
  },
  {
    path: '/userDetails/:userId',
    component: () => import('@/views/admin/User.vue'),
    name: 'User',
    props: true,
  },
  {
    path: '/users/add-new-user',
    component: AddUser,
    name: 'AddNewUser',
  },
  {
    path: '/users/:userId',
    component: EditUser,
    name: 'EditUser',
    props: true,
  },

]
