<template>
  <div
    class="taxpayer-information"
    style="margin-bottom:1rem;margin-top:2rem"
  >
    <div class="taxpayer-information-table">
      <table
        class="table-bordered"
        width="100%"
        style="border-collapse:collapse"
      >
        <tr
          style="text-align:center;background:#A9D08E;color:black;padding:5px 0"
          class="py-1 text-uppercase"
        >
          <th
            colspan="5"
            style="text-align:center"
          >
            Part-9 : <span>ACCOUNT CODE WISE PAYMENT SCHEDULE (TREASURY DEPOSIT)</span>
          </th>
        </tr>
        <tr style="background:#BDD7EE;">
          <th
            width="10%"
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
            width="10%"
            style="text-align:center;"
          >
            Account Code
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            Amount
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            Action
          </th>
        </tr>
        <tr style="">
          <th
            width="10%"
            style="text-align:center;"
          >
            VAT Deposit for the Current Tax Period
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            58
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            {{ accountCodeVAT }}
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >{{ totalVATDeposits }}</th>
          <th
            width="10%"
            style="text-align:center;"
          >
            <!-- <router-link
              :to="{name:'TreasuryDepositSubForm',params:{note:58,item:'VAT'}}"
            >Sub-form</router-link> -->
            <a @click.prevent="GoodsDetails('TreasuryDepositSubForm',{note:58,item:'VAT'})">Sub-form</a>
          </th>
        </tr>
        <tr style="">
          <th
            width="10%"
            style="text-align:center;"
          >
            SD Deposit for the Current Tax Period
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            59
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            {{ accountCodeSD }}
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >{{ totalSDDeposits }}</th>
          <th
            width="10%"
            style="text-align:center;"
          >
            <!-- <router-link
              :to="{name:'TreasuryDepositSubForm',params:{note:58,item:'SD'}}"
            >Sub-form</router-link> -->
            <a @click.prevent="GoodsDetails('TreasuryDepositSubForm',{note:59,item:'SD'})">Sub-form</a>
          </th>
        </tr>
        <tr style="">
          <th
            width="10%"
            style="text-align:center;"
          >
            Excise Duty
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            60
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            1-1133-0015-0311
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >-</th>
          <th
            width="10%"
            style="text-align:center;"
          >
            <a>Sub-form</a>
          </th>
        </tr>
        <tr style="">
          <th
            width="10%"
            style="text-align:center;"
          >
            Development Surcharge
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            61
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            1-1133-0015-0311
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >-</th>
          <th
            width="10%"
            style="text-align:center;"
          >
            <a>Sub-form</a>
          </th>
        </tr>
        <tr style="">
          <th
            width="10%"
            style="text-align:center;"
          >
            ICT Development Surcharge
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            62
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            1-1133-0015-0311
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >-</th>
          <th
            width="10%"
            style="text-align:center;"
          >
            <a>Sub-form</a>
          </th>
        </tr>
        <tr style="">
          <th
            width="10%"
            style="text-align:center;"
          >
            Health Care Surcharge
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            63
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            1-1133-0015-0311
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >-</th>
          <th
            width="10%"
            style="text-align:center;"
          >
            <a>Sub-form</a>
          </th>
        </tr>
        <tr style="">
          <th
            width="10%"
            style="text-align:center;"
          >
            Environmental Protection Surcharge
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            64
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >
            1-1133-0015-0311
          </th>
          <th
            width="10%"
            style="text-align:center;"
          >-</th>
          <th
            width="10%"
            style="text-align:center;"
          >
            <a>Sub-form</a>
          </th>
        </tr>

      </table>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import EntityApi from '@/api/entity/EntityApi'

export default {
  data: () => ({
    eight: 0,
    treasuryVATDeposits: [],
    treasurySDDeposits: [],
  }),
  computed: {
    ...mapState(['currentEntity', 'reportDate', 'reportDateRange']),
    ...mapState('reportninepointone', {
      treasuryVATDepositsState: state => state.treasuryVATDeposits,
      treasurySDDepositsState: state => state.treasurySDDeposits,
    }),
    accountCodeSD() {
      if (this.treasuryVATDepositsState.length > 0) {
        return this.treasuryVATDepositsState?.[0].deposit_account_code
      }
      return null
    },
    accountCodeVAT() {
      if (this.treasurySDDepositsState.length > 0) {
        return this.treasurySDDepositsState?.[0].deposit_account_code
      }
      return null
    },
    totalVATDeposits() {
      return this.treasuryVATDepositsState.reduce((t, challan) => t + (challan?.deposit_amount ?? 0), 0)
    },
    totalSDDeposits() {
      return this.treasurySDDepositsState.reduce((t, challan) => t + (challan?.deposit_amount ?? 0), 0)
    },
  },
  watch: {
    currentEntity() {
      this.getTreasuryDeposits()
    },
    reportDate() {
      this.getTreasuryDeposits()
    },
    reportDateRange() {
      this.getTreasuryDeposits()
    },

  },
  mounted() {
    this.getTreasuryDeposits()
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
    async getTreasuryDeposits() {
      try {
        this.$store.commit('UPDATE_IS_LOADER', true)
        let treasuryDeposits = []
        // report date has date
        if (this.reportDate) {
          const { data } = await EntityApi.getTreasuryDepositsInDate(this.currentEntity.id, this.reportDate)
          treasuryDeposits = data.treasuryDeposits
        } else if (Array.isArray(this.reportDateRange)) {
          const { data } = await EntityApi.getTreasuryDepositsInDateRange(this.currentEntity.id, this.reportDateRange[0], this.reportDateRange[1])
          treasuryDeposits = data.treasuryDeposits
        }

        this.treasuryVATDeposits = treasuryDeposits?.filter(deposit => {
          if (deposit?.deposit_type === 'VAT') {
            return true
          }
          return false
        })
        this.treasurySDDeposits = treasuryDeposits?.filter(deposit => {
          if (deposit?.deposit_type === 'SD') {
            return true
          }
          return false
        })
        this.$store.commit('reportninepointone/SET_TREASURY_VAT_DEPOSITS', this.treasuryVATDeposits)
        this.$store.commit('reportninepointone/SET_TREASURY_SD_DEPOSITS', this.treasurySDDeposits)
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
