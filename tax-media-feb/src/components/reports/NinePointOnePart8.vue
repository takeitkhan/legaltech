<template>
  <div
    class="taxpayer-information"
    style="margin-bottom:0.5rem;margin-top:2rem"
  >
    <h2
      style="text-align:center;background:#A9D08E;color:black;padding:5px 0"
      class="py-1 text-uppercase"
    >
      Part-8 : <span>ADJUSTMENT FOR OLD ACCOUNT CURRENT BALANCE</span>
    </h2>
    <div class="taxpayer-information-table">
      <table
        class="table-bordered"
        width="100%"
        style="border-collapse:collapse"
      >
        <tr style="background:#BDD7EE;">
          <th
            width="10%"
            style="text-align:center;"
          >
            Item
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            Note
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            Amount
          </th>
        </tr>
        <tr style="">
          <th
            width="10%"
            style="text-align:center;"
          >
            Remaining Balance (VAT) from Mushak 18.6 [Rule 118(5)]
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            54
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            -
          </th>
        </tr>
        <tr style="">
          <th
            width="10%"
            style="text-align:center;"
          >
            Remaining Balance (SD) from Mushak 18.6 [Rule 118(5)]
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            55
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            Amount
          </th>
        </tr>
        <tr style="">
          <th
            width="10%"
            style="text-align:center;"
          >
            Decreasing Adjustment for note 54 (up  to 10% of Note 34)
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            56
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            000
          </th>
        </tr>
        <tr style="">
          <th
            width="10%"
            style="text-align:center;"
          >
            Decreasing Adjustment for note 55 (up  to 10% of Note 36)
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            57
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            000
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
