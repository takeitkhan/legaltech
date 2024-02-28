<template>

  <section
    id="dashboard-ecommerce"
    class=" mt-5"
  >
    <div class="report-header d-flex my-2">
      <div class="d-flex justify-content-center align-items-center mt-1">
        <h5
          class="mx-1"
          style="font-weight:bold;"
        >
          Filter By:
        </h5>
      </div>
      <div class="filtered-entries">
        <select
          v-model="filteredDate"
          class="form-control mt-1"
          style="width:100%;min-width:250px;"
        >
          <option
            disabled
            value=""
          >
            None
          </option>
          <option
            value="all"
          >
            Select All
          </option>
          <option
            v-for="(custom,key) in customSelectOption"
            :key="key"
            :value="custom"
          >
            {{ custom.text }}
          </option>
        </select>
      </div>
      <div class="date-via-filter d-flex justify-content-center align-items-center mt-1">
        <h5
          class="mx-1"
          style="font-weight:bold;"
        >
          Sub Form Name:
        </h5>
      </div>
      <div class="form-via-filter">
        <select
          v-model="transactionType"
          class="form-control bg-primary text-white mt-1"
          style="width:100%;min-width:150px;"
        >
          <option
            value="all"
            selected
          >
            Select All
          </option>
          <option value="ka-4">
            ka-4
          </option>
          <option value="kha-4">
            kha-4
          </option>
        </select>
      </div>
      <div
        class="mx-2 flex-grow-1 d-flex flex-column"
        style="padding-left:20rem !important; margin-top:-1rem;padding-top:0.5rem;"
      >
        <h2
          style="color:#8176F1;font-weight:bold"
        >
          Mushok 9.1
        </h2>
        <p
          v-if="transactionType"
          style="font-weight:bold"
        >
          Sub Form:<span class="px-1">{{ transactionType }}</span>
        </p>
      </div>

    </div>

    <div
      class="row match-heightcontainer table-responsive"
      style="width:98%;margin-left:10px;"
    >
      <div class="table-header d-flex justify-content-between mb-1">
        <div class="filtered-entries">
          <select
            v-model="currentEntries"
            class="form-control mt-1"
            style="width:100%;min-width:150px;"
          >
            <option
              v-for="(entry,key) in showEntries"
              :key="key"
              :value="entry"
            >
              {{ entry }}
            </option>
          </select>
        </div>
        <div class="date-via-filter">
          <input
            placeholder="Search"
            type="text"
            class="form-control mt-1"
            style="width:100%;min-width:250px;"
          >
        </div>
      </div>
      <div class="table-responsive ">
        <table
          class=" table-hover table-striped table-bordered"
          style="width:100%;"
        >
          <thead style="background:#F4F7FE !important;">
            <tr>
              <th>
                <b-form-checkbox
                  v-model="checked"
                  class="custom-control-primary"
                  style="text-align:center;"
                />
              </th>
              <th
                v-for="(column,index) in columns"
                :key="index"
              >
                {{ column.label }}
              </th>

              <th
                align="center"
              >
                Action
              </th>
            </tr>
          </thead>
          <tbody>

            <tr
              v-for="transaction in filteredTransactions"
              :key="transaction.id"
            >
              <td align="center">
                <b-form-checkbox
                  v-model="checkedTransaction"
                  :value="transaction.id"
                  class="custom-control-primary"
                />
              </td>
              <td>
                {{ transaction.transaction_date }}
              </td>
              <td>
                {{ transaction.transactionType }}
              </td>
              <td>
                {{ transaction.contact_name }}
              </td>

              <td>
                {{ transaction.hs_code }}
              </td>

              <td>
                {{ transaction.product_name }}
              </td>
              <td>
                {{ transaction.taxable_value }}
              </td>
              <td>
                {{ getsdRate(transaction) }} ({{ transaction.sd_rate }}%)
              </td>
              <td>
                {{ getVatRate(transaction) }} ({{ transaction.tax_rate }}%)
              </td>

              <td
                style="text-align:left;padding-left:0px"
              >
                <div class="d-flex align-items-center justify-content-start">
                  <b-dropdown variant="white">
                    <template #button-content>
                      <button class="text-secondary btn">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="14"
                          height="14"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          class="feather feather-more-vertical font-medium-3 cursor-pointer"
                          data-toggle="dropdown"
                        ><circle
                          cx="12"
                          cy="12"
                          r="1"
                        /><circle
                          cx="12"
                          cy="5"
                          r="1"
                        /><circle
                          cx="12"
                          cy="19"
                          r="1"
                        /></svg>
                      </button>
                    </template>
                    <b-dropdown-item href="#">
                      Edit Transaction
                    </b-dropdown-item>
                    <b-dropdown-item href="#">
                      Transaction Details
                    </b-dropdown-item>
                    <b-dropdown-item href="#">
                      Settings
                    </b-dropdown-item>
                  </b-dropdown>
                </div>
              </td>

            </tr>

          </tbody>
          <tfoot class="mt-5">
            <tr>
              <td colspan="6">
                <span style="font-weight:bold;">Total</span>
              </td>
              <td><span style="font-weight:bold;">{{ transactionTotal }}</span></td>
              <td> <span style="font-weight:bold;">{{ totalSD }}</span></td>
              <td colspan="2">
                <span style="font-weight:bold;"> {{ totalVat }}</span>
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
import {
  BFormCheckbox, BDropdown, BDropdownItem,
} from 'bootstrap-vue'
import { mapState } from 'vuex'

