<template>

  <section
    id="dashboard-ecommerce"
    class=" mt-5"
  >
    <div class="d-flex justify-content-center my-2">
      <h2
        style="color:#8176F1;font-weight:bold"
      >
        Sub-form (For Note-{{ $route.params.note }})
      </h2>
    </div>

    <div
      class="row match-heightcontainer table-responsive"
      style="width:98%;margin-left:10px;"
    >
      <div class="col-md-12 my-2">
        <button
          class="btn btn-primary"
          @click="$router.go(-1)"
        >
          Back
        </button>
      </div>
      <div class="table-responsive ">
        <table
          class=" table-hover table-striped table-bordered"
          style="width:100%;"
        >
          <thead style="background:#F4F7FE !important;">
            <tr>
              <th
                v-for="(column,index) in columns"
                :key="index"
                class="py-2 px-1"
              >
                {{ column.label }}
              </th>
            </tr>
          </thead>
          <tbody>

            <tr
              v-for="(transactionDetail,index) in filteredTransactionDetails"
              :key="index"
            >
              <td>{{ transactionDetail.id }}</td>
              <td>{{ productDetails(transactionDetail) }}</td>
              <td>{{ productCode(transactionDetail) }}</td>
              <td>{{ productName(transactionDetail) }}</td>
              <td v-text="typeof transactionDetail.taxable_value === 'number'?Math.round(transactionDetail.taxable_value):0.00" />
              <td>{{ Number(note) === 20 ?'0.00': getsdRate(transactionDetail)+`(${transactionDetail.sd_rate}%)` }}</td>
              <td> {{ Number(note) === 20 ?'0.00':getVatRate(transactionDetail)+ `(${transactionDetail.tax_rate}%)` }}</td>
              <td>{{ note }}</td>
            </tr>

          </tbody>
          <tfoot class="mt-5">
            <tr>
              <td colspan="4">
                <span style="font-weight:bold;">Total</span>
              </td>
              <td><span style="font-weight:bold;">{{ transactionTotal }}</span></td>
              <td> <span style="font-weight:bold;">{{ Number(note) === 20 ?'0.00': totalSD }}</span></td>
              <td colspan="2">
                <span style="font-weight:bold;"> {{ Number(note) === 20 ?'0.00':totalVat }}</span>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>

      <div class="transaction-footer" />
    </div>
  </section>

</template>

<script>
import { ref } from '@vue/composition-api'
import EntityApi from '@/api/entity/EntityApi'
import { format } from 'date-fns'
import getQuarterMonth from '@/composition/helpers/getQuarterMonth'
import getFinancialYear from '@/composition/helpers/getFinancialYear'
import { mapState } from 'vuex'
import govtLogo from '../../assets/gonoprojatontri.jpg'

