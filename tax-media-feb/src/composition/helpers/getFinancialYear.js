// import { format } from 'date-fns'

export default function getFinancialYear(date, lastYear = false) {
  let year = date.getFullYear()
  if (lastYear) {
    year -= 1
  }
  //   format(new Date(year),'')
  return `${year}-1-1 to ${year}-31-12`
}
