import { format } from 'date-fns'

function formatDate(quarterFirstMonth, quarterLastMonth) {
  return `${quarterFirstMonth} to ${quarterLastMonth}`
}

export default function getQuarterMonth(date, lastquarter = false) {
  let quarter = format(date, 'q')
  let year = date.getFullYear()
  let month = quarter * 3// get last month of quarter
  let firstMonth = month - 3 // get first month of quarter
  const currentMonth = date.getMonth()

  if (lastquarter) {
    quarter -= 1
    if (quarter === 0) {
      quarter = 4
    }
    month = quarter * 3
    firstMonth = month - 3
    if (currentMonth === 0) {
      year = date.getFullYear() - 1
    }
  }

  const quarterLastMonth = format(new Date(year, month, 0), 'yyyy-M-d')
  //   const quarterLastMonth = format(new Date(year, month, 0), 'd MMM yyyy')
  const firstQuarter = format(new Date(date.getFullYear(), firstMonth, 1), 'yyyy-M-d')
  return formatDate(firstQuarter, quarterLastMonth)
}