export default {
  props: {
    // eslint-disable-next-line vue/require-prop-types
    note: {
      required: true,
    },
    transactionCategory: {
      required: true,
      type: String, // local,international
    },
    // eslint-disable-next-line vue/require-prop-types
    transactionType: {
      required: true,
    },
  },
  data() {
    return {
      columns: [
        { label: 'Serial No.', field: 'id' },
        { label: 'Goods/Service  Commercial Description', field: 'date' },
        { label: 'Goods/Service Code', field: 'contact' },
        { label: 'Goods/Service Name', field: 'hs_code' },
        { label: 'Value (a)', field: 'taxable_value' },
        { label: 'SD (b)', field: 'sd value' },
        { label: 'VAT (c)', field: 'vat' },
        { label: 'Note', field: 'note' },
      ],

      transactions: [],
      showEntries: [5, 10, 15, 25, 50],
      currentEntries: 10,
      filteredTransactionDetails: [],
      checkedTransaction: [],
      checked: false,
      filteredDate: '',
      govtLogo,
      year: format(new Date(), 'yyyy'),
      month: format(new Date(), 'MMMM'),
      dateRange: null,
    }
  },
  computed: {
    ...mapState(['currentEntity', 'reportDate', 'reportDateRange']),
    getsdRate() {
      return trans => Math.round((trans.taxable_value * trans.sd_rate) / 100)
    },
    getVatRate() {
      return trans => {
        if (trans.tax_rate === -1 || this.note === 20) { // 20 = unregistered
          return 0
        }
        return Math.round(((trans.taxable_value + this.getsdRate(trans)) * trans.tax_rate) / 100)
      }
    },
    productDetails() {
      return trans => trans?.entity_product?.details
    },
    productCode() {
      return trans => trans?.entity_product?.code
    },
    productName() {
      return trans => trans?.entity_product?.title
    },
    transactionTotal() {
      if (Number(this.transactionType) === 1) {
        return Math.round(this.filteredTransactionDetails.reduce((t, trans) => t + trans.taxable_value, 0))
      }
      return Math.round(this.filteredTransactionDetails.reduce((t, trans) => trans.taxable_value + t, 0))
    },
    totalVat() {
      // return Number.parseFloat().toFixed(3)
      if (this.note === 20) {
        return 0
      }
      return Math.round(this.filteredTransactionDetails.reduce((t, trans) => this.getVatRate(trans) + t, 0))
    },
    totalSD() {
      return Math.round(this.filteredTransactionDetails.reduce((t, trans) => this.getsdRate(trans) + t, 0))
    },

  },
  watch: {
    currentEntity() {
      this.getLocalTransaction()
    },
    checked() {
      if (this.checked) {
        this.checkedTransaction = this.filteredTransactionDetails.map(item => item.id)
      } else {
        this.checkedTransaction = []
      }
    },
    reportDate(newVal) {
      if (newVal == null) {
        this.$route.push({ name: 'reportNinePointOne' })
      }
    },
    reportDateRange(newVal) {
      if (newVal.length < 0) {
        this.$route.push({ name: 'reportNinePointOne' })
      }
    },
  },
  mounted() {
    const { query } = this.$route
    if (query.date) {
      this.$store.commit('UPDATE_REPORT_DATE', query.date)
      this.$store.commit('UPDATE_REPORT_DATE_RANGE', [])
    } else if (query.fromDate && query.toDate) {
      const { fromDate, toDate } = query
      this.$store.commit('UPDATE_REPORT_DATE_RANGE', [fromDate, toDate])
      this.$store.commit('UPDATE_REPORT_DATE', null)
    } else {
      this.$router.push({ name: 'reportNinePointOne' })
    }
    this.getLocalTransaction()
  },
  methods: {
    async getLocalTransaction() {
      try {
        this.$store.commit('UPDATE_IS_LOADER', true)
        // report date has date
        if (this.reportDate) {
          const { data: { transactionProducts } } = await EntityApi.getLocalTransactionInDate(this.currentEntity.id, this.note, this.reportDate, this.transactionType)
          this.transactions = transactionProducts.filter(trans => {
            // if note is 20 and bin is not exist and transaction type s purchase then 
            if (Number(this.note) === 20 && !trans.transaction?.contact?.bin && Number(this.transactionType) === 1) {
              return true
            }
            // if transaction has been and transaction_type is purchase or sells then
            if (trans?.transaction?.contact?.bin || Number(this.transactionType) === 2 || Number(this.transactionType) === 1) {
              return true
            }
            return false
          })
        } else if (Array.isArray(this.reportDateRange)) {
          /// reportDate range has date
          const { data: { transactionProducts } } = await EntityApi.getLocalTransactionInDateRange(this.currentEntity.id, this.note, this.reportDateRange[0], this.reportDateRange[1], this.transactionType)
          this.transactions = transactionProducts.filter(trans => {
            if (Number(this.note) === 20 && !trans.transaction?.contact?.bin && Number(this.transactionType) === 1) {
              return true
            }
            if (trans?.transaction?.contact?.bin || Number(this.transactionType) === 2 || Number(this.transactionType) === 1) {
              return true
            }
            return false
          })
        }
        this.filteredTransactionDetails = this.transactions
      } catch (error) {
        console.log(error)
      }
      this.$store.commit('UPDATE_IS_LOADER', false)
    },
  },

  setup() {
    // methods
    function getLastMonth(date) {
      let lastMonth = date.getMonth() - 1
      let year = date.getFullYear()
      if (lastMonth < 0) {
        lastMonth = 11
        year = date.getFullYear() - 1
      }
      return format(new Date(year, lastMonth), 'yyyy-M-d')
    }

    const customSelectOption = ref({
      this_month: { format: format(new Date(), 'yyyy-M-d'), text: 'This month', sort: 'month' },
      this_quarter: { format: getQuarterMonth(new Date()), text: 'This quarter', sort: 'quarter' },
      this_financial_year: { format: getFinancialYear(new Date()), text: 'This Financial Year', sort: 'year' },
      last_month: { format: getLastMonth(new Date()), text: 'Last month', sort: 'lmonth' },
      last_quarter: { format: getQuarterMonth(new Date(), true), text: 'Last Quarter', sort: 'lquarter' },
      last_finalcial: { format: getFinancialYear(new Date(), true), text: 'Last Financial Year', sort: 'lyear' },
    })
    const month = ref({
      month: (new Date()).getMonth(),
      year: (new Date()).getFullYear(),
    })
    return {
      month,
      customSelectOption,
    }
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
td,tr{
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
