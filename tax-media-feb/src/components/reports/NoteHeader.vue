/* eslint-disable eqeqeq */
<template>
  <h2>
    {{ natureOfSupply }}
  </h2>
</template>

<script>
export default {
  props: ['note'],
  data: () => ({
    nature: '',
  }),
  computed: {
    natureOfSupply() {
      if (this.note == 2) {
        return '(Zero Rated Goods/Services-Deemed Export) of part-3(SUPPLY-OUTPUT-TAX)'
      } if (this.note == 11) {
        return '(Zero Rated Goods/Services-Import) of part-4(PURCHASE-INPUT TAX)'
      } if (this.note == 13) {
        return '(Exempted Rated Goods/Services-Import) of part-4(PURCHASE-INPUT TAX)'
      } if (this.note == 15) {
        return '(Standard Rated Goods/Services-Import) of part-4(PURCHASE-INPUT TAX)'
      } if (this.note == 17) {
        return '(Goods/Service Other than Standard Rate) of part-4(PURCHASE-INPUT TAX)'
      } if (this.note == 20) {
        return '(Standard Rated Goods/Services-Import) of part-3(PURCHASE-INPUT TAX)'
      } if (this.note == 22) {
        return '(Goods/Service Not Admissible for Credit (Taxpayers who sell only Exempted / Specific VAT and Goods/Service Other than Standard Rate/Credits not taken within stipulated time)-Import) of part-4(PURCHASE-INPUT TAX)'
      }
      return this.nature
    },
  },
}

</script>
