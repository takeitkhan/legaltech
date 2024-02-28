export default {
  computed: {
    formatNumberToFixed2() {
      return number => parseFloat(number).toFixed(2) || 0
    },
    formatNumberToFixed1() {
      return number => parseFloat(number).toFixed(1) || 0
    },
  },
}
