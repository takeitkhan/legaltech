<template>
  <div class="taxpayer-information">
    <h2
      style="text-align:center;background:#A9D08E;color:black;"
      class="py-1 text-uppercase"
    >
      Part-4 : <span>PURCHASE - INPUT TAX</span>
    </h2>
    <p class="border py-1 pl-1">
      1) If all the products/services you supply are standard rated, fill up note 10-20
    </p>
    <p class="border py-1 pl-1">
      2) All the products/services you supply are not standard rated or input tax credit not taken within stitulated time period under section 46, fill up note 21-22
    </p>
    <p class="border py-1 pl-1">
      3) If the product/services you supply consists of both standard rated and non-standard rated then fill up  note 10-20 for the raw material that ware use to produce/supply standard rated goods/services and fill up note 21-22 for the raw materials that ware used to produce/supply non-standard rated goods/services and show the value proportionately in note 10-22 as applicable.
    </p>
    <div class="taxpayer-information-table">
      <table
        class="table-bordered"
        width="100%"
      >
        <tr style="background:#BDD7EE;">
          <th
            colspan="2"
            style="text-align:center"
            class=" py-1 pl-1"
            width="40%"
          >
            Nature of Purchases
          </th>
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
            Value (a)
          </th>
          <th
            width="10%"
            style="text-align:center"
          >
            VAT(b)
          </th>
          <th
            width="5%"
            style="text-align:center"
          >
            Action
          </th>
        </tr>
        <!-- .single nature  -->
        <tr>
          <th
            rowspan="2"
            style="padding-left:1rem;"
          >
            Zero Rated Goods/Service
          </th>
          <th>Local Purchase</th>
          <th style="text-align:center">
            10
          </th>
          <th style="text-align:center">
            {{ zeroPurchaseLocalTaxesValueSum }}
          </th>
          <th style="text-align:center;background:#E7E6E6" />
          <th style="text-align:center">
            <a @click.prevent="GoodsDetails('localSubForm',{note:10,transactionCategory:'local',transactionType:1})">Sub-form</a>
          </th>
        </tr>
        <tr>
          <th>import</th>
          <th style="text-align:center">
            11
          </th>
          <th style="text-align:center">
            {{ zeroPurchaseInternationalValueSum }}
          </th>
          <th style="text-align:center; background:#E7E6E6" />
          <th style="text-align:center">
            <a @click.prevent="GoodsDetails('ImportSubForm',{note:11,transactionCategory:'international',transactionType:1})">Sub-form</a>
          </th>
        </tr>
        <!-- end of single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
            rowspan="2"
          >
            Exempted Goods/ Service
          </th>
          <th>
            Local Purchase
          </th>
          <th style="text-align:center">
            12
          </th>
          <th style="text-align:center">
            {{ exemptedPurchaseLocalValueSum }}
          </th>
          <th style="text-align:center;background:#E7E6E6" />
          <th style="text-align:center">
            <a @click.prevent="GoodsDetails('localSubForm',{note:12,transactionCategory:'local',transactionType:1})">Sub-form</a>
          </th>
        </tr>
        <tr>
          <th>import</th>
          <th style="text-align:center">
            13
          </th>
          <th style="text-align:center;">
            {{ exemptedPurchaseInternationalValueSum }}
          </th>
          <th style="text-align:center;background:#E7E6E6" />
          <th style="text-align:center">
            <a @click.prevent="GoodsDetails('localSubForm',{note:13,transactionCategory:'international',transactionType:1})">Sub-form</a>
          </th>
        </tr>
        <!-- end of single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
            rowspan="2"
          >
            Standard Rated Goods/Service
          </th>
          <th>Local Purchase</th>
          <th style="text-align:center">
            14
          </th>
          <th style="text-align:center">
            {{ standardPurchaseLocalValueSum }}
          </th>
          <th style="text-align:center">
            {{ standardPurchaseLocalTaxSum }}
          </th>
          <th style="text-align:center">
            <a @click.prevent="GoodsDetails('localSubForm',{note:14,transactionCategory:'local',transactionType:1})">Sub-form</a>
          </th>
        </tr>
        <tr>
          <th>import</th>
          <th style="text-align:center">
            15
          </th>
          <th style="text-align:center">
            {{ standardPurchaseInternationalValueSum }}
          </th>
          <th style="text-align:center">
            {{ standardPurchaseInternationalTaxSum }}
          </th>
          <th style="text-align:center">
            <a @click.prevent="GoodsDetails('ImportSubForm',{note:15,transactionCategory:'international',transactionType:1})">Sub-form</a>
          </th>
        </tr>
        <!-- end of single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
            rowspan="2"
          >
            Goods/Service Other than Standard Rate
          </th>
          <th>Local Purchase</th>
          <th style="text-align:center">
            16
          </th>
          <th style="text-align:center">
            {{ nonStandardPurchaseLocalValueSum}}
          </th>
          <th style="text-align:center">
            {{ nonStandardPurchaseLocalTaxSum }}
          </th>
          <th style="text-align:center">
            <a @click.prevent="GoodsDetails('localSubForm',{note:16,transactionCategory:'local',transactionType:1})">Sub-form</a>
          </th>
        </tr>
        <tr>
          <th>import</th>
          <th style="text-align:center">
            17
          </th>
          <th style="text-align:center">
            {{ nonStandardPurchaseInternationalValueSum }}
          </th>
          <th style="text-align:center">
            {{ nonStandardPurchaseInternationalTaxSum }}
          </th>
          <th style="text-align:center">
            <a @click.prevent="GoodsDetails('ImportSubForm',{note:17,transactionCategory:'international',transactionType:1})">Sub-form</a>
          </th>
        </tr>
        <!-- end of single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
          >
            Goods/Service Based on Specific VAT
          </th>
          <th>Local Purchase</th>
          <th style="text-align:center">
            18
          </th>
          <th style="text-align:center">
            0.00
          </th>
          <th style="text-align:center">
            0.00
          </th>
          <th style="text-align:center">
            <a @click.prevent="GoodsDetails('localSubForm',{note:18,transactionCategory:'not used',transactionType:1})">Sub-form</a>
          </th>
        </tr>
        <!-- .single nature  -->
        <tr>
          <th
            style="padding-left:1rem;"
            rowspan="2"
          >
            Goods/Service Not Admissible for Credit (Local Purchase)
          </th>
          <th>From Turnover Tax Units</th>
          <th style="text-align:center">
            19
          </th>
          <th style="text-align:center">
            0.00
          </th>
          <th style="text-align:center;background:#E7E6E6" />
          <th style="text-align:center">
            <a @click.prevent="GoodsDetails('localSubForm',{note:19,transactionCategory:'not used',transactionType:1})">Sub-form</a>
          </th>
        </tr>
        <tr>
          <th>From Unregistered Entites</th>
          <th style="text-align:center">
            20
          </th>
          <th style="text-align:center">
            {{ totalTaxableValueForNote20}}
          </th>
          <th style="text-align:center;background:#E7E6E6" />
          <th style="text-align:center">
            <a @click.prevent="GoodsDetails('localSubForm',{note:20,transactionCategory:'local',transactionType:1})">Sub-form</a>
          </th>
        </tr>
        <!-- end of single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            rowspan="2"
            style="padding:10px"
          >
            <p>
              Goods/Service Not Admissible for Credit (Taxpayers who sell only Exempted / Specific VAT <br> and Goods/Service Other than <br> Standard Rate/Credits not taken within stipulated time)
            </p>
          </th>
          <th>Local Purchase</th>
          <th style="text-align:center">
            21
          </th>
          <th style="text-align:center">
            0.00
          </th>
          <th style="text-align:center;background:#E7E6E6" />
          <th style="text-align:center">
            <a @click.prevent="GoodsDetails('localSubForm',{note:21,transactionCategory:'not used',transactionType:1})">Sub-form</a>
          </th>
        </tr>
        <tr>
          <th>import</th>
          <th style="text-align:center">
            22
          </th>
          <th style="text-align:center;" />
          <th style="text-align:center;background:#E7E6E6" />
          <th style="text-align:center">
            <a @click.prevent="GoodsDetails('ImportSubForm',{note:22,transactionCategory:'not used',transactionType:1})">Sub-form</a>
          </th>
        </tr>
        <!-- end of single nature  -->
        <tr>
          <th
            colspan="2"
            style="padding:0.5rem 1rem;text-transform:capitalize"
          >
            total Input Tax Credit
          </th>
          <th style="text-align:center">
            23
          </th>
          <th style="text-align:center;background:#E7E6E6">
            {{ totalPurchaseTaxValue }}
          </th>
          <th style="text-align:center;background:#E7E6E6">
            {{ totalPurchaseTaxRate }}
          </th>
          <!-- <th style="text-align:center"><router-link :to="{name:'reportNinePointOne'}">
                Sub-form
              </router-link>
              </th> -->
        </tr>
        <tfoot>
          <tr>
            <th
              colspan="6"
              style="text-align:center"
            >
              1 এস. আর. ও নং -৩৮৭-আইন/২০১৯/৯০-মূসক, তারিখ: ১১ ডিসেম্বর, ২০১৯ দ্বারা প্রতিস্থাপিত ।
            </th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import EntityApi from '@/api/entity/EntityApi'

