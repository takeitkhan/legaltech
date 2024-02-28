
<template>
  <section id="dashboard-ecommerce" class="mt-5">
    <div class="d-flex justify-content-center flex-column align-items-center mt-1 mb-2">
      <h3 style="color: #8176f1; font-weight: bold" class="mt-2">
        Organization Name,address & BIN
      </h3>
      <p>Purchase,Sales Accounts Book</p>
    </div>
    <div class="row justify-content-center align-items-center">
      <div class="col-md-4 my-2">
        <button class="btn btn-primary" @click="$router.go(-1)">Back</button>
      </div>
      <div class="col-md-6">
        <date-picker
          v-model="dateRange"
          type="date"
          format="YYYY-MM-DD"
          value-type="format"
          range
          placeholder="YYYY-MM-DD to YYYY-MM-DD"
        />
        <strong class="mr-2">OR</strong>
        <date-picker
          v-model="month"
          type="month"
          value-type="format"
          format="MMMM"
          placeholder="MMMM"
        />
        <date-picker
          v-model="year"
          type="year"
          format="YYYY"
          value-type="format"
          placeholder="Year"
        />
      </div>
      <div class="col-md-2">
        <model-list-select
          v-model="productId"
          :list="entityProducts"
          option-value="id"
          option-text="title"
          placeholder="Product"
          class="custom-input"
        />
      </div>
    </div>

    <div class="row match-height table-responsive" style="width: 98%; margin-left: 10px">
      <div class="table-responsive">
        <table class="table table-bordered" style="width: 100%">
          <thead>
            <tr>
              <th rowspan="2"> Date</th>
              <th colspan="2"> Opening Balance of Saleable Stock</th>
              <th colspan="2"> Purchase </th>
              <th colspan="2"> Total Stock</th>
              <th>Seller Information</th>
              <th colspan="2">Purchase Challan/bill of entry details</th>
              <th colspan="4">Sold/Supplied goods description</th>
              <th>Purchaser Information</th>
              <th colspan="2">Sales Invoice Detail</th>
              <th colspan="2">Closing Balance of Stock</th>
            </tr>
            <tr>
              <!-- for opening balance  -->
              <th>Qty(Unit)</th>
              <th>Value</th>
              <!-- (Excluding all type of taxes) -->
              <!-- end of for opening balance  -->

              <!-- purchase  -->
              <th>Qty(Unit)</th>
              <th>Value</th>
              <!-- (Excluding all type of taxes) -->
              <!-- end purchase  -->

              <!-- total stock  -->
              <th>Qty(Unit)</th>
              <th>Value</th>
              <!-- (Excluding all type of taxes) -->
              <!-- end of total stock  -->

              <!-- seller information  -->
              <th>Name</th>
              <!-- end of seller information  -->

              <!-- purchase challan / bill of entry details  -->
              <th>Number</th>
              <th>Date</th>
              <!-- end of purchase challan / bill of entry details -->

              <!-- sold/supplied goods description  -->
              <th>Qty</th>
              <th>Taxable Value</th>
              <!-- (Excluding all type of taxes) -->
              <th>SD</th>
              <!-- Supplementary Duty(If Have) -->
              <th>VAT</th>
              <!-- end of sold/supplied goods description  -->

              <!-- purchase information  -->
              <th>Name</th>
              <!-- end of purchase information  -->

              <!-- Sales Invoice Detail  -->
              <th>Number</th>
              <th>Date</th>
              <!-- end of Sales Invoice Detail  -->
              <th>Qty (Unit)</th>
              <th>Value</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="(product, key) in transactionsProducts">
              <tr
                v-if="product.transaction.transaction_type_id === 1"
                :key="`${product.id + (new Date()).getTime() + Math.random() * 5028234201}`"
              >
                <td v-text="product.transaction.transaction_date" />
                <td v-text="closingStock[key]" />
                <td v-text="closingStock[key] !== 0 ? closingBalance[key] : 0" />
                <td v-text="product.transaction.transaction_type_id === 1 ? product.qty : ''" />
                <td v-text="product.transaction.transaction_type_id === 1 ? (product.unit_price * product.qty) : ''" />
                <td v-text="openingStock[key]" />
                <td v-text="openingBalance[key] !== 0 ? openingBalance[key] : 0" />
                <td>Seller Information</td>
                <td>Purchase Challan / Bill of Entry Details name</td>

                <td v-text="product.transaction.transaction_date" />
                <td v-text="soldPrices[product.id] ? soldPrices[product.id].qty : ''" />
                <td v-text="soldPrices[product.id] ? soldPrices[product.id].qty * soldPrices[product.id].unit_price : 'Q'" />
                <td v-text="soldPrices[product.id] ? soldPrices[product.id].sd : ''" />
                <td v-text="soldPrices[product.id] ? soldPrices[product.id].tax_rate : ''" />
                <td v-text="soldPrices[product.id] ? soldPrices[product.id].transaction.contact.name : ''" />
                <td v-text="soldPrices[product.id] ? soldPrices[product.id].transaction.invoice_no : ''" />
                <td v-text="soldPrices[product.id] ? soldPrices[product.id].transaction.transaction_date : ''" />
                <td v-text="closingStock[key + 1] ? closingStock[key + 1] : 0" />
                <td v-text="closingBalance[key + 1] ? closingBalance[key + 1] : 0" />
              </tr>
              <tr
                v-else
                :key="`${product.id + (new Date()).getTime() + Math.random() * 5028234201}`"
              >
                <td v-text="product.transaction.transaction_date" />
                <td v-text="closingStock[key]" />
                <td v-text="closingStock[key] !== 0 ? closingBalance[key] : 0" />
                <td v-text="''" />
                <td v-text="''" />
                <td v-text="openingStock[key]" />
                <td v-text="openingBalance[key] !== 0 ? openingBalance[key] : 0" />
                <td>Seller Information</td>
                <td>Purchase Challan / Bill of Entry Details name</td>

                <td v-text="product.transaction.transaction_date" />
                <td v-text="product.qty" />
                <td v-text="product.unit_price * product.qty" />
                <td v-text="product.sd" />
                <td v-text="product.tax_rate" />
                <td v-text="product.transaction.contact.name" />
                <td v-text="product.transaction.invoice_no" />
                <td v-text="product.transaction.transaction_date" />
                <td v-text="closingStock[key+1]" />
                <td v-text="closingStock[key+1]" />
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</template>

