<template>
  <article>
    <div class="row ">
      <div class="col-4">
        <label
          class="font-semibold mr-2"
        >Adjustment Title</label>
      </div>
      <div class="form-group col-8">
        <input
          v-model="adjustmentForm.title"
          type="text"
          placeholder="Adjustment Title"
          class="form-control"
        >
      </div>
    </div>
    <div class="row">
      <div class="form-group col-6">
        <label
          class="font-semibold mr-2"
        >Adjustment Amount</label>
        <input
          v-model="adjustmentForm.amount"
          type="number"
          placeholder="Amount"
          class="form-control"
        >
      </div>
      <div class="form-group col-6 mb-1">
        <label
          for=""
          class="font-weight-bold pr-1"
        >Adjustment Vat Rate(%)
        </label>
        <model-list-select
          v-model="adjustmentForm.vat_rate"
          :list="taxRates"
          option-value="id"
          option-text="details"
          class="custom-input"
        />
      </div>
      <div class="form-group col-6">
        <label
          for=""
          class="font-weight-bold pr-1"
        >Adjustment Date
        </label>
        <input
          v-model="adjustmentForm.adjustment_date"
          type="date"
          placeholder="Adjustment Date"
          class="form-control"
        >
      </div>
      <div class="form-group col-6">
        <label
          for=""
          class="font-weight-bold pr-1"
        >Adjustment Type
        </label>
        <select
          v-model="adjustmentForm.adjustment_type"
          class="form-control"
        >
          <option value="increasing">
            Increasing
          </option>
          <option value="decreasing">
            decreasing
          </option>
        </select>
      </div>
    </div>
  </article>
</template>

<script>
import { mapGetters, mapState } from 'vuex'
import EntityApi from '@/api/entity/EntityApi'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
import ContactsListMixin from '@/mixins/ContactsListMixin'
import EntityDocuments from '@/mixins/EntityDocuments'
import RateMixinForProduct from '@/mixins/RateMixinForProduct'
import FormatNumberMixin from '@/mixins/FormatNumberMixin'
import { ModelListSelect } from 'vue-search-select'

export default {
  components: {
    ModelListSelect,
  },
  mixins: [ContactsListMixin, EntityDocuments, RateMixinForProduct, FormatNumberMixin],
  props: ['adjustmentForm'],
  data() {
    return {
      error: '',
      taxRates: [],
    }
  },
  computed: {
    ...mapGetters('transactions', {
      GET_CURRENT_TRANSACTION: 'GET_CURRENT_TRANSACTION',
    }),
    ...mapState(['currentEntity', 'AuthUserEntityRole', 'authUser']),
  },
  watch: {
    currentEntity() {
      this.TaxRates()
    },
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

    // // async getProductNatures() {
    //   try {
    //     // const { data: { productNatures } } = await EntityApi.getProductNatures()
    //     this.productNatures = productNatures
    //   } catch (error) {
    //     console.log(error)
    //   }
    // },
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
</style>
