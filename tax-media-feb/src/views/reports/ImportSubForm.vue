<template>
  <section
    id="dashboard-ecommerce"
    class=" mt-5"
  >
    <div class="d-flex justify-content-center flex-column align-items-center mt-1 mb-2">
      <h2>
        <NoteHeader :note="note" />
      </h2>
      <h3
        style="color:#8176F1;font-weight:bold"
        class="mt-2"
      >
        Sub-Form For Export/Import: (For Note-{{ $route.params.note }})
      </h3>
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
      <div class="table-responsive">
        <table
          class="table-hover table-striped table-bordered"
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
              v-for="(details,index) in filteredTransactions"
              :key="index"
            >
              <td v-text="details.id" />
              <td>{{ invoiceOrBillNumber(details) }}</td>
              <td v-text="transactionDate(details)" />
              <td v-text="officeCode(details)" />
              <td v-text="itemNo(details)" />
              <td v-text="CPC(details)" />
              <td>{{ productDetails(details) }}</td>
              <td>{{ productCode(details) }}</td>
              <td>{{ productName(details) }}</td>
              <td v-text="typeof details.taxable_value === 'number'?Number.parseFloat(details.taxable_value).toFixed(2):''" />
              <td v-text="`${parseFloat(getsdRate(details)).toFixed(2)}(${details.sd_rate}%)`" />
              <td v-text="`${parseFloat(getVatRate(details)).toFixed(2)}(${details.tax_rate}%)`" />
              <td v-text="`${parseFloat(getAtRate(details)).toFixed(2)}(${details.at_rate}%)`" />
              <td>{{ note }}</td>
            </tr>

          </tbody>
          <tfoot class="mt-5">
            <tr>
              <td colspan="9">
                <span style="font-weight:bold;">Total</span>
              </td>
              <td colspan="1">
                <span
                  style="font-weight:bold;"
                  v-text="`${parseFloat(getsdRate(transactionTotal)).toFixed(2)}`"
                />
              </td>
              <td colspan="1">
                <span
                  style="font-weight:bold;"
                  v-text="`${parseFloat(getsdRate(totalSD)).toFixed(2)}`"
                />
              </td>
              <td colspan="1">
                <span
                  style="font-weight:bold;"
                  v-text="`${parseFloat(getsdRate(totalVat)).toFixed(2)}`"
                />
              </td>
              <td colspan="1">
                <span
                  style="font-weight:bold;"
                  v-text="`${parseFloat(getsdRate(totalAT)).toFixed(2)}`"
                />
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
// import {
//   BDropdown, BDropdownItem,
// } from 'bootstrap-vue'
import { ref } from '@vue/composition-api'
import EntityApi from '@/api/entity/EntityApi'
import { format } from 'date-fns'
import getQuarterMonth from '@/composition/helpers/getQuarterMonth'
import getFinancialYear from '@/composition/helpers/getFinancialYear'
import NoteHeader from '@/components/reports/NoteHeader.vue'
// import {
//   BFormCheckbox,
// } from 'bootstrap-vue'
import { mapState } from 'vuex'
import govtLogo from '../../assets/gonoprojatontri.jpg'

export default {
  components: {
    // BFormCheckbox,
    NoteHeader,
  },
  props: {
    // eslint-disable-next-line vue/require-prop-types
    note: {
      required: true,
    },
    // eslint-disable-next-line vue/require-prop-types
    transactionCategory: {
      required: true,
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
        { label: 'Invoice/B/E No', field: 'date' },
        { label: 'Date', field: 'contact' },
        { label: 'Office Code', field: 'hs_code' },
        { label: 'Item no', field: 'product_name' },
        { label: 'CPC(Optional)', field: 'taxes_value' },
        { label: 'Goods/Service Commercial Description', field: 'description' },
        { label: 'Goods/Service Code', field: 'code' },
        { label: 'Goods/Service Name', field: 'name' },
        { label: 'Assessble Value', field: 'value' },
        { label: 'SD', field: 'sd_rate' },
        { label: 'VAT', field: 'taxt_rate' },
        { label: 'AT', field: 'at_rate' },
        { label: 'Notes', field: 'note' },
      ],

      transactions: [],
      showEntries: [5, 10, 15, 25, 50],
      currentEntries: 10,
      filteredTransactions: [],
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
      return trans => {
        if (typeof trans?.taxable_value !== 'number') {
          return 0
        }
        return (trans.taxable_value * trans.sd_rate) / 100
      }
    },
    getVatRate() {
      return details => {
        if (details.tax_rate === -1) {
          return 0
        }
        return ((details.taxable_value + this.getsdRate(details)) * details.tax_rate) / 100
      }
    },
    getAtRate() {
      return details => {
        if (details.at_rate === 0) {
          return 0
        }
        return ((details.taxable_value + this.getsdRate(details)) * details.at_rate) / 100
      }
    },
    productDetails() {
      return details => details?.entity_product?.details
    },
    productCode() {
      return details => details?.entity_product?.code
    },
    productName() {
      return details => details?.entity_product?.title
    },
    transactionDate() {
      return details => format(new Date(details?.transaction?.transaction_date), 'dd.MM.yyyy')
    },
    officeCode() {
      return details => details?.transaction?.office_code
    },
    CPC() {
      return details => details?.transaction?.CPC
    },
    itemNo() {
      return details => details?.transaction?.item_no
    },
    invoiceOrBillNumber() {
      return details => details?.transaction?.invoice_no
    },
    totalVat() {
      return Number.parseFloat(this.filteredTransactions.reduce((t, trans) => this.getVatRate(trans) + t, 0)).toFixed(3)
    },
    totalSD() {
      return Number.parseFloat(this.filteredTransactions.reduce((t, trans) => this.getsdRate(trans) + t, 0)).toFixed(3)
    },
    totalAT() {
      return Number.parseFloat(this.filteredTransactions.reduce((t, trans) => this.getAtRate(trans) + t, 0)).toFixed(3)
    },
    transactionTotal() {
      return Number.parseFloat(this.filteredTransactions.reduce((t, trans) => trans.taxable_value + t, 0)).toFixed(3)
    },
  },
  watch: {
    currentEntity() {
      this.getImportTransaction()
    },
    reportDate(newVal) {
      if (newVal == null) {
        this.$route.push({ name: 'reportNinePointOne' })
      }
      // this.getImportTransaction()
    },
    reportDateRange(newVal) {
      if (newVal.length < 0) {
        this.$route.push({ name: 'reportNinePointOne' })
      }
      // this.getImportTransaction()
    },
  },
  mounted() {
    const { query } = this.$route
    if (Object.keys(query).length === 0) {
      this.$router.push({ name: 'reportNinePointOne' })
    }
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
    this.getImportTransaction()
  },
  methods: {
    async getImportTransaction() {
      try {
        this.$store.commit('UPDATE_IS_LOADER', true)
        // report date has date
        if (this.reportDate) {
          const { data: { transactions } } = await EntityApi.getImportTransactionInDate(this.currentEntity.id, this.note, this.reportDate, this.transactionType)
          this.transactions = transactions
        } else if (Array.isArray(this.reportDateRange)) {
          /// reportdaterange has date
          const { data: { transactions } } = await EntityApi.getImportTransactionInDateRange(this.currentEntity.id, this.note, this.reportDateRange[0], this.reportDateRange[1], this.transactionType)
          this.transactions = transactions
        }
        this.filteredTransactions = this.transactions
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
tfoot tr,tfoot tr td{
  height:20px !important;
   padding:20px 10px !important;
   background:#fff;
}
</style>