<script>
/* eslint-disable prefer-const */
/* eslint-disable no-unused-expressions */
/* eslint-disable vue/max-attributes-per-line */
import { ref } from '@vue/composition-api'
import EntityApi from '@/api/entity/EntityApi'
import { format } from 'date-fns'
// import getQuarterMonth from "@/composition/helpers/getQuarterMonth";
// import getFinancialYear from "@/composition/helpers/getFinancialYear";
import { mapState } from 'vuex'
import { ModelListSelect } from 'vue-search-select'

export default {
  components: {
    ModelListSelect,
    // childRowForSixPointTwoPointOne
  },
  data() {
    return {
      transactionsProducts: [],
      month: format(new Date(), 'MMM'),
      year: format(new Date(), 'yyyy'),
      dateRange: [],
      purchaseTransactionsProducts: [],
      sellsTransactionsProducts: [],
      entityProducts: [],
      productId: null,
    }
  },
  computed: {
    ...mapState(['currentEntity', 'reportDate', 'reportDateRange']),
    date() {
      return `${this.year}-${this.month}`
    },
  },
  watch: {
    currentEntity() {
      this.getTransactions()
      this.entityProductsList()
    },

    date(newVal) {
      if (newVal !== null && Array.isArray(newVal.split('-')) && newVal.split('-')[1] !== '' && newVal.split('-')[0] !== '') {
        this.dateRange = []
        this.$store.commit('UPDATE_REPORT_DATE', this.date)
        this.$store.commit('UPDATE_REPORT_DATE_RANGE', [])
        this.getTransactions()
      }
    },
    dateRange(newVal) {
      // if date range is array then set month and year null and call getSellsTransactions Function
      if (Array.isArray(newVal) && newVal.length > 0) {
        this.month = null
        this.year = null
        this.$store.commit('UPDATE_REPORT_DATE', null)
        this.$store.commit('UPDATE_REPORT_DATE_RANGE', this.dateRange)
        this.getTransactions()
      }
    },
    productId(){
      this.getTransactions()
    }
  },
  mounted() {
    const date = this.reportDate
    if (Array.isArray(date?.split('-')) && date.split('-')[1] !== '' && date.split('-')[0] !== '') {
      const [year, month] = date.split('-')
      this.month = month
      this.year = format(new Date(year), 'yyyy')
    } else if (this.month && this.year) {
      const dateRange = `${this.year}-${this.month}`
      this.$store.commit('UPDATE_REPORT_DATE', dateRange)
    }
    this.getTransactions()
    this.entityProductsList()
  },
  methods: {

    async getTransactions() {
      try {
        // if date is not null then get transactions in specific date

        // if (!this.productId) {
        //   this.$swal.fire({
        //     title: 'Please Select Product',
        //   })
        //   return 
        // }
        this.$store.commit('UPDATE_IS_LOADER', true)
        if (this.reportDate) {
          const {
            data: { transactionsProducts },
          } = await EntityApi.getTransactionProductsViaProductIdInDate(this.currentEntity.id,this.productId, this.reportDate)

          this.transactionsProducts = transactionsProducts
          this.sellsTransactionsProducts = this.transactionsProducts.filter(trans => trans?.transaction?.transaction_type_id === 2)
          this.purchaseTransactionsProducts = this.transactionsProducts.filter(trans => trans?.transaction?.transaction_type_id === 1)
        } else if (Array.isArray(this.reportDateRange)) {
          // else if date range is array then get transaction in date range
          const {
            data: { transactionsProducts },
          } = await EntityApi.getTransactionProductsViaProductIdInDateRange(
            this.currentEntity.id, this.productId, this.reportDateRange[0], this.reportDateRange[1])

          this.transactionsProducts = transactionsProducts
          this.sellsTransactionsProducts = this.transactionsProducts.filter(trans => trans?.transaction?.transaction_type_id === 2)
          this.purchaseTransactionsProducts = this.transactionsProducts.filter(trans => trans?.transaction?.transaction_type_id === 1)
        }
        this.tempSellsProducts = this.sellsTransactionsProducts

        this.calculationProducts()
        this.$store.commit('UPDATE_IS_LOADER', false)
      } catch (error) {
        this.$store.commit('UPDATE_IS_LOADER', false)
        console.log(error)
      }
    },
    async entityProductsList() {
      try {
        const {
          data: { entityProducts },
        } = await EntityApi.entityProducts(this.currentEntity.id);
        this.entityProducts = [
          { id: 'new_product', title: 'Add New Product' },
          ...entityProducts,
        ]
      } catch (error) {
        console.log(error)
      }
    },

    calculationProducts() {
      // if you  have opening balance then store it in opening balance
      this.closingStock = []
      this.closingBalance = []
      this.closingStock.push(0)
      this.closingBalance.push(0)
      this.openingStock = []
      this.openingBalance = []
      this.purchaseTransactionsProducts?.forEach(product => {
        const transactionDate = product?.transaction?.transaction_date
        // check product has been sold or not in same date
        const soldItemIndex = this.tempSellsProducts?.findIndex(pro => pro?.transaction?.transaction_date === transactionDate)

        if (soldItemIndex > -1) {
          const soldItem = this.tempSellsProducts[soldItemIndex]
          this.soldPrices[product.id] = soldItem
          // after storing products in soldPrices array then remove it from tempSellsProducts
          this.tempSellsProducts.splice(soldItemIndex, 1)
        }
      })
      // remove sells products which has same date with purchase product
      let removeSellsProducts = []
      this.transactionsProducts = this.transactionsProducts.map(pro => {
        if (this.soldPrices[pro.id]) {
          removeSellsProducts.push(this.soldPrices[pro.id].id)
        }
        return pro
      })

      if (removeSellsProducts.length) {
        removeSellsProducts.forEach(productId => {
          let findIndex = this.transactionsProducts.findIndex(product => product.id === productId)
          if (findIndex > -1) {
            this.transactionsProducts.splice(findIndex, 1)
          }
        })
      }

      // transaction products
      this.transactionsProducts.forEach((product, key) => {
        // if product is purchase then
        if (product?.transaction?.transaction_type_id === 1) {
          if (this.soldPrices[product.id]) {
            this.closingStock[key + 1] = (this.closingStock[key] + product.qty) - this.soldPrices[product.id].qty // for next row
            this.closingBalance[key + 1] = (this.closingBalance[key] + (product.entity_product.unit_price * product.qty)) - (this.soldPrices[product.id].qty * this.soldPrices[product.id].entity_product.unit_price) // for next row
          } else {
            this.closingStock[key + 1] = this.closingStock[key] + product.qty // for next row
            this.closingBalance[key + 1] = this.closingBalance[key] + (product.entity_product.unit_price * product.qty) // for next ro
          }
          this.openingStock[key] = this.closingStock[key] + product.qty // current row
          this.openingBalance[key] = this.closingBalance[key] + (product.qty * product.entity_product.unit_price)
        } else {
          // if product is sells then
          this.openingStock[key] = this.closingStock[key] // current row
          this.openingBalance[key] = this.closingBalance[key]
          this.closingStock[key + 1] = this.closingStock[key] - product.qty
          this.closingBalance[key + 1] = this.closingBalance[key] - (product.qty * product.entity_product.unit_price)
        }
      })
    },
  },
  setup() {
    let openingStock = [] // stock
    let openingBalance = [] //
    let soldPrices = ref([]) // sold prices as a queue
    let closingStock = [] // closing stock is my opening stock in next line
    let closingBalance = [] // closing balance is my opening balance in next line
    let tempSellsProducts = ref([])

    return {
      openingStock,
      openingBalance,
      closingStock,
      closingBalance,
      soldPrices,
      tempSellsProducts,
    }
  },
}
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

tfoot tr,
tfoot tr td {
  height: 20px !important;
  padding: 10px 10px !important;
  background: #fff;
}

tr,
td,
th {
  text-transform: capitalize !important;
}
</style>
