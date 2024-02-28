export default {
  computed: {
    getVatRate() {
      return product => {
        if (product.taxValue === -1 || product.taxValue === 0) {
          return 0
        }
        return Math.round(((product.taxable_value + this.getsdRate(product)) * product.taxValue) / 100) || 0
      }
    },

    getsdRate() {
      return product => Math.round((product.taxable_value * product.sdRate) / 100) || 0
    },

    getAtRate() {
      return product => {
        if (product.atRate === 0) {
          return 0
        }
        return Math.round(((product.taxable_value) * product.atRate) / 100) || 0
      }
    },
  },
}
