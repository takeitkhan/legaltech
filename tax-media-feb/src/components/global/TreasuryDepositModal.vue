<template>
  <!-- Button trigger modal -->
  <div
    id="large"
    ref="adjustmentModal"
    class="text-left modal-product"
  >
    <div class="modal-content">
      <div class="modal-header">
        <h4
          id="myModalLabel17"
          class="modal-title text-primary"
          v-text="title"
        />
        <button
          type="button"
          class="close"
          aria-label="Close"
          @click="$emit('closeModal')"
        >
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row ">
          <div class="form-group col-12">
            <input
              v-model="form.treasury_challan_number"
              type="text"
              placeholder="Treasury Challan Number"
              class="form-control"
            >
            <p
              v-if="Object.keys(errors).length > 0 && errors.treasury_challan_number"
              class="text-danger font-weight-bold my-1 "
              v-text="errors.treasury_challan_number[0]"
            />
          </div>

          <div class="form-group col-6">
            <input
              v-model="form.bank"
              type="text"
              placeholder="Bank Name"
              class="form-control"
            >
            <p
              v-if="Object.keys(errors).length > 0 && errors.bank"
              class="text-danger font-weight-bold my-1 "
              v-text="errors.bank[0]"
            />
          </div>
          <div class="form-group col-6">
            <input
              v-model="form.branch"
              type="text"
              placeholder="Branch"
              class="form-control"
            >
            <p
              v-if="Object.keys(errors).length > 0 && errors.branch"
              class="text-danger font-weight-bold my-1 "
              v-text="errors.branch[0]"
            />
          </div>
          <div class="form-group col-6">
            <input
              v-model="form.date"
              type="date"
              placeholder="Deposit Date"
              class="form-control"
            >
            <p
              v-if="Object.keys(errors).length > 0 && errors.date"
              class="text-danger font-weight-bold my-1 "
              v-text="errors.date[0]"
            />
          </div>
          <div class="form-group col-6">
            <select
              v-model="form.deposit_type"
              class="form-control"
              disabled
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
            <p
              v-if="Object.keys(errors).length > 0 && errors.deposit_type"
              class="text-danger font-weight-bold my-1 "
              v-text="errors.deposit_type[0]"
            />
          </div>
          <div class="form-group col-12">
            <input
              v-model="form.deposit_account_code"
              type="text"
              placeholder="Deposit Account Code"
              class="form-control"
            >
            <p
              v-if="Object.keys(errors).length > 0 && errors.deposit_account_code"
              class="text-danger font-weight-bold my-1 "
              v-text="errors.deposit_account_code[0]"
            />
          </div>
          <div class="form-group col-12">
            <input
              v-model="form.deposit_amount"
              type="number"
              placeholder="Deposit Amount"
              class="form-control"
            >
            <p
              v-if="Object.keys(errors).length > 0 && errors.deposit_amount"
              class="text-danger font-weight-bold my-1 "
              v-text="errors.deposit_amount[0]"
            />
          </div>

          <div class="form-group">
            <button
              class="btn btn-primary"
              @click.prevent="storeTreasuryDeposit"
            >
              {{ buttonText }}
            </button>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button
          type="button"
          class="btn btn-danger waves-effect waves-float waves-light"
          @click.stop="$emit('closeModal')"
        >
          {{ closeButton }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import EntityApi from '@/api/entity/EntityApi'
import { mapState } from 'vuex'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
  emits: [],
  components: {

  },
  props: ['closeButton', 'form', 'title', 'deposit_type', 'buttonText'],
  data() {
    return {
      errors: {},
    }
  },
  computed: {
    ...mapState(['currentEntity']),
  },
  watch: {
    // async currentEntity() {
    //   this.$store.commit('UPDATE_IS_LOADER', true)

    //   this.$store.commit('UPDATE_IS_LOADER', false)
    // },
  },
  methods: {
    async storeTreasuryDeposit() {
      try {
        this.$store.commit('UPDATE_IS_LOADER', true)
        const { data } = await EntityApi.storeTreasuryDeposit(this.currentEntity.id, this.form)
        console.log(data)
      } catch (error) {
        this.$store.commit('UPDATE_IS_LOADER', false)
        if (error?.response?.status === 500) {
          this.$toast({
            component: ToastificationContent,
            props: {
              title: error.response?.data?.message,
              icon: 'XCircleIcon',
              variant: 'danger',
            },
          })
        }
        if (error?.response?.status === 422) {
          this.errors = error.response.data.errors
        }
      }
      this.$store.commit('UPDATE_IS_LOADER', false)
    },

  },
}
</script>

<style scoped>
#large{
    display: block;
}

.modal-product{
    position:fixed;
    width:500px;
    min-height:200px;
    height:250px;
    max-width:100%;
    z-index:1050 !important;
    top:20%;
    left:30%;
    box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
    background:green;
}
.modal-body{
  height:auto !important;
  overflow:auto !important;;
}
.modal-content{
width:100%;
border:none;
    /* background:#fff; */
}
.modal-header{
  width:100%;
  min-width:100%;
  background:#fff;
}
.modal-footer{
    width:100%;
  min-width:100%;
  background:#fff;
}
 .modal-body{
  max-height:500px !important;

  /* width:1000px; */
  width:100%;
  min-width:100%;
  background:#fff;
  overflow:auto !important;
}
.modal-size-lg{
  overflow:auto !important;
}

table{
    margin-bottom:1rem;
}

table,tr,td,th{
    padding:6px 2px;
    margin:0;
    box-sizing:border-box;
}

th{
  font-size:12px !important;
}

tr{
  margin:1rem 0px !important;
}
table tbody tr.product_input_row{
  margin-bottom:10px !important;
}

td{
    /* border:1px solid #DADADA; */
}
.custom-input{
  width:100% !important;
  /* padding:9px 14px !important; */
  padding:9px 5px !important;
  border-radius: 5px;
  border:1px solid #B2B3B3;
  font-size:12px !important;
  /* color:#B2B3B */
  outline:none;
}
</style>