export default {
  components: {
    BFormCheckbox, BDropdown, BDropdownItem,
  },
  data() {
    return {
      columns: [
        { label: 'Date', field: 'date' },
        { label: 'Type', field: 'date' },
        { label: 'Contact', field: 'contact' },
        { label: 'HS Code', field: 'hs_code' },
        { label: 'Product Name', field: 'product_name' },
        { label: 'Taxes Value', field: 'taxes_value' },
        { label: 'SD', field: 'sd' },
        { label: 'Vat', field: 'vat' },
      ],
      transactions: [],
      showEntries: [5, 10, 15, 25, 50],
      currentEntries: 10,
      filteredTransactions: [],
      transactionType: 'all',
      checkedTransaction: [],
      checked: false,
      filteredDate: '',
      transactionTotal: 0,
      totalSD: 0,
      totalVat: 0,
    }
  },
  computed: {
    ...mapState(['currentEntity', 'isLoaderOpen']),
    getsdRate() {
      return trans => (trans.taxable_value * trans.sd_rate) / 100
    },
    getVatRate() {
      return trans => (trans.taxable_value * trans.tax_rate) / 100
    },
  },
  watch: {
    currentEntity() {
      this.getTransactions()
    },
    transactionType() {
      this.getTransactionViaType()
    },
    checked() {
      if (this.checked) {
        this.checkedTransaction = this.filteredTransactions.map(item => item.id)
      } else {
        this.checkedTransaction = []
      }
    },
    filteredDate() {
      this.getTransactionViaQuery()
    },
    filteredTransactions() {
      this.transactionTotal = this.filteredTransactions.reduce((t, val) => t + val.taxable_value, 0)
      this.totalSD = this.filteredTransactions.reduce((t, val) => t + this.getsdRate(val), 0)
      this.totalVat = this.filteredTransactions.reduce((t, val) => t + this.getVatRate(val), 0)
    },
  },
  mounted() {
    this.getTransactions()
  },
  methods: {
    async getTransactions() {
      try {
        // start loader
        this.$store.commit('UPDATE_IS_LOADER', true)
        const { data: { transactions } } = await EntityApi.transactions(this.currentEntity.id)
        this.$store.commit('UPDATE_IS_LOADER', false)
        this.transactions = transactions
        this.filteredTransactions = transactions
      } catch (error) {
        // stop loader
        this.$store.commit('UPDATE_IS_LOADER', false)
        console.log(error)
      }
    },
    getTransactionViaType() {
      if (this.transactionType === 'ka-4') {
        this.filteredTransactions = this.transactions.filter(transaction => transaction.transactionType === 'Purchase')
        return
      }
      if (this.transactionType === 'kha-4') {
        this.filteredTransactions = this.transactions.filter(transaction => transaction.transactionType === 'Sell')
        return
      }
      this.filteredTransactions = this.transactions
    },
    async getTransactionViaQuery() {
      try {
        const { data: { transactions } } = await EntityApi.transactionsViaQuery(this.currentEntity.id, JSON.stringify(this.filteredDate))
        // console.log(transactions)
        this.transactions = transactions
        this.getTransactionViaType()
      } catch (error) {
        console.log(error)
      }
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

<style>
.user-timeline-list{
    border-left:1px solid
}
.user-timeline-list .single-timeline .badge{
  width:20px;
  height:20px !important;
  border-radius:50% !important;

}
tr{
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
}
tfoot tr,tfoot tr td{
  height:20px !important;
   padding:20px 10px !important;
   background:#fff;
}
</style>
