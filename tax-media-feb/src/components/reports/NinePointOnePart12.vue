<template>
  <div
    class="taxpayer-information"
    style="margin-bottom:0.5rem;margin-top:0.5rem"
  >
    <h2
      style="text-align:center;background:#A9D08E;color:black;padding:5px 0"
      class="py-1 text-uppercase"
    >
      Part-12 : <span>DECLARATION</span>
    </h2>
    <div class="taxpayer-information-table">
      <p>
        I hereby declare that all information provided in this Return Form are complete, true & accurate. In case of any untrue/incomplete statement, I may be subjected to penal action under The Value Added Tax and Supplementary Duty Act, 2012 or any other applicable Act prevailing at present.
      </p>
      <table
        class="table-bordered"
        width="100%"
        style="border-collapse:collapse"
      >
        <tr>

          <th width="10%">
            Name
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            :
          </th>
          <th>
            noor alam khan
          </th>
        </tr>
        <tr>

          <th
            width="20%"
          >
            Designation
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            :
          </th>
          <th

            style="display:flex;justify-content:space-between;align-items:center;"
          >
            Vat expert
          </th>
        </tr>
        <tr>

          <th
            width="20%"
          >
            Mobile number
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            :
          </th>
          <th>
            01725760300
          </th>
        </tr>
        <tr>

          <th
            width="20%"
          > National ID/Passport Number</th>
          <th
            width="10%"
            style="text-align:center;"
          >:</th>
          <th>43243424242355334</th>
        </tr>
        <tr>
          <th
            width="20%"
          >
            Email
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            :
          </th>
          <th>
            nooralamkhan@gmail.com
          </th>
        </tr>
        <tr
          rowspan="2"
        >
          <th
            width="20%"
            style="text-align:left;"
          >
            Signature <br>
            <p>Not required for electronic submission</p>
          </th>
          <th
            width="5%"
            style="text-align:center;"
          >
            :
          </th>
          <th>
            nooralamkhan@gmail.com
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
