// import AllExpensesPage from '../../views/AllExpensesPage.vue'
import ReportNinePointOneSubForm from '../../views/reports/ReportNinePointOneSubForm.vue'
import ReportNinePointOne from '../../views/reports/ReportNinePointOne.vue'
import LocalSubForm from '../../views/reports/LocalSubForm.vue'
import ImportSubForm from '../../views/reports/ImportSubForm.vue'
import TreasuryDepositSubForm from '../../views/reports/TreasuryDepositSubForm.vue'
import SubFormForTwentyFour from '../../views/reports/SubFormForTwentyFour.vue'
import SubFormTwentyNine from '../../views/reports/SubFormTwentyNine.vue'
import SubFormForNoteThirty from '../../views/reports/SubFormForNoteThirty.vue'
import ReportSixPointTwoPointOne from '../../views/reports/ReportSixPointTwoPointOne.vue'
import ReportSixPointTwo from '../../views/reports/ReportSixPointTwo.vue'

export default [
  // {path:'/all-expenses',component:AllExpensesPage,name:'allExpenses'},
  {
    path: '/reports/ninePointOneSubform',
    // component: () => import('@/views/profile/Profile.vue'),
    component: ReportNinePointOneSubForm,
    name: 'reportNinePointOneSubForm',
    props: true,
    meta: {
    //   pageTitle: 'Report Nine Point Form',
      auth: true,
    //   breadcrumb: [
    //     {
    //       text: 'Profile',
    //       active: true,
    //     },
    //   ],
    },
  },
  {
    path: '/reports/ninePointOneform',
    // component: () => import('@/views/profile/Profile.vue'),
    component: ReportNinePointOne,
    name: 'reportNinePointOne',
    props: true,
    meta: {
      auth: true,
    },
  },
  {
    path: '/reports/local/:note/:transactionCategory/:transactionType',
    component: LocalSubForm,
    name: 'localSubForm',
    props: true,
    meta: {
      auth: true,
    },
  },
  {
    path: '/reports/import/:note/:transactionCategory/:transactionType',
    component: ImportSubForm,
    name: 'ImportSubForm',
    props: true,
    meta: {
      auth: true,
    },
  },

  {
    path: '/treasury-deposity-subform/:note/:item',
    component: TreasuryDepositSubForm,
    name: 'TreasuryDepositSubForm',
    props: true,
    meta: {
      auth: true,
    },
  },

  {
    path: '/subformforNote24/:note/',
    component: SubFormForTwentyFour,
    name: 'SubFormForTwentyFour',
    props: true,
    meta: {
      auth: true,
    },
  },

  {
    path: '/SubFormForTwentyNine/:note/',
    component: SubFormTwentyNine,
    name: 'SubFormForTwentyNine',
    props: true,
    meta: {
      auth: true,
    },
  },
  {
    path: '/SubFormForNoteThirty/:note/',
    component: SubFormForNoteThirty,
    name: 'SubFormForNoteThirty',
    props: true,
    meta: {
      auth: true,
    },
  },
  // report SixPointOne
  {
    path: '/reports/ReportSixPointTwoPointOne/',
    component: ReportSixPointTwoPointOne,
    name: 'ReportSixPointTwoPointOne',
    props: true,
    meta: {
      auth: true,
    },
  },
  {
    path: '/reports/ReportSixPointTwo/',
    component: ReportSixPointTwo,
    name: 'ReportSixPointTwo',
    props: true,
    meta: {
      auth: true,
    },
  },

]
