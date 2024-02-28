export default [
  {
    title: 'Home',
    route: 'home',
    icon: 'HomeIcon',
  },
  {
    title: 'Second Page',
    route: 'second-page',
    icon: 'FileIcon',
  },
  {
    title: 'Contacts',
    icon: 'PieChartIcon',
    route: 'home',
    children: [
      {
        title: 'All Contacts',
        icon: 'User',
        route: 'home',
      },
      {
        title: 'Customer',
        route: 'home',
        icon: 'MapIcon',
      },
      {
        title: 'Suppliers',
        route: 'home',
        icon: 'MapIcon',
      },
      {
        title: 'Employees',
        route: 'home',
        icon: 'MapIcon',
      },
    ],
  },
  {
    title: 'Reports',
    icon: 'PieChartIcon',
    children: [
      {
        title: 'Vat Form 6.3',
        icon: 'MapIcon',
        route: 'home',
      },
      {
        title: 'Vat Form 6.2',
        route: 'home',
        icon: 'MapIcon',
      },
      {
        title: 'Vat Form 9.1',
        route: 'home',
        icon: 'MapIcon',
      },
    ],
  },
]
