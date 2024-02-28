<template>
  <section id="dashboard-ecommerce">
    <div class="container">
      <button class="btn btn-primary ml-2" @click="$router.go(-1)">Back</button>
      <div class="row match-height">
        <div class="col-12">
          <div class="d-flex justify-content-between align-items-center">
            <div class="mb-2 mx-2">
              <h2 class="my-2 font-weight-bold" v-text="productTitle" />
              <p v-text="productCode" />
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="bg-white mx-1 py-1">
            <h4 class="text-center">Quantity on hand</h4>
            <h5 class="text-center" v-text="ProductQty" />
          </div>
        </div>
        <div class="col-md-3">
          <div class="bg-white mx-1 py-1">
            <h4 class="text-center">Average cost</h4>
            <h5 class="text-center" v-text="productUnitPrice" />
          </div>
        </div>
        <div class="col-md-3">
          <div class="bg-white mx-1 py-1">
            <h4 class="text-center">Total Value</h4>
            <h5 class="text-center" v-text="ProductQty * productUnitPrice"></h5>
          </div>
        </div>
      </div>
      <div class="row mt-3 mb-3">
        <div class="col-md-12">
          <h5 class="font-weight-bold">
            Transaction
            <mdicon size="20" name="alert-circle" class="text-dark mr-2 font-weight-bold" />
          </h5>
        </div>
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table">
              <thead class="bg-white">
                <tr>
                  <th width="10%">Date</th>
                  <th width="15%">Type</th>
                  <th width="15%">Product Name</th>
                  <th width="10%">Contact</th>
                  <th width="10%">Quantity</th>
                  <th width="10%">Price</th>
                  <th width="10%">Amount</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="transactionProduct in transactionProducts" 
                :key="transactionProduct.id">
                  <td style="text-align: center" v-text="formatDate(transactionProduct)"></td>
                  <td style="text-align: center">
                    {{ transactionProduct.transaction.document_type }}
                  </td>
                  <td style="text-align: center">
                    {{ transactionProduct.product_name }}
                  </td>
                  <td style="text-align: center">
                    {{ transactionProduct.transaction.contact_name }}
                  </td>
                  <td style="text-align: center" v-text="
                    transactionProduct.transaction.document_type == 'Bill'
                      ? `(+)${transactionProduct.qty}`
                      : `(-)${transactionProduct.qty}`
                  ">
                    {{ transactionProduct.qty }}
                  </td>
                  <td style="text-align: center" v-text="transactionProduct.unit_price" />
                  <td style="text-align: center" v-text="transactionProduct.qty * transactionProduct.unit_price" />
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
// import {
//   BDropdown, BDropdownItem,
// } from 'bootstrap-vue'

// import AdminUserApi from '@/api/admin/user'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue';
import EntityApi from '@/api/entity/EntityApi'
import { mapState } from 'vuex'
import { format } from 'date-fns'

export default {
  props: ['product_id'],
  data() {
    return {
      transactionProducts: [],
      productDetails: [],
    }
  },
  computed: {
    ...mapState(['currentEntity', 'AuthUserEntityRole']),
    formatDate() {
      return transactionProduct => {
        if (transactionProduct?.transaction) {
          return format(
            new Date(transactionProduct.transaction.transaction_date),
            'yyyy-MM-dd',
          )
        }
        return null
      }
    },
    productTitle() {
      return this.productDetails?.title ?? null
    },
    productCode() {
      return this.productDetails?.code ?? null
    },
    ProductQty() {
      return this.productDetails?.qty ?? null
    },
    productUnitPrice() {
      return this.productDetails?.unit_price ?? null
    },
  },
  watch: {
    currentEntity() {
      this.getTransactionProductsViaEntityProductId()
      this.getEntityProductViaId()
    },
  },
  mounted() {
    this.getTransactionProductsViaEntityProductId()
    this.getEntityProductViaId()
  },
  methods: {
    async getAllEntityProducts() {
      try {
        const {
          data: { entityProducts },
        } = await EntityApi.entityProducts(this.currentEntity.id)
        this.entityProducts = entityProducts
      } catch (error) {
        console.log(error)
      }
    },
    async registerProduct() {
      try {
        const {
          data: { message },
        } = await EntityApi.registerProduct(this.currentEntity.id, this.form)
        this.$toast({
          component: ToastificationContent,
          props: {
            title: message,
            icon: 'EditIcon',
            variant: 'success',
          },
        })
        this.showInventoryProductModal = false
        this.getAllEntityProducts()
      } catch (error) {
        console.log(error)
        if (error?.response?.status === 422) {
          this.errors = error.response.data.errors
        }
      }
    },
    async getTransactionProductsViaEntityProductId() {
      try {
        const {
          data: { transactionProducts },
        } = await EntityApi.transactionProducts(this.currentEntity.id, this.product_id)
        this.transactionProducts = transactionProducts
      } catch (error) {
        console.log(error)
      }
    },
    async getEntityProductViaId() {
      try {
        const {
          data: { entityProduct },
        } = await EntityApi.getEntitySingleProduct(
          this.currentEntity.id,
          this.product_id,
        )
        this.productDetails = entityProduct
      } catch (error) {
        console.log(error)
        if (error?.response?.status === 404) {
          this.$toast({
            component: ToastificationContent,
            props: {
              title: error?.response?.data?.message,
              icon: 'XCircleIcon',
              variant: 'error',
            },
          })
        }
        this.$router.go(-1)
      }
    },
  },
}
</script>

<style>
.user-timeline-list {
  border-left: 1px solid;
}

.user-timeline-list .single-timeline .badge {
  width: 20px;
  height: 20px !important;
  border-radius: 50% !important;
}

.inventory-search {
  margin: 0.5rem 0;
  border: 1px solid #dcdae4;
  padding: 2px 5px;
  border-radius: 10px;
}

.search-icon {
  padding-right: 10px;
}

.search-input {
  border: none;
  min-width: 250px;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
  padding: 1rem 1rem 1rem 0;
  outline: none;
  height: 17px;
  font-style: normal;
  font-weight: 400;
  font-size: 14px;
  line-height: 17px;
  /* identical to box height */
  color: rgba(85, 91, 106, 0.7);
}
</style>
