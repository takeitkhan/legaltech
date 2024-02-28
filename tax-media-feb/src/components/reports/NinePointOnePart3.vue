<template>
  <div class="taxpayer-information">
    <h2
      style="text-align: center; background: #a9d08e; color: black"
      class="py-1 text-uppercase"
    >
      Part-3 : <span>SUPPLY-OUTPUT TAX</span>
    </h2>
    <div class="taxpayer-information-table">
      <table class="table-bordered" width="100%">
        <tr style="background: #bdd7ee">
          <th colspan="2" style="text-align: center" class="py-1 pl-1" width="40%">
            Nature of Supply
          </th>
          <th style="text-align: center">Note</th>
          <th style="text-align: center">Value (a)</th>
          <th style="text-align: center">SD(b)</th>
          <th style="text-align: center">VAT(c)</th>
          <th style="text-align: center">Action</th>
        </tr>
        <tr>
          <th style="padding-left: 10px" rowspan="2">Zero Rated Goods/Service</th>
          <th>Direct Export</th>
          <th>1</th>
          <th>{{ zeroSellsTaxesValueSum }}</th>
          <th style="text-align: center; background: #e7e6e6" />
          <th style="text-align: center; background: #e7e6e6" />
          <th style="text-align: center">
            <a
              @click.prevent="
                GoodsDetails('localSubForm', {
                  note: 1,
                  transactionCategory: 'local',
                  transactionType: 2,
                })
              "
              >Sub-form</a
            >
          </th>
        </tr>
        <tr>
          <th>Deemed Export</th>
          <th>2</th>
          <th>0.00</th>
          <!-- <th>{{ Number.parseFloat(zeroSellsTaxesValueSum).toFixed(2) }}</th> -->
          <th style="text-align: center; background: #e7e6e6" />
          <th style="text-align: center; background: #e7e6e6" />
          <th style="text-align: center">
            <a
              @click.prevent="
                GoodsDetails('localSubForm', {
                  note: 2,
                  transactionCategory: 'local',
                  transactionType: 2,
                })
              "
              >Sub-form</a
            >
          </th>
        </tr>
        <tr>
          <th colspan="2" style="padding-left: 1rem">Exempted Goods/Service</th>
          <th>3</th>
          <th>{{ Number.parseFloat(exemptedSellsTaxesValueSum).toFixed(2) }}</th>
          <th style="text-align: center; background: #e7e6e6" />
          <th style="text-align: center; background: #e7e6e6" />
          <th style="text-align: center">
            <a
              @click.prevent="
                GoodsDetails('localSubForm', {
                  note: 3,
                  transactionCategory: 'local',
                  transactionType: 2,
                })
              "
              >Sub-form</a
            >
          </th>
        </tr>
        <tr>
          <th colspan="2" style="padding-left: 1rem">Standard Rated Goods/Service</th>
          <th>4</th>
          <th>{{ standardSellsTaxesValueSum }}</th>
          <th>{{ Number.parseFloat(standardSellsSDRateSum).toFixed(2) }}</th>
          <th>{{ Number.parseFloat(standardSellsTaxRateSum).toFixed(2) }}</th>
          <th style="text-align: center">
            <a
              @click.prevent="
                GoodsDetails('localSubForm', {
                  note: 4,
                  transactionCategory: 'local',
                  transactionType: 2,
                })
              "
              >Sub-form</a
            >
          </th>
        </tr>
        <tr>
          <th colspan="2" style="padding-left: 1rem">
            <p>Goods Based on MRP</p>
          </th>
          <th>5</th>
          <th>{{ MRPSellsTaxesValueSum }}</th>
          <th>{{ Number.parseFloat(MRPSellsSDRateSum).toFixed(2) }}</th>
          <th>{{ Number.parseFloat(MRPSellsTaxRateSum).toFixed(2) }}</th>
          <th style="text-align: center">
            <a
              @click.prevent="
                GoodsDetails('localSubForm', {
                  note: 5,
                  transactionCategory: 'local',
                  transactionType: 2,
                })
              "
              >Sub-form</a
            >
          </th>
        </tr>
        <tr>
          <th colspan="2" style="padding-left: 1rem">
            <p>Goods/Service Based on Specific VAT</p>
          </th>
          <th>6</th>
          <th>0.00</th>
          <th>0.00</th>
          <th>0.00</th>
          <th style="text-align: center">
            <a
              @click.prevent="
                GoodsDetails('localSubForm', {
                  note: 6,
                  transactionCategory: 'local',
                  transactionType: 2,
                })
              "
              >Sub-form</a
            >
          </th>
        </tr>
        <tr>
          <th colspan="2" style="padding-left: 1rem">
            <p>Goods/Service Other than Standard Vat</p>
          </th>
          <th>7</th>
          <th v-text="Number.parseFloat(nonStandardSellsTaxesValueSum).toFixed(2)" />
          <th v-text="Number.parseFloat(nonStandardSellsSDRateSum).toFixed(2)" />
          <th v-text="Number.parseFloat(nonStandardSellsTaxRateSum).toFixed(2)" />
          <th style="text-align: center">
            <a
              @click.prevent="
                GoodsDetails('localSubForm', {
                  note: 7,
                  transactionCategory: 'local',
                  transactionType: 2,
                })
              "
              >Sub-form</a
            >
          </th>
        </tr>
        <tr>
          <th colspan="2" style="padding-left: 1rem">
            <p>Retail/WholeSale/Trade Based Supply</p>
          </th>
          <th>8</th>
          <th v-text="Number.parseFloat(tradingBasedSellsTaxesValueSum).toFixed(2)" />
          <th v-text="Number.parseFloat(tradingBasedSellsSDRateSum).toFixed(2)" />
          <th v-text="Number.parseFloat(tradingBasedSellsTaxRateSum).toFixed(2)" />
          <th style="text-align: center">
            <a
              @click.prevent="
                GoodsDetails('localSubForm', {
                  note: 8,
                  transactionCategory: 'local',
                  transactionType: 2,
                })
              "
              >Sub-form</a
            >
          </th>
        </tr>
        <tr>
          <th colspan="2" style="padding-left: 1rem">
            <p>Total Sales Value & Total Payable Taxes</p>
          </th>
          <th>9</th>
          <th style="text-align: center; background: #e7e6e6">
            {{ Number.parseFloat(totalSellsTaxValue).toFixed(2) }}
          </th>
          <th style="text-align: center; background: #e7e6e6">
            {{ Number.parseFloat(totalSellsSdRate).toFixed(2) }}
          </th>
          <th style="text-align: center; background: #e7e6e6">
            {{ Number.parseFloat(totalSellsTaxRate).toFixed(2) }}
          </th>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
