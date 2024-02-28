<template>
  <section id="dashboard-ecommerce" class="mt-5">
    <div class="d-flex justify-content-center my-2">
      <h2 style="color: #8176f1; font-weight: bold">
        Sub-form (For Note-{{ $route.params.note }})
      </h2>
    </div>

    <div class="row" style="width: 98%; margin-left: 10px">
      <div class="col-md-6 my-2">
        <button class="btn btn-primary" @click="$router.go(-1)">Back</button>
      </div>
      <!-- <div class="col-md-6 my-2 text-right">
        <button
          class="btn btn-success"
          @click="showTreasuryModal = true"
        >
          Add
          <mdicon
            name="plus-thick"
            class="text-white"
            size="20"
          />
        </button>
        <button class="btn btn-info">
          Edit
          <mdicon
            name="pencil"
            class="text-white"
            size="20"
          />
        </button>
      </div> -->
    </div>

    <div
      class="row match-heightcontainer table-responsive"
      style="width: 98%; margin-left: 10px"
    >
      <div class="table-responsive">
        <table class="table-hover table-striped table-bordered" style="width: 100%">
          <thead style="background: #f4f7fe !important">
            <tr>
              <th v-for="(column, index) in columns" :key="index" class="py-2 px-1">
                {{ column.label }}
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(deposit, index) in currentTreasuryDeposits" :key="index">
              <td v-text="deposit.id" />
              <td v-text="deposit.treasury_challan_number" />
              <td v-text="deposit.bank" />
              <td v-text="deposit.branch" />
              <td v-text="deposit.date" />
              <td v-text="deposit.deposit_account_code" />
              <td v-text="deposit.deposit_amount" />
              <td v-text="note" />
            </tr>
          </tbody>
          <tfoot class="mt-5">
            <tr>
              <td colspan="6">
                <span style="font-weight: bold">Total</span>
              </td>
              <td>
                <span style="font-weight: bold">{{ totalTreasuryDeposits }}</span>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </section>
</template>

<script>
// import {
//   BDropdown, BDropdownItem,
// } from 'bootstrap-vue'
import { ref } from "@vue/composition-api";
import EntityApi from "@/api/entity/EntityApi";
import { format } from "date-fns";
import getQuarterMonth from "@/composition/helpers/getQuarterMonth";
import getFinancialYear from "@/composition/helpers/getFinancialYear";
import { mapState } from "vuex";
// import TreasuryDepositModal from '@/components/global/TreasuryDepositModal.vue'
import govtLogo from "../../assets/gonoprojatontri.jpg";

