<template>
  <div class="taxpayer-information">
    <h2
      style="text-align:center;background:#A9D08E;color:black;"
      class="py-1 text-uppercase"
    >
      Part-7 : <span>NET TAX CALCULATION</span>
    </h2>
    <div class="taxpayer-information-table">
      <table
        class="table-bordered"
        width="100%"
      >
        <tr style="background:#BDD7EE;">
          <th
            style="text-align:center"
            class=" py-1 pl-1"
            width="40%"
          >Items</th>
          <th
            width="10%"
            style="text-align:center"
          >
            Note
          </th>
          <th
            width="10%"
            style="text-align:center"
          >
            Amount
          </th>
        </tr>
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >Net Payable VAT for the Tax Period (Section-45) (9C-23B+28-33)</th>
          <th style="text-align:center">
            34
          </th>
          <th style="text-align:center">
            000
          </th>
        </tr>
        <!-- end of single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >
            Net Payable VAT for the Tax Period after Adjustment with Closing Balance and balance of form 18.6 [34-(52+56)]
          </th>
          <th style="text-align:center">
            35
          </th>
          <th style="text-align:center">
            0.000
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >
            Net Payable Supplementary Duty for the Tax Period (Before adjustment with Closing Balance) [9B+38-(39+40)]
          </th>
          <th style="text-align:center">
            36
          </th>
          <th style="text-align:center">
            00.00
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >
            Net Payable Supplementary Duty for the Tax Period after Adjusted with Closing Balance and balance of form 18.6 [36-(53+57)]
          </th>
          <th style="text-align:center">
            37
          </th>
          <th style="text-align:center">
            00.00
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >
            Supplementary Duty Against Issuance of Debit Note
          </th>
          <th style="text-align:center">
            38
          </th>
          <th style="text-align:center">
            -
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >
            Supplementary Duty Against Issuance of Credit Note

          </th>
          <th style="text-align:center">
            39
          </th>
          <th style="text-align:center">
            -
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >
            Supplementary Duty Paid on Inputs Against Exports
          </th>
          <th style="text-align:center">
            40
          </th>
          <th style="text-align:center">
            -
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >
            Interest on Overdue VAT (Based on note 35)
          </th>
          <th style="text-align:center">
            41
          </th>
          <th style="text-align:center">
            -
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >
            Interest on Overdue SD (Based on note 37)
          </th>
          <th style="text-align:center">
            42
          </th>
          <th style="text-align:center">
            -
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >
            Fine/Penalty for Non-submission of Return
          </th>
          <th style="text-align:center">
            43
          </th>
          <th style="text-align:center">
            -
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >
            Other Fine/Penalty/Interest
          </th>
          <th style="text-align:center">
            44
          </th>
          <th style="text-align:center">
            -
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >
            Payable Excise Duty

          </th>
          <th style="text-align:center">
            45
          </th>
          <th style="text-align:center">
            -
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >
            Payable Development Surcharge
          </th>
          <th style="text-align:center">
            46
          </th>
          <th style="text-align:center">
            -
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >
            Payable ICT Development Surcharge

          </th>
          <th style="text-align:center">
            47
          </th>
          <th style="text-align:center">
            -
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >Payable Health Care Surcharge</th>
          <th style="text-align:center">
            48
          </th>
          <th style="text-align:center">
            -
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >Payable Environmental Protection Surcharge</th>
          <th style="text-align:center">
            49
          </th>
          <th style="text-align:center">
            -
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >Net Payable VAT for treasury deposit (35+41+43+44)</th>
          <th style="text-align:center">
            50
          </th>
          <th style="text-align:center">
            0.000
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >Net Payable SD for treasury deposit (37+42)</th>
          <th style="text-align:center">
            51
          </th>
          <th style="text-align:center">
            00.10
          </th>
        </tr>
        <!-- .single nature  -->

        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >Closing Balance of Last Tax Period (VAT)</th>
          <th style="text-align:center">
            52
          </th>
          <th style="text-align:center">
            00.00
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >Closing Balance of Last Tax Period (SD)</th>
          <th style="text-align:center">
            53
          </th>
          <th style="text-align:center">
            000.00
          </th>
        </tr>
        <!-- .single nature  -->
      </table>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import EntityApi from '@/api/entity/EntityApi'