import EntityApi from "@/api/entity/EntityApi";

export default {
  data: () => ({
    sellsTransactionDetails: [],
    zeroRatedSells: [],
    exemptedRatedSells: [],
    standardRatedSells: [],
    tradingBasedRatedSells: [],
    MRPSells: [],
    NonStandardRatedSells: [],
    isDateRange: false,
    //  SpecificVatTransactions: [], // still not used
    //   RetailOrWholeSaleOrTradeBasedSellsTransactions: [], // still not used
  }),
  computed: {
    ...mapState(["currentEntity", "reportDate", "reportDateRange"]),
    getsdRate() {
      return (trans) => {
        if (trans.transaction?.contact?.bin?.length) {
          return Number.parseFloat(trans.taxable_value * trans.sd_rate) / 100;
        }
        return 0;
      };
    },
    getVatRate() {
      return (trans) => {
        if (trans.tax_rate === -1 || trans.tax_rate === 0) {
          return 0;
        }
        // || !trans?.transaction?.contact?.bin
        // return (trans.taxable_value * trans.tax_rate) / 100
        return ((trans.taxable_value + this.getsdRate(trans)) * trans.tax_rate) / 100;
      };
    },
    zeroSellsTaxesValueSum() {
      if (this.zeroRatedSells.length > 0) {
        return Math.round(
          this.zeroRatedSells.reduce(
            (t, trans) => t + parseFloat(trans.taxable_value, 10),
            0
          )
        );
      }
      return 0;
    },
    zeroSellsSdRateSum() {
      if (this.zeroRatedSells.length > 0) {
        return Math.round(
          this.zeroRatedSells.reduce((t, trans) => t + parseFloat(trans.sd_rate, 10), 0)
        );
      }
      return 0;
    },
    exemptedSellsTaxesValueSum() {
      if (this.exemptedRatedSells.length > 0) {
        return Math.round(
          this.exemptedRatedSells.reduce(
            (t, trans) => t + parseFloat(trans.taxable_value, 10),
            0
          )
        );
      }
      return 0;
    },
    exemptedSellsSdRateSum() {
      if (this.exemptedRatedSells.length > 0) {
        return Math.round(
          this.exemptedRatedSells.reduce(
            (t, trans) => t + parseFloat(trans.sd_rate, 10),
            0
          )
        );
      }
      return 0;
    },
    standardSellsTaxesValueSum() {
      if (this.standardRatedSells.length > 0) {
        return Math.round(
          this.standardRatedSells.reduce(
            (t, trans) => t + parseFloat(trans.taxable_value, 10),
            0
          )
        );
      }
      return 0;
    },
    standardSellsSDRateSum() {
      if (this.standardRatedSells.length > 0) {
        return Math.round(
          this.standardRatedSells.reduce((t, trans) => t + this.getsdRate(trans), 0)
        );
      }
      return 0;
    },
    standardSellsTaxRateSum() {
      // standard Rated Sells Transactions sells transactions exist then get total tax rate sum
      if (this.standardRatedSells.length > 0) {
        return Math.round(
          this.standardRatedSells.reduce((t, trans) => t + this.getVatRate(trans), 0)
        );
      }
      return 0;
    },
    nonStandardSellsTaxesValueSum() {
      // nonStandardRated sells transactions exist then get total tax rate sum
      if (this.NonStandardRatedSells.length > 0) {
        return Math.round(
          this.NonStandardRatedSells.reduce(
            (t, trans) => t + parseFloat(trans.taxable_value, 10),
            0
          )
        );
      }
      return 0;
    },
    nonStandardSellsSDRateSum() {
      // nonStandardRated sells transactions exist then get total sd rate sum
      if (this.NonStandardRatedSells.length > 0) {
        return Math.round(
          this.NonStandardRatedSells.reduce((t, trans) => t + this.getsdRate(trans), 0)
        );
      }
      return 0;
    },
    nonStandardSellsTaxRateSum() {
      // nonStandardRated sells transactions exist then get total tax rate sum
      if (this.NonStandardRatedSells.length > 0) {
        return Math.round(
          this.NonStandardRatedSells.reduce((t, trans) => t + this.getVatRate(trans), 0)
        );
      }
      return 0;
    },
    tradingBasedSellsTaxesValueSum() {
      // tradingBasedRatedSells sells transactions exist then get total tax rate sum
      if (this.tradingBasedRatedSells.length > 0) {
        return Math.round(
          this.tradingBasedRatedSells.reduce(
            (t, trans) => t + parseFloat(trans.taxable_value, 10),
            0
          )
        );
      }
      return 0;
    },
    tradingBasedSellsTaxRateSum() {
      // nonStandardRated sells transactions exist then get total tax rate sum
      if (this.tradingBasedRatedSells.length > 0) {
        return Math.round(
          this.tradingBasedRatedSells.reduce((t, trans) => t + this.getVatRate(trans), 0)
        );
      }
      return 0;
    },

    tradingBasedSellsSDRateSum() {
      // nonStandardRated sells transactions exist then get total sd rate sum
      if (this.tradingBasedRatedSells.length > 0) {
        return Math.round(
          this.tradingBasedRatedSells.reduce((t, trans) => t + this.getsdRate(trans), 0)
        );
      }
      return 0;
    },

    MRPSellsTaxesValueSum() {
      // if MRP sells transactions exist then get total Taxes Value sum
      // if (this.MRPSells.length > 0) {
      //   return this.MRPSells.reduce((t, trans) => t + parseFloat(trans.taxable_value, 10), 0)
      // }
      return 0;
    },
    MRPSellsTaxRateSum() {
      // if MRP sells transactions exist then get total tax rate sum
      // if (this.MRPSells.length > 0) {
      //   return this.MRPSells.reduce((t, trans) => t + this.getVatRate(trans), 0)
      // }
      return 0;
    },
    MRPSellsSDRateSum() {
      // if MRP sells transactions exist then get total sd rate sum
      // if (this.MRPSells.length > 0) {
      //   return this.MRPSells.reduce((t, trans) => t + this.getsdRate(trans), 0)
      // }
      return 0;
    },
    // for sells
    totalSellsTaxValue() {
      return Math.round(
        this.sellsTransactionDetails?.reduce(
          (t, trans) => Number.parseFloat(trans.taxable_value, 10) + t,
          0
        )
      );
    },
    // for sells
    totalSellsTaxRate() {
      return Math.round(
        this.sellsTransactionDetails?.reduce((t, trans) => this.getVatRate(trans) + t, 0)
      );
    },
    totalSellsSdRate() {
      return Math.round(
        this.sellsTransactionDetails?.reduce((t, trans) => this.getsdRate(trans) + t, 0)
      );
    },
  },
  watch: {
    currentEntity() {
      this.getSellsTransactions();
    },
    reportDate(newVal) {
      if (
        newVal != null &&
        Array.isArray(newVal.split("-")) &&
        newVal.split("-")[1] !== "" &&
        newVal.split("-")[0] !== ""
      ) {
        this.getSellsTransactions();
      }
    },
    reportDateRange(newVal) {
      if (Array.isArray(newVal) && newVal.length > 0) {
        this.getSellsTransactions();
      }
    },
  },
  mounted() {
    this.getSellsTransactions();
  },
  methods: {
    async getSellsTransactions() {
      try {
        // if date is not null then get transactions in specific date
        this.$store.commit("UPDATE_IS_LOADER", true);
        if (this.reportDate) {
          const {
            data: { transactionsProducts },
          } = await EntityApi.getSellsTransactionInDate(
            this.currentEntity.id,
            this.reportDate
          );
          this.sellsTransactionDetails = transactionsProducts;
        } else if (Array.isArray(this.reportDateRange)) {
          // else if date range is array then get transaction in date range
          const {
            data: { transactionsProducts },
          } = await EntityApi.getSellsTransactionInDateRange(
            this.currentEntity.id,
            this.reportDateRange[0],
            this.reportDateRange[1]
          );
          this.sellsTransactionDetails = transactionsProducts;
        }
        this.$store.commit("UPDATE_IS_LOADER", false);

        const totalSellsTaxableValue = this.sellsTransactionDetails?.reduce(
          (t, trans) => Number.parseFloat(trans.taxable_value, 10) + t,
          0
        );
        const totalSellsSdRate = this.sellsTransactionDetails?.reduce(
          (t, trans) => this.getsdRate(trans.sd_rate, 10) + t,
          0
        );

        this.$store.commit(
          "reportninepointone/SET_TOTAL_SELLS_VALUE",
          totalSellsTaxableValue
        );
        this.$store.commit(
          "reportninepointone/SET_SELLS_TRANSACTION_PRODUCTS",
          this.sellsTransactionDetails
        );
        this.$store.commit("reportninepointone/SET_TOTAL_SELLS_VAT", totalSellsSdRate);

        // zero rated sells transactions
        this.zeroRatedSells = this.sellsTransactionDetails.filter(
          (trans) => Number.parseInt(trans.tax_rate, 10) === 0
        );

        // examptedrateds sells
        this.exemptedRatedSells = this.sellsTransactionDetails.filter(
          (trans) => Number.parseInt(trans.tax_rate, 10) === -1
        );

        // standard rateds sells transactions
        this.standardRatedSells = this.sellsTransactionDetails.filter(
          (trans) => Number.parseInt(trans.tax_rate, 10) === 15
        );

        // MRP sells transactions
        // this.MRPSells = this.sellsTransactionDetails.filter(trans => Number.parseInt(trans.tax_rate, 10) === 5 && trans.is_MRP === 1)

        // Non Standard Rated Sells transations
        this.NonStandardRatedSells = this.sellsTransactionDetails.filter(
          (trans) =>
            Number.parseFloat(trans.tax_rate, 10) > 0 &&
            Number.parseFloat(trans.tax_rate, 10) < 15 &&
            trans.tax_rate != 5
        );
        this.tradingBasedRatedSells = this.sellsTransactionDetails.filter(
          (trans) => Number.parseFloat(trans.tax_rate, 10) == 5
        );
      } catch (error) {
        this.$store.commit("UPDATE_IS_LOADER", false);
        console.log(error);
      }
    },
    GoodsDetails(name, params) {
      if (Array.isArray(this.reportDateRange) && this.reportDateRange.length > 0) {
        this.$router.push({
          name,
          params,
          query: { fromDate: this.reportDateRange[0], toDate: this.reportDateRange[1] },
        });
      } else if (this.reportDate) {
        this.$router.push({ name, params, query: { date: this.reportDate } });
      } else {
        this.$swal.fire({
          title: "Please Select Date or Date range",
        });
      }
    },
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
tr,
th {
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
