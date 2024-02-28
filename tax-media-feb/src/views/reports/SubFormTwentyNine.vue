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
        Sub-Form (For Note-{{ $route.params.note }})
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
            <!-- <tr
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
            </tr> -->

          </tbody>
          <tfoot class="mt-5">
            <tr>
              <td colspan="9">
                <span style="font-weight:bold;">Total</span>
              </td>
              <!-- <td colspan="1">
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
              </td> -->
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
// import { ref } from '@vue/composition-api'
// import EntityApi from '@/api/entity/EntityApi'
import { format } from 'date-fns'
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
        { label: 'Buyer\'s BIN', field: 'date' },
        { label: 'Buyer\'s Name', field: 'date' },
        { label: 'Buyer\'s Address', field: 'contact' },
        { label: 'Value', field: 'hs_code' },
        { label: 'Deducted VAT', field: 'product_name' },
        { label: 'Invoice No.(Challan/Bill No. etc.)', field: 'challan_no' },
        { label: 'Invoice/Challan/Bill Date', field: 'description' },
        { label: 'VAT Deduction at Source Certificate No', field: 'certification_no' },
        { label: 'VAT Deduction at Source Certificate Date', field: 'certification_date' },
        { label: 'Tax Deposit Account Code', field: 'value' },
        { label: 'Tax Deposit Serial Number of Book Transfer', field: 'sd_rate' },
        { label: 'Tax Deposit Date', field: 'taxt_rate' },
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
  },
  watch: {
    currentEntity() {
    //   this.getImportTransaction()
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

  },
  methods: {
  
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