export default {
  data: () => ({
    purchaseTransactionDetails: [],
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
        if (trans?.transaction?.contact?.bin?.length) {
          return Math.round((trans.taxable_value * trans.sd_rate) / 100)
        }
        return 0
      }
    },
    getVatRate() {
      return trans => {
        if (trans.tax_rate === -1 || trans.tax_rate === 0 || (!trans?.transaction?.contact?.bin && Number(trans?.tax_rate) !== 15)) {
          return 0
        }
        return Math.round(((trans.taxable_value + this.getsdRate(trans)) * trans.tax_rate) / 100)
      }
    },
    getAtRate() {
      return details => {
        if (details.at_rate === 0) {
          return 0
        }
        return Math.round(((details.taxable_value + this.getsdRate(details)) * details.at_rate) / 100)
      }
    },
    totalTaxableValueForNote20() {
      return Math.round(this.unRegisteredPurchaseLocalForNote20?.reduce((t, trans) => Number.parseFloat(trans.taxable_value, 10) + this.getsdRate(trans) + t, 0))
    },
    zeroPurchaseLocalTaxesValueSum() {
      if (this.zeroPurchaseLocal?.length > 0) {
        return Math.round(this.zeroPurchaseLocal?.reduce((t, trans) => t + parseFloat(trans.taxable_value, 10) + this.getsdRate(trans), 0))
      }
      return 0
    },
    zeroPurchaseInternationalValueSum() {
      if (this.zeroPurchaseInternational?.length > 0) {
        return Math.round(this.zeroPurchaseInternational?.reduce((t, trans) => t + parseFloat(trans.taxable_value, 10) + this.getsdRate(trans), 0))
      }
      return 0
    },
    exemptedPurchaseLocalValueSum() {
      if (this.exemptedPurchaseLocal?.length > 0) {
        return Math.round(this.exemptedPurchaseLocal?.reduce((t, trans) => t + parseFloat(trans.taxable_value, 10) + this.getsdRate(trans), 0))
      }
      return 0
    },
    exemptedPurchaseInternationalValueSum() {
      if (this.exemptedPurchaseInternational?.length > 0) {
        return Math.round(this.exemptedPurchaseInternational?.reduce((t, trans) => t + parseFloat(trans.taxable_value, 10) + this.getsdRate(trans), 0))
      }
      return 0
    },
    standardPurchaseLocalValueSum() {
      if (this.standardPurchaseLocal?.length > 0) {
        return Math.round(this.standardPurchaseLocal?.reduce((t, trans) => t + parseFloat(trans.taxable_value, 10) + this.getsdRate(trans), 0))
      }
      return 0
    },
    standardPurchaseLocalTaxSum() {
      if (this.standardPurchaseLocal?.length > 0) {
        return Math.round(this.standardPurchaseLocal?.reduce((t, trans) => t + this.getVatRate(trans), 0))
      }
      return 0
    },
    standardPurchaseInternationalValueSum() {
      if (this.standardPurchaseInternational?.length > 0) {
        return Math.round(this.standardPurchaseInternational?.reduce((t, trans) => t + parseFloat(trans.taxable_value, 10) + this.getsdRate(trans), 0))
      }
      return 0
    },
    standardPurchaseInternationalTaxSum() {
      if (this.standardPurchaseInternational?.length > 0) {
        return Math.round(this.standardPurchaseInternational.reduce((t, trans) => t + this.getVatRate(trans), 0))
      }
      return 0
    },

    nonStandardPurchaseLocalValueSum() {
      if (this.nonStandardPurchaseLocal?.length > 0) {
        return Math.round(this.nonStandardPurchaseLocal.reduce((t, trans) => t + parseFloat(trans.taxable_value, 10) + this.getsdRate(trans), 0))
      }
      return 0
    },
    nonStandardPurchaseLocalTaxSum() {
      if (this.nonStandardPurchaseLocal?.length > 0) {
        return Math.round(this.nonStandardPurchaseLocal.reduce((t, trans) => t + this.getVatRate(trans), 0))
      }
      return 0
    },
    nonStandardPurchaseInternationalValueSum() {
      if (this.nonStandardPurchaseInternational?.length > 0) {
        return Math.round(this.nonStandardPurchaseInternational.reduce((t, trans) => t + parseFloat(trans.taxable_value, 10) + this.getsdRate(trans), 0))
      }
      return 0
    },
    nonStandardPurchaseInternationalTaxSum() {
      if (this.nonStandardPurchaseInternational?.length > 0) {
        return Math.round(this.nonStandardPurchaseInternational.reduce((t, trans) => t + this.getVatRate(trans), 0))
      }
      return 0
    },
    totalPurchaseTaxValue() {
      // totalPurchaseInputTaxeCredit
      return Math.round(this.purchaseTransactionDetails?.reduce((t, trans) => Number.parseFloat(trans.taxable_value, 10) + t + this.getsdRate(trans), 0))
    },

    totalPurchaseTaxRate() {
      // totalPurchaseInputTaxeCredit
      const totalPurchaseTaxRate = Math.round(this.purchaseTransactionDetails?.reduce((t, trans) => this.getVatRate(trans) + t, 0))

      this.$store.commit('reportninepointone/SET_TOTAL_PURCHASE_VAT', totalPurchaseTaxRate)

      return totalPurchaseTaxRate
    },
  },
  watch: {
    currentEntity() {
      this.getPurchaseTransactions()
    },
    reportDate(newVal) {
      if (newVal != null && Array.isArray(newVal.split('-')) && (newVal.split('-')[1] !== '' && newVal.split('-')[0] !== '')) {
        this.getPurchaseTransactions()
      }
    },
    reportDateRange(newVal) {
      if (Array.isArray(newVal) && newVal.length > 0) {
        this.getPurchaseTransactions()
      }
    },
  },
  mounted() {
    this.getPurchaseTransactions()
  },
  methods: {
    async getPurchaseTransactions() {
      try {
        // if date is not null then get transactions in specific date
        this.$store.commit('UPDATE_IS_LOADER', true)
        if (this.reportDate) {
          const { data: { transactionsProducts } } = await EntityApi.getPurchaseTransactionInDate(this.currentEntity.id,
            this.reportDate)
          this.purchaseTransactionDetails = transactionsProducts
        } else if (Array.isArray(this.reportDateRange)) {
          // else if date range is array then get transaction in date range
          const { data: { transactionsProducts } } = await EntityApi.getPurchaseTransactionInDateRange(this.currentEntity.id, this.reportDateRange[0], this.reportDateRange[1])
          this.purchaseTransactionDetails = transactionsProducts
        }
        this.$store.commit('UPDATE_IS_LOADER', false)

        const totalPurchaseTaxableValue = this.purchaseTransactionDetails?.reduce((t, trans) => Number.parseFloat(trans.taxable_value, 10) + t, 0)

        const totalPurchaseSDValue = this.purchaseTransactionDetails?.reduce((t, trans) => this.getsdRate(trans.sd_rate, 10) + t, 0)

        const totalAtValue = this.purchaseTransactionDetails?.reduce((t, trans) => this.getAtRate(trans) + t, 0)

        this.$store.commit('reportninepointone/SET_TOTAL_PURCHASE_VALUE', totalPurchaseTaxableValue)
        this.$store.commit('reportninepointone/SET_PURCHASE_TRANSACTION_PRODUCTS', this.purchaseTransactionDetails)
        this.$store.commit('reportninepointone/SET_TOTAL_PURCHASE_SD', totalPurchaseSDValue)
        this.$store.commit('reportninepointone/SET_TOTAL_AT_VALUE', totalAtValue)

        // zero rated sells transactions
        this.zeroPurchaseLocal = this.purchaseTransactionDetails.filter(trans => Number.parseInt(trans.tax_rate, 10) === 0 && trans.transaction?.transaction_category === 'local')

        // && trans.transaction?.contact?.bin?.length

        this.zeroPurchaseInternational = this.purchaseTransactionDetails.filter(trans => Number.parseInt(trans.tax_rate, 10) === 0 && trans.transaction?.transaction_category === 'international')
        // && trans?.transaction?.contact?.bin?.length

        // examptedrateds sells
        this.exemptedPurchaseLocal = this.purchaseTransactionDetails?.filter(trans => Number.parseInt(trans.tax_rate, 10) === -1 && trans?.transaction?.transaction_category === 'local')
        // && trans?.transaction?.contact?.bin?.length

        this.exemptedPurchaseInternational = this.purchaseTransactionDetails?.filter(trans => Number.parseInt(trans.tax_rate, 10) === -1 && trans?.transaction?.transaction_category === 'international')
        // && trans?.transaction?.contact?.bin?.length

        // standard rateds sells transactions
        this.standardPurchaseLocal = this.purchaseTransactionDetails?.filter(trans => Number.parseInt(trans.tax_rate, 10) === 15 && trans.transaction?.transaction_category === 'local')

        this.standardPurchaseInternational = this.purchaseTransactionDetails?.filter(trans => Number.parseInt(trans.tax_rate, 10) === 15 && trans?.transaction?.transaction_category === 'international' && trans?.transaction?.contact?.bin?.length)

        // Non Standard Rated purchase local
        this.nonStandardPurchaseLocal = this.purchaseTransactionDetails?.filter(trans => Number.parseFloat(trans.tax_rate, 10) > 0 && Number.parseFloat(trans.tax_rate, 10) < 15 && trans?.transaction?.transaction_category === 'local' && trans?.transaction?.contact?.bin?.length)

        // non standard rated purchase international
        this.nonStandardPurchaseInternational = this.purchaseTransactionDetails?.filter(trans => Number.parseFloat(trans.tax_rate, 10) > 0 && Number.parseFloat(trans.tax_rate, 10) < 15 && trans?.transaction?.transaction_category === 'international' && trans?.transaction?.contact?.bin?.length)

        this.unRegisteredPurchaseLocalForNote20 = this.purchaseTransactionDetails?.filter(trans => Number.parseFloat(trans.tax_rate, 10) < 15 && Number.parseFloat(trans.tax_rate, 10) > 0 && !trans?.transaction?.contact?.bin && trans?.transaction?.transaction_category === 'local')
      } catch (error) {
        console.log(error)
      }
    },
    GoodsDetails(name, params) {
      if (Array.isArray(this.reportDateRange) && this.reportDateRange?.length > 0) {
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
