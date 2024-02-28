<template>
  <div class="modal-size-lg d-inline-block">
    <!-- Button trigger modal -->
    <div
      id="large"
      class="modal text-left"
      tabindex="-1"
      aria-labelledby="myModalLabel17"
      aria-modal="true"
      role="dialog"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title text-white">Inventory Item</h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              @click="$emit('closeModal')"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row mb-1">
              <div class="col-4">
                <label class="font-weight-bold pr-2">Product ID</label>
              </div>
              <div class="col-8">
                <model-list-select
                  v-model="form.productId"
                  :list="entityUntrackingProducts"
                  option-value="id"
                  option-text="title"
                  placeholder="Product"
                  class="custom-input"
                />
                <p
                  v-if="Object.keys(errors).length > 0 && errors.productId"
                  class="text-danger font-weight-bold my-1"
                  v-text="errors.productId[0]"
                />
              </div>
            </div>

            <div v-if="form.productId == 'new_product'" class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Product Code</label>
                  <input v-model="form.productCode" type="text" class="form-control" />
                </div>
              </div>
              <!-- //end of col  -->
              <div class="col-md-4">
                <div class="form-group">
                  <label>Product Name</label>
                  <input v-model="form.productName" type="text" class="form-control" />
                </div>
              </div>
              <!-- //end of col  -->

              <div class="col-md-4">
                <div class="form-group">
                  <label>Product description</label>
                  <textarea v-model="form.details" type="text" class="form-control" />
                </div>
              </div>
              <!-- //end of col  -->
              <div class="col-md-4">
                <div class="form-group">
                  <label>Product HS Code</label>
                  <input v-model="form.productHSCode" type="text" class="form-control" />
                </div>
              </div>
              <!-- //end of col  -->
              <div class="col-md-4">
                <div class="form-group">
                  <label>Unit</label>
                  <input v-model="form.product_unit" type="text" class="form-control" />
                </div>
              </div>
              <!-- //end of col  -->
              <div class="col-md-4">
                <label>QTY</label>
                <input v-model="form.qty" type="number" class="form-control" />
              </div>
            </div>
            <div v-if="form.productId == 'new_product'" class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Unit Price</label>
                  <input v-model="form.unit_price" type="number" class="form-control" />
                </div>
              </div>

              <!-- //end of col  -->
              <div class="col-md-3">
                <label>Taxable Value</label>
                <input v-model="form.taxable_value" type="number" class="form-control" />
              </div>
              <!-- //end of col  -->
              <div class="col-md-3">
                <div class="form-group">
                  <label>Sd Rate</label>
                  <input v-model="form.sdRate" type="number" class="form-control" />
                  <p
                    v-if="Object.keys(errors).length > 0 && errors.sdRate"
                    class="text-danger font-weight-bold my-1"
                    v-text="errors.sdRate[0]"
                  />
                </div>
              </div>
              <!-- //end of col  -->
              <div class="col-md-3">
                <div class="form-group">
                  <label>Vat Rate</label>
                  <input v-model="form.vatRate" type="number" class="form-control" />
                </div>
                <p
                  v-if="Object.keys(errors).length > 0 && errors.vatRate"
                  class="text-danger font-weight-bold my-1"
                  v-text="errors.vatRate[0]"
                />
              </div>
              <!-- //end of col  -->
            </div>

            <div v-if="form.productId == 'new_product'" class="row">
              <div class="col-md-3">
                <label>AIT</label>
                <input v-model="form.ait" type="number" class="form-control" />
                <p
                  v-if="Object.keys(errors).length > 0 && errors.ait"
                  class="text-danger font-weight-bold my-1"
                  v-text="errors.ait[0]"
                />
              </div>
              <div class="col-md-3">
                <label>RD</label>
                <input v-model="form.rd" type="number" class="form-control" />
                <p
                  v-if="Object.keys(errors).length > 0 && errors.rd"
                  class="text-danger font-weight-bold my-1"
                  v-text="errors.rd[0]"
                />
              </div>
              <div class="col-md-3">
                <label>CD</label>
                <input v-model="form.cd" type="number" class="form-control" />
                <p
                  v-if="Object.keys(errors).length > 0 && errors.cd"
                  class="text-danger font-weight-bold my-1"
                  v-text="errors.cd[0]"
                />
              </div>
            </div>

            <div class="form-group mt-2">
              <label class="d-flex font-weight-bold">
                <b-form-checkbox
                  v-model="form.is_tracking"
                  value="tracking"
                  class="custom-control-primary"
                >
                  <!-- Primary -->
                </b-form-checkbox>
                Track inventory item
              </label>
              <p
                v-if="Object.keys(errors).length > 0 && errors.cd"
                class="text-danger font-weight-bold my-1"
                v-text="errors.cd[0]"
              />
              <p class="font-weight-bold">
                Track the quantity and value of stock on hand. This option is suitable for
                organisations with less then 4000 products of services, who purchase items
                before they are sold and who calculate the average cost of items.
              </p>
            </div>
            <div class="form-group warning_note">
              <mdicon size="16" name="alert-circle" class="text-warning" /> Items can't be
              untracked once they apear in a transaction.This includes the opening
              balance,an adjustment or a bill or an invoice
            </div>

            <div class="form-group">
              <button class="btn btn-lg btn-primary" @click="$emit('registerProduct')">
                Add Product
              </button>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-danger waves-effect waves-float waves-light"
              data-dismiss="modal"
              @click="$emit('closeModal')"
            >
              {{ buttontext }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { BFormCheckbox } from "bootstrap-vue";
import { ModelListSelect } from "vue-search-select";
import EntityApi from "@/api/entity/EntityApi";
import { mapState } from "vuex";
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";

export default {
  components: {
    BFormCheckbox,
    ModelListSelect,
  },
  props: ["buttontext", "form", "errors"],
  data() {
    return {
      entityUntrackingProducts: [],
    };
  },
  computed: {
    ...mapState(["currentEntity", "AuthUserEntityRole"]),
  },
  watch: {
    currentEntity() {
      this.entityUntrackingProductsList();
    },
    "form.productHSCode": function (newVal) {
      if (newVal !== null) this.getProductViaHsCode(newVal);
    },
  },
  mounted() {
    this.entityUntrackingProductsList();
  },
  methods: {
    async getProductViaHsCode() {
      if (this.form.productHSCode?.length > 4) {
        try {
          const {
            data: { product },
          } = await EntityApi.dictionaryProductViaHsCode(this.form.productHSCode);
          this.form.dictionaryProductId = product?.id;
          this.form.product_unit = product?.unit;
          this.form.productHSCode = product?.hs_code;
          this.form.productName = product?.title;
          this.form.details = product?.title;
          this.form.sdRate = product?.sd_rate;
          this.form.vatRate = product?.vat_rate;
          this.form.atRate = product?.at;
          this.form.ait = product?.ait;
          this.form.cd = product?.cd;
          this.form.rd = product?.rd;
        } catch (error) {
          console.log(error);
          if (error?.response?.status === 404) {
            this.$toast({
              component: ToastificationContent,
              props: {
                title: error.response.data.error,
                icon: "EditIcon",
                variant: "danger",
              },
            });
          }
        }
      }
    },
    async entityUntrackingProductsList() {
      try {
        const {
          data: { entityUntrackingProducts },
        } = await EntityApi.entityUntrackingProducts(this.currentEntity.id);
        this.entityUntrackingProducts = [
          { id: "new_product", title: "Add New Product" },
          ...entityUntrackingProducts,
        ];
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>

<style scoped>
#large {
  background: rgba(0, 0, 0, 0.4) !important;
  display: block;
  padding-right: 17px;
}

label {
  font-weight: bold;
}

.modal-body {
  height: auto !important;
  overflow: auto !important;
  background: #f9f8ff;
}

.modal .modal-header {
  background: #8176f1 !important;
  color: #fff !important;
}

.modal .modal-body {
  max-height: 600px !important;
  overflow: auto !important;
}

.modal-size-lg {
  overflow: auto !important;
}

.warning_note {
  background: #f2f3f4;
  padding: 1rem;
  border-radius: 5px;
  font-weight: bold;
}

p {
  font-size: 0.9rem;
  font-weight: bold;
  padding: 1rem 1rem 1rem 0;
}
</style>