export default {
  data: () => ({
    purchaseTransactions: [],
    zeroPurchaseLocal: [],
    zeroPurchaseInternational: [],
    exemptedPurchaseLocal: [],
    exemptedPurchaseInternational: [],
    standardPurchaseInternational: [],
    standardPurchaseLocal: [],
    nonStandardPurchaseLocal: [],
    nonStandardPurchaseInternational: [],
    unRegisteredPurchaseLocalForNote20: [],
    totalPurchaseTaxableValue: 0,
    totalPurchaseAT: 0,
    totalUnRegisteredPurchaseLocalForNote20TaxableValue: 0,
  }),
  computed: {
    ...mapState(['currentEntity', 'reportDate', 'reportDateRange']),
    getsdRate() {
      return trans => {
        if (trans.contact?.bin?.length) {
          return (trans.taxable_value * trans.sd_rate) / 100
        }
        return 0
      }
    },
    getVatRate() {
      return trans => {
        if (trans.tax_rate === -1 || trans.tax_rate === 0 || !trans?.contact?.bin) {
          return 0
        }
        return (trans.taxable_value * trans.tax_rate) / 100
      }
    },
    totalTaxableValueForNote20() {
      return this.unRegisteredPurchaseLocalForNote20.reduce((t, trans) => Number.parseFloat(trans.taxable_value, 10) + t, 0)
    },
    zeroPurchaseLocalTaxesValueSum() {
      // if MRP sells transactions exist then get total sd rate sum
      if (this.zeroPurchaseLocal.length > 0) {
        return this.zeroPurchaseLocal.reduce((t, trans) => t + parseFloat(trans.taxable_value, 10), 0)
      }
      return 0
    },
    zeroPurchaseInternationalValueSum() {
      // if MRP sells transactions exist then get total sd rate sum
      if (this.zeroPurchaseInternational.length > 0) {
        return this.zeroPurchaseInternational.reduce((t, trans) => t + parseFloat(trans.taxable_value, 10), 0)
      }
      return 0
    },
    exemptedPurchaseLocalValueSum() {
      if (this.exemptedPurchaseLocal.length > 0) {
        return this.exemptedPurchaseLocal.reduce((t, trans) => t + parseFloat(trans.taxable_value, 10), 0)
      }
      return 0
    },
    exemptedPurchaseInternationalValueSum() {
      if (this.exemptedPurchaseInternational.length > 0) {
        return this.exemptedPurchaseInternational.reduce((t, trans) => t + parseFloat(trans.taxable_value, 10), 0)
      }
      return 0
    },
    standardPurchaseLocalValueSum() {
      if (this.standardPurchaseLocal.length > 0) {
        return this.standardPurchaseLocal.reduce((t, trans) => t + parseFloat(trans.taxable_value, 10), 0)
      }
      return 0
    },

    standardPurchaseLocalTaxSum() {
      if (this.standardPurchaseLocal.length > 0) {
        return this.standardPurchaseLocal.reduce((t, trans) => t + this.getVatRate(trans), 0)
      }
      return 0
    },

    standardPurchaseInternationalValueSum() {
      if (this.standardPurchaseInternational.length > 0) {
        return this.standardPurchaseInternational.reduce((t, trans) => t + parseFloat(trans.taxable_value, 10), 0)
      }
      return 0
    },
    standardPurchaseInternationalTaxSum() {
      if (this.standardPurchaseInternational.length > 0) {
        return this.standardPurchaseInternational.reduce((t, trans) => t + this.getVatRate(trans), 0)
      }
      return 0
    },

    nonStandardPurchaseLocalValueSum() {
      if (this.nonStandardPurchaseLocal.length > 0) {
        return this.nonStandardPurchaseLocal.reduce((t, trans) => t + parseFloat(trans.taxable_value, 10), 0)
      }
      return 0
    },
    nonStandardPurchaseLocalTaxSum() {
      if (this.nonStandardPurchaseLocal.length > 0) {
        return this.nonStandardPurchaseLocal.reduce((t, trans) => t + this.getVatRate(trans), 0)
      }
      return 0
    },

    nonStandardPurchaseInternationalValueSum() {
      if (this.nonStandardPurchaseInternational.length > 0) {
        return this.nonStandardPurchaseInternational.reduce((t, trans) => t + parseFloat(trans.taxable_value, 10), 0)
      }
      return 0
    },

    nonStandardPurchaseInternationalTaxSum() {
      if (this.nonStandardPurchaseInternational.length > 0) {
        return this.nonStandardPurchaseInternational.reduce((t, trans) => t + this.getVatRate(trans), 0)
      }
      return 0
    },
    totalPurchaseTaxValue() {
      // totalPurchaseInputTaxeCredit
      return this.purchaseTransactions?.reduce((t, trans) => Number.parseFloat(trans.taxable_value, 10) + t, 0)
    },
    totalPurchaseTaxRate() {
      // totalPurchaseInputTaxeCredit
      return this.purchaseTransactions?.reduce((t, trans) => this.getVatRate(trans) + t, 0)
    },
  },
  watch: {
    currentEntity() {
      // this.getPurchaseTransactions()
    },
    reportDate() {
      // this.getPurchaseTransactions()
    },
    reportDateRange() {
      // this.getPurchaseTransactions()
    },
  },
  methods: {
    async getPurchaseTransactions() {
      try {
        // if date is not null then get transactions in specific date
        this.$store.commit('UPDATE_IS_LOADER', true)
        if (this.reportDate) {
          const { data: { transactions } } = await EntityApi.getPurchaseTransactionInDate(this.currentEntity.id,
            this.reportDate)
          this.purchaseTransactions = transactions
        } else if (Array.isArray(this.reportDateRange)) {
          // else if date range is array then get transaction in date range
          const { data: { transactions } } = await EntityApi.getPurchaseTransactionInDateRange(this.currentEntity.id, this.reportDateRange[0], this.reportDateRange[1])
          this.purchaseTransactions = transactions
        }
        this.$store.commit('UPDATE_IS_LOADER', false)
        // zero rated sells transactions
        this.zeroPurchaseLocal = this.purchaseTransactions.filter(trans => Number.parseInt(trans.tax_rate, 10) === 0 && trans.transaction_category === 'local' && trans.contact.bin.length)
        this.zeroPurchaseInternational = this.purchaseTransactions.filter(trans => Number.parseInt(trans.tax_rate, 10) === 0 && trans.transaction_category === 'international' && trans?.contact?.bin?.length)

        // examptedrateds sells
        this.exemptedPurchaseLocal = this.purchaseTransactions.filter(trans => Number.parseInt(trans.tax_rate, 10) === -1 && trans.transaction_category === 'local' && trans.contact.bin.length)
        this.exemptedPurchaseInternational = this.purchaseTransactions.filter(trans => Number.parseInt(trans.tax_rate, 10) === -1 && trans.transaction_category === 'international' && trans?.contact?.bin?.length)

        // standard rateds sells transactions
        this.standardPurchaseLocal = this.purchaseTransactions.filter(trans => Number.parseInt(trans.tax_rate, 10) === 15 && trans.transaction_category === 'local')
        this.standardPurchaseInternational = this.purchaseTransactions.filter(trans => Number.parseInt(trans.tax_rate, 10) === 15 && trans.transaction_category === 'international' && trans?.contact?.bin?.length)

        // Non Standard Rated purchase local
        this.nonStandardPurchaseLocal = this.purchaseTransactions.filter(trans => Number.parseFloat(trans.tax_rate, 10) > 0 && Number.parseFloat(trans.tax_rate, 10) < 15 && trans.transaction_category === 'local' && trans?.contact?.bin?.length)

        // non standard rated purchase international
        this.nonStandardPurchaseInternational = this.purchaseTransactions.filter(trans => Number.parseFloat(trans.tax_rate, 10) > 0 && Number.parseFloat(trans.tax_rate, 10) < 15 && trans.transaction_category === 'international' && trans?.contact?.bin?.length)

        this.unRegisteredPurchaseLocalForNote20 = this.purchaseTransactions.filter(trans => Number.parseFloat(trans.tax_rate, 10) < 15 && Number.parseFloat(trans.tax_rate, 10) > 0 && !trans?.contact?.bin && trans.transaction_category === 'local')
      } catch (error) {
        console.log(error)
      }
    },
    GoodsDetails(name, params) {
      if (Array.isArray(this.reportDateRange) && this.reportDateRange.length > 0) {
        this.$router.push({ name, params, query: { fromDate: this.reportDateRange[0], toDate: this.reportDateRange[1] } })
      } else if (this.reportDate) {
        this.$router.push({ name, params, query: { date: this.reportDate } })
      } else {
        this.$swal.fire({
          title: 'Please Select Date or Date range',
        })
      }
    },
  },
}
</script>

<style scoped>
*{
  margin:0;
  padding:0;box-sizing:border-box;
}
.user-timeline-list{
    /* border-left:1px solid */
}
.user-timeline-list .single-timeline .badge{
  width:20px;
  height:20px !important;
  border-radius:50% !important;

}
td,tr,th{
  text-align:left;
  padding:1rem !important;
}
.custom-control-primary{
  padding:0.5rem;
}
/* tr{
  padding:5px !important;
  text-align:center;
  width:10px !important;
}
td{
  padding:10px;
}
th{
  padding:10px;
  text-align:center;
} */
tfoot tr,tfoot tr td{
  height:20px !important;
   padding:20px 10px !important;
   background:#fff;
}
</style>
