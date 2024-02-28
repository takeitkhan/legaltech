export default function resetForm(form) {
  const newForm = form
  Object.keys(form).forEach(key => {
    if (Array.isArray(newForm[key])) {
      newForm[key] = []
    } else if (typeof newForm[key] === 'object' && !Array.isArray(newForm[key])) {
      newForm[key] = {}
    } else {
      newForm[key] = null
    }
  })
  return newForm
}
