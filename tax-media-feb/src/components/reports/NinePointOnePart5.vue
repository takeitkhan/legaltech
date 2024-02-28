<template>
  <div class="taxpayer-information">
    <h2
      style="text-align:center;background:#A9D08E;color:black;"
      class="py-1 text-uppercase"
    >
      Part-5 : <span>INCREASING ADJUSTMENTS(VAT)</span>
    </h2>
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
          >Adjustment Details</th>
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
            Vat Amount
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
            colspan="2"
            style="padding-left:1rem;"
          >Due to VAT Deducted at source by the supply receiver</th>
          <th style="text-align:center">
            24
          </th>
          <th style="text-align:center">
            -
          </th>
          <th style="text-align:center">
            <a @click.prevent="GoodsDetails('SubFormForTwentyFour',{note:24})">Sub-form</a>
          </th>
        </tr>
        <!-- end of single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            colspan="2"
            style="padding-left:1rem;"
          >
            Payment Not Made Through Banking Channel
          </th>
          <th style="text-align:center">
            25
          </th>
          <th style="text-align:center">
            -
          </th>
          <th style="text-align:center">
            <a @click.prevent="GoodsDetails('localSubForm',{note:25,transactionCategory:'local',transactionType:1})">Sub-form</a>
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            colspan="2"
            style="padding-left:1rem;"
          >
            Issuance of Debit Note
          </th>
          <th style="text-align:center">
            26
          </th>
          <th style="text-align:center">
            -
          </th>
          <th style="text-align:center">
            <a @click.prevent="GoodsDetails('localSubForm',{note:26,transactionCategory:'local',transactionType:1})">Sub-form</a>
          </th>
        </tr>
        <!-- .single nature  -->
        <!-- .single nature  -->
        <tr>
          <th
            colspan="2"
            style="padding-left:1rem;"
          >
            <p> Any Other Adjustments (please specify below)</p>

            <p><textarea class="form-control">other Adjustment</textarea></p>
          </th>
          <th style="text-align:center">
            27
          </th>
          <th style="text-align:center">
            {{ totalAnyOtherAdjustment }}
          </th>
          <th>Sub-form</th>
        </tr>
        <!-- .single nature  -->
        <tr>
          <th
            colspan="2"
            style="padding-left:1rem;"
          >
            Total Increasing Adjustment
          </th>
          <th style="text-align:center">
            28
          </th>
          <th style="text-align:center;background:#E7E6E6">
            0.00
          </th>
        </tr>
        <!-- .single nature  -->
      </table>
    </div>
    <VATAdjustmentModal
      v-if="showAdjustmentModal"
      title="Add Increasing Adjustment"
      buttontext="Close"
      :form="form"
      @closeModal="showAdjustmentModal=false"
    />
  </div>
</template>

<script>
import { mapState } from 'vuex'
import EntityApi from '@/api/entity/EntityApi'
import VATAdjustmentModal from '@/components/global/VATAdjustmentModal.vue'

export default {
  components: {
    VATAdjustmentModal,
  },
  data: () => ({
    adjustments: [],
    showAdjustmentModal: false,
  }),
  computed: {
    ...mapState(['currentEntity', 'reportDate', 'reportDateRange']),
    totalAnyOtherAdjustment() {
      return this.adjustments.reduce((t, adjustment) => t + Math.round((adjustment?.vat?.rate * adjustment.amount) / 100), 0)
    },
  },
  watch: {
    currentEntity() {
      this.getAdjustments()
    },
    reportDate() {
      this.getAdjustments()
    },
    reportDateRange() {
      this.getAdjustments()
    },

  },
  mounted() {
    this.getAdjustments()
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
    async getAdjustments() {
      try {
        this.$store.commit('UPDATE_IS_LOADER', true)
        // report date has date
        if (this.reportDate) {
          const { data: { adjustments } } = await EntityApi.getAdjustmentsInDate(this.currentEntity.id, this.reportDate, 'increasing')
          this.adjustments = adjustments
        } else if (Array.isArray(this.reportDateRange)) {
          /// reportDate range has date
          const { data: { adjustments } } = await EntityApi.getAdjustmentsViaDateRange(this.currentEntity.id, this.reportDateRange[0], this.reportDateRange[1], 'increasing')
          this.adjustments = adjustments
        }
      } catch (error) {
        console.log(error)
      }
      this.$store.commit('UPDATE_IS_LOADER', false)
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
tfoot tr,tfoot tr td{
  height:20px !important;
   padding:20px 10px !important;
   background:#fff;
}
</style>
