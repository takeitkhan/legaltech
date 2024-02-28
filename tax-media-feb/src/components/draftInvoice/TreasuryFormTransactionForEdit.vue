<template>
  <div class="row ">
    <!-- <div class="form-group col-12">
          <input
            v-model="challanForm.treasury_challan_number"
            type="text"
            placeholder="Treasury Challan Number"
            class="form-control"
          >
          <p
            v-if="Object.keys(errors).length > 0 && errors.treasury_challan_number"
            class="text-danger font-weight-bold my-1 "
            v-text="errors.treasury_challan_number[0]"
          />
        </div> -->

    <div class="form-group col-6">
      <label
        class="font-semibold mr-2"
      >Bank</label>
      <input
        v-model="challanForm.bank"
        type="text"
        placeholder="Bank Name"
        class="form-control"
      >
    
    </div>
    <div class="form-group col-6">
      <label
        class="font-semibold mr-2"
      >Bank Branch</label>
      <input
        v-model="challanForm.branch"
        type="text"
        placeholder="Branch"
        class="form-control"
      >
    </div>
    <div class="form-group col-6">
      <label
        class="font-semibold mr-2"
      >District</label>
      <input
        v-model="challanForm.district"
        type="text"
        placeholder="District"
        class="form-control"
      >
    </div>
    <div class="form-group col-6">
      <label
        class="font-semibold mr-2"
      >Bank statement Date</label>
      <input
        v-model="challanForm.date"
        type="date"
        placeholder="Reporting Date"
        class="form-control"
      >
    </div>

    <div class="form-group col-12">
      <label
        class="font-semibold mr-2"
      >Deposit Account Code</label>
      <input
        v-model="challanForm.deposit_account_code"
        type="text"
        placeholder="Deposit Account Code"
        class="form-control"
      >
    </div>
    <div class="form-group col-6">
      <label
        class="font-semibold mr-2"
      >Deposit Amount</label>
      <input
        v-model="challanForm.deposit_amount"
        type="number"
        placeholder="Deposit Amount"
        class="form-control"
      >
    </div>

    <div class="form-group col-6">
      <label
        class="font-semibold mr-2"
      >Deposit Type</label>
      <select
        v-model="challanForm.deposit_type"
        class="form-control"
      >
        <option value="VAT">
          VAT
        </option>
        <option value="SD">
          SD
        </option>
        <option value="excise duty">
          Excise Duty
        </option>
        <option value="development surcharge">
          Development Surcharge
        </option>
        <option value="ICT development surcharge">
          ICT Development Surcharge
        </option>
        <option value="health care surcharge">
          Health Care Surcharge
        </option>
        <option value="environmental protection surcharge">
          Environmental Protection Surcharge
        </option>
      </select>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapState } from 'vuex'
import EntityApi from '@/api/entity/EntityApi'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
import ContactsListMixin from '@/mixins/ContactsListMixin'
import EntityDocuments from '@/mixins/EntityDocuments'
import RateMixinForProduct from '@/mixins/RateMixinForProduct'
import FormatNumberMixin from '@/mixins/FormatNumberMixin'

export default {
  mixins: [ContactsListMixin, EntityDocuments, RateMixinForProduct, FormatNumberMixin],
  props: ['challanForm'],
  data() {
    return {
      // productNatures: [],
      banks: [],
    }
  },
  computed: {
    ...mapGetters('transactions', {
      GET_CURRENT_TRANSACTION: 'GET_CURRENT_TRANSACTION',
    }),
    ...mapState('transactions', {
      currentTransaction: state => state.currentTransaction,
    }),
    ...mapState(['currentEntity', 'AuthUserEntityRole', 'authUser']),
    // for permissions

  },
  watch: {
    currentEntity() {
      this.TaxRates()
    },
    // async currentTransaction(newVal, oldValue) {

    // },
  },
  async mounted() {
    this.$store.commit('UPDATE_IS_LOADER', true)
    await this.TaxRates()
    this.$store.commit('UPDATE_IS_LOADER', false)
  },
  methods: {

    async TaxRates() {
      try {
        const { data: { taxRates } } = await EntityApi.TaxesRates()
        this.taxRates = [...taxRates]
      } catch (error) {
        console.log(error)
      }
    },

    // async bankList() {
    //   try {
    //     const { data: { banks } } = await EntityApi.bankList()
    //     this.banks = banks
    //   } catch (error) {
    //     console.log(error)
    //   }
    // }

  },
}
</script>

<style scoped>
.form-container{
  width:100%;
  height:calc(100vh - 82px - 65px - 92px);
  background:#fff;
  overflow-y:auto;
}

label{
  font-weight:bold !important;
}
/* .btn{
    border:1px solid #85C7FF !important;
    padding:0.2rem 0.5rem;
    border-radius: 0.2rem;
    color:#2f92e9;
    font-weight:600;

} */

.custom-input{
  width:100%;
  border:1px solid #D1D5DB;
  padding:5px 10px !important;
  border-radius: 5px;
  outline:none;
}

/* file image details nav  */
#month{
  width:100%;
  padding-top:6px;
  padding-bottom:6px;
  border:0.6px solid rgb(214, 212, 212,0.4);
  border-radius: 5px;
}

.single-input label{
  /* border:1px solid red; */
  width:50%;
}
.single-two{
  margin-left:10px;
}

/* ait: 5
at_rate: 0
at_rate_value: 0
cd: 5
entity_product_id: 4
product_name: "Other horses"
qty: 1
rd: 0
sd_rate: 0
sd_rate_value: 0
tax_rate: 2
tax_rate_id: 2
tax_rate_value: 9.12
taxable_value: 456
transaction_id: 5
unit: "NMB"
unit_price: 456 */
</style>
