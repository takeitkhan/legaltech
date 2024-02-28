<template>
  <div
    class="taxpayer-information"
    style="margin-bottom:1rem;margin-top:0.5rem"
  >
    <h2
      style="text-align:center;background:#A9D08E;color:black;padding:5px 0"
      class="py-1 text-uppercase"
    >
      Part-11 : <span>REFUND</span>
    </h2>
    <div class="taxpayer-information-table">
      <table
        class="table-bordered"
        width="100%"
        style="border-collapse:collapse"
      >
        <tr>
          <th
            rowspan="3"
            width="30%"
          >
            <textarea style="width:90%;height:100px;padding:10px;">I am interested to get refund of my closing balance</textarea>
          </th>
          <th
            width="30%"
            style="text-align:center;"
          >
            Items
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            Note
          </th>
          <th

            style="text-align:center;display:flex;justify-content:center;align-items:center;"
            colspan="2"
          >
            <label style="padding:10px;">Yes</label><input
              type="checkbox"
              name="refund"
            >
            <label style="padding:10px;">No</label><input
              type="checkbox"
              name="refund"
            >
          </th>
        </tr>

        <tr style="">
          <th
            style="text-align:center;"
          >
            Requested Amount for Refund (VAT)
          </th>
          <th
            style="text-align:center;"
          >
            67
          </th>
          <th
            style="text-align:center;"
          >
            0.00
          </th>
        </tr>
        <tr style="">
          <th
            style="text-align:center;"
          >
            Requested Amount for Refund (SD)
          </th>
          <th
            style="text-align:center;"
          >
            68
          </th>
          <th
            style="text-align:center;"
          >
            0.00
          </th>
        </tr>

      </table>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
// import EntityApi from '@/api/entity/EntityApi'

export default {
  data: () => ({
    eight: 0,
  }),
  computed: {
    ...mapState(['currentEntity', 'reportDate', 'reportDateRange']),
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
tfoot tr,tfoot tr td{
  height:20px !important;
   padding:20px 10px !important;
   background:#fff;
}
</style>