export default {
  props: {
    // eslint-disable-next-line vue/require-prop-types
    note: {
      required: true,
    },
    // eslint-disable-next-line vue/require-default-prop
    item: {
      require: true,
      type: String,
    },
  },
  data() {
    return {
      columns: [
        { label: "Serial no.", field: "id" },
        { label: "Treasury Challan Number", field: "treasury_challan_number" },
        { label: "Bank", field: "bank" },
        { label: "Branch", field: "branch" },
        { label: "Date", field: "date" },
        { label: "Tax Deposit Account Code", field: "deposit_account_code" },
        { label: "Amount", field: "deposit_amount" },
        { label: "Notes", field: "notes" },
      ],
      govtLogo,
      currentTreasuryDeposits: [],
      prevRoute: null,
    };
  },
  computed: {
    ...mapState(["currentEntity", "reportDate", "reportDateRange"]),
    ...mapState("reportninepointone", {
      treasuryVATDepositsState: (state) => state.treasuryVATDeposits,
      treasurySDDepositsState: (state) => state.treasurySDDeposits,
    }),
    totalTreasuryDeposits() {
      return this.currentTreasuryDeposits?.reduce(
        (total, deposit) => deposit?.deposit_amount + total,
        0
      );
    },
  },
  watch: {
    currentEntity() {
      this.getTreasuryDeposits();
    },
    reportDate(newVal) {
      if (newVal == null) {
        this.$route.push({ name: "reportNinePointOne" });
      }
    },
    reportDateRange(newVal) {
      if (newVal.length < 0) {
        this.$route.push({ name: "reportNinePointOne" });
      }
    },
  },
  mounted() {
    // if (this.prevRoute.name !== 'reportNinePointOne') {
    //   this.$router.go(-1)
    // }
    const { query } = this.$route;
    if (query.date) {
      this.$store.commit("UPDATE_REPORT_DATE", query.date);
      this.$store.commit("UPDATE_REPORT_DATE_RANGE", []);
    } else if (query.fromDate && query.toDate) {
      const { fromDate, toDate } = query;
      this.$store.commit("UPDATE_REPORT_DATE_RANGE", [fromDate, toDate]);
      this.$store.commit("UPDATE_REPORT_DATE", null);
    } else {
      this.$router.push({ name: "reportNinePointOne" });
    }
    // if (parseInt(this.note, 10) === 58) {
    //   this.currentTreasuryDeposits = this.treasuryVATDepositsState
    // }
    // if (parseInt(this.note, 10) === 59) {
    //   this.currentTreasuryDeposits = this.treasurySDDepositsState
    // }
    this.getTreasuryDeposits();
  },
  methods: {
    async getTreasuryDeposits() {
      try {
        this.$store.commit("UPDATE_IS_LOADER", true);
        // report date has date
        if (this.reportDate) {
          const {
            data: { treasuryDeposits },
          } = await EntityApi.getTreasuryDepositsInDateViaDepositType(
            this.currentEntity.id,
            this.reportDate,
            this.item
          );
          this.currentTreasuryDeposits = treasuryDeposits;
        } else if (Array.isArray(this.reportDateRange)) {
          /// reportdaterange has date
          const {
            data: { treasuryDeposits },
          } = await EntityApi.getTreasuryDepositsInDateRangeViaDepositType(
            this.currentEntity.id,
            this.reportDateRange[0],
            this.reportDateRange[1],
            this.item
          );
          this.currentTreasuryDeposits = treasuryDeposits;
        }
      } catch (error) {
        console.log(error);
      }
      this.$store.commit("UPDATE_IS_LOADER", false);
    },
  },

  setup() {
    // methods
    function getLastMonth(date) {
      let lastMonth = date.getMonth() - 1;
      let year = date.getFullYear();
      if (lastMonth < 0) {
        lastMonth = 11;
        year = date.getFullYear() - 1;
      }
      return format(new Date(year, lastMonth), "yyyy-M-d");
    }

    const customSelectOption = ref({
      this_month: {
        format: format(new Date(), "yyyy-M-d"),
        text: "This month",
        sort: "month",
      },
      this_quarter: {
        format: getQuarterMonth(new Date()),
        text: "This quarter",
        sort: "quarter",
      },
      this_financial_year: {
        format: getFinancialYear(new Date()),
        text: "This Financial Year",
        sort: "year",
      },
      last_month: {
        format: getLastMonth(new Date()),
        text: "Last month",
        sort: "lmonth",
      },
      last_quarter: {
        format: getQuarterMonth(new Date(), true),
        text: "Last Quarter",
        sort: "lquarter",
      },
      last_finalcial: {
        format: getFinancialYear(new Date(), true),
        text: "Last Financial Year",
        sort: "lyear",
      },
    });
    const month = ref({
      month: new Date().getMonth(),
      year: new Date().getFullYear(),
    });
    return {
      month,
      customSelectOption,
    };
  },
  beforeRouteEnter(to, from, next) {
    next((vm) => {
      // eslint-disable-next-line no-param-reassign
      vm.prevRoute = from;
    });
  },
};
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.user-timeline-list {
  /* border-left:1px solid */
}

.user-timeline-list .single-timeline .badge {
  width: 20px;
  height: 20px !important;
  border-radius: 50% !important;
}

td,
tr {
  text-align: left;
  padding: 1rem !important;
}

.custom-control-primary {
  padding: 0.5rem;
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
tfoot tr,
tfoot tr td {
  height: 20px !important;
  padding: 20px 10px !important;
  background: #fff;
}
</style>
