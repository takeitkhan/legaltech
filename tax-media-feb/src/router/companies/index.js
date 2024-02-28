import AddContact from '@/views/companies/AddContact.vue'
import InventoryProductDetails from '@/views/companies/InventoryProductDetails.vue'
import CompanyPage from '../../views/companies/CompanyPage.vue'
import UserList from '../../views/companies/UserList.vue'
import User from '../../views/companies/User.vue'
import DraftInvoicePage from '../../views/companies/transactions/DraftInvoicePage.vue'
import ContactsPage from '../../views/companies/ContactsPage.vue'
import Account from '../../views/companies/Account.vue'
import Inventory from '../../views/companies/Inventory.vue'

export default [
  {
    path: '/companies/:companyId/profile',
    component: CompanyPage,
    name: 'CompanyPage',
    props: true,
  },
  {
    path: '/companies/:companyId/users',
    component: UserList,
    name: 'UserList',
    props: true,
  },
  {
    path: '/companies/:companyId/user',
    component: User,
    name: 'UserDetails',
    props: true,
  },
  {
    path: '/draft-invoice',
    component: DraftInvoicePage,
    name: 'draftInvoice',
    meta: {
      // pageTitle: 'Draft Invoice',
      auth: true,
    },
  },
  {
    path: '/contacts',
    component: ContactsPage,
    name: 'Contacts',
    meta: {
      // pageTitle: 'Contacts',
      auth: true,
    },
  },
  {
    path: '/add-new-contact',
    component: AddContact,
    name: 'NewContact',
    meta: {
      // pageTitle: 'NewContact',
      auth: true,
      // breadcrumb: [
      //   {
      //     text: 'Contacts',
      //     active: true,
      //   },
      // ],
    },
  },
  {
    path: '/account',
    component: Account,
    name: 'Account',
    meta: {
      // pageTitle: 'Entity Account',
      auth: true,
      // breadcrumb: [
      //   {
      //     text: 'Contacts',
      //     active: true,
      //   },
      // ],
    },
  },
  {
    path: '/inventory',
    component: Inventory,
    name: 'Inventory',
    meta: {
      // pageTitle: 'Entity Account',
      auth: true,
      // breadcrumb: [
      //   {
      //     text: 'Contacts',
      //     active: true,
      //   },
      // ],
    },
  },
  {
    path: '/inventory-product-details/:product_id',
    component: InventoryProductDetails,
    name: 'InventoryProductDetails',
    props: true,
    meta: {
      // pageTitle: 'Entity Account',
      auth: true,
      // breadcrumb: [
      //   {
      //     text: 'Contacts',
      //     active: true,
      //   },
      // ],
    },
  },

]
