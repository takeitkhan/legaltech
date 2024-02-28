<template>
  <!-- Button trigger modal -->
  <div
    id="large"
    ref="productModal"
    class="text-left modal-product"
    @mousedown="mouseDown"
  >
    <div class="modal-content">
      <div class="modal-header">
        <h4
          id="myModalLabel17"
          class="modal-title text-primary"
        >
          <!-- Large Modal -->
          Edit Products
        </h4>
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
        <table>
          <thead>
            <tr>
              <th width="18%">
                Product Name
              </th>
              <th width="8%">
                Code
              </th>
              <th width="8%">
                HsCode
              </th>
              <th width="5%">
                Unit
              </th>
              <th width="10%">
                Unit Price
              </th>
              <th width="4%">
                Qty
              </th>
              <th width="4%">
                SD
              </th>
              <th
                v-if="form.transaction_category === 'international'"
                width="4%"
              >
                AT
              </th>
              <th width="5%">
                VAT
              </th>
              <th width="4%">
                AIT
              </th>
              <th width="5%">
                RD
              </th>
              <th width="5%">
                CD
              </th>
              <th width="11%">
                Amount
              </th>
              <th width="2%" />
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(product,index) in productsArray"
              :key="index"
              class="product_input_row"
            >
              <td>
                <input
                  v-if="product.productId === 'new_product'"
                  v-model="product.productName"
                  type="text"
                  class="custom-input"
                  :disabled="isApproved"
                  placeholder="productName"
                >
                <!-- v-model="product.productId" -->
                <model-list-select
                  v-model="product.productId"
                  :list="entityProducts"
                  option-value="id"
                  option-text="title"
                  placeholder="Product"
                  :disabled="isApproved"
                  @input="(productId)=>productSelect(productId,index)"
                />
                <!-- <p
                  v-if="Object.keys(errors).length > 0 && errors.productId"
                  class="text-danger font-weight-bold my-1 "
                  v-text="errors.productId[0]"
                /> -->
              </td>

              <td>
                <input
                  v-model="product.productCode"
                  type="text"
                  class="custom-input"
                  placeholder="Code"
                  :disabled="isApproved"
                >
              </td>
              <td>
                <input
                  v-model="product.productHSCode"
                  type="text"
                  class="custom-input"
                  :disabled="isApproved"
                  placeholder="HS Code"
                  @focus="getProductViaHsCode($event,index)"
                  @change="getProductViaHsCode($event,index)"
                >
              </td>
              <td>
                <input
                  v-model="product.product_unit"
                  type="text"
                  class="custom-input"
                  placeholder="Unit"
                  :disabled="isApproved"
                >
              </td>
              <td>
                <input
                  v-model="product.unit_price"
                  type="number"
                  class="custom-input"
                  placeholder="Price"
                  :disabled="isApproved"
                >
              </td>
              <td>
                <input
                  v-model="product.qty"
                  type="number"
                  class="custom-input"
                  placeholder="Qty"
                  :disabled="isApproved"
                >
              </td>
              <td>
                <input
                  v-model="product.sdRate"
                  type="number"
                  class="custom-input"
                  placeholder="%"
                  :disabled="isApproved"
                >
              </td>
              <td v-if="form.transaction_category === 'international'">
                <input
                  v-model="product.atRate"
                  type="number"
                  class="custom-input"
                  placeholder="%"
                  :disabled="isApproved"
                >
              </td>
              <td>
                <model-list-select
                  v-model="product.taxRate"
                  :list="taxRates"
                  :disabled="isApproved"
                  option-value="id"
                  option-text="details"
                />
              </td>
              <td>
                <input
                  v-model="product.ait"
                  :disabled="isApproved"
                  type="number"
                  class="custom-input"
                  placeholder="%"
                >
              </td>
              <td>
                <input
                  v-model="product.rd"
                  type="number"
                  :disabled="isApproved"
                  class="custom-input"
                  placeholder="%"
                >
              </td>
              <td>
                <input
                  v-model="product.cd"
                  type="number"
                  :disabled="isApproved"
                  class="custom-input"
                  placeholder="%"
                >
              </td>
              <td>
                <input
                  v-model="product.taxable_value"
                  type="number"
                  :disabled="isApproved"
                  class="custom-input"
                  placeholder="Taxable Value"
                >
              </td>
              <td v-if="index !== 0 && !isApproved">
                <button
                  class="btn btn-sm btn-danger"
                  @click.stop="removeProduct(index)"
                >
                  X
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <div
          v-if="!isApproved"
          class="text-right mt-4"
        >
          <button
            class="btn btn-outline-primary"
            @click.stop="newProductItem"
          >
            Add a new Line
          </button>
        </div>
      </div>
      <div class="modal-footer">
        <button
          type="button"
          class="btn btn-danger waves-effect waves-float waves-light"
          @click.stop="$emit('closeModal')"
        >
          {{ buttontext }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import EntityApi from '@/api/entity/EntityApi'
import { mapState } from 'vuex'
import { ModelListSelect } from 'vue-search-select'

export default {
  emits: ['addNewProductInForm', 'removeProduct'],
  components: {
    ModelListSelect,
  },
  props: ['buttontext', 'productsArray', 'form', 'isApproved'],
  data() {
    return {
      prevX: 0,
      prevY: 0,
      newX: 0,
      newY: 0,
      productModal: null,
      taxRates: [],
      errors: {},
      entityProducts: [{ id: 'new_product', title: 'Add New Product' }],
    }
  },
  computed: {
    ...mapState(['currentEntity']),
  },
  watch: {
    async currentEntity() {
      this.$store.commit('UPDATE_IS_LOADER', true)
      // await this.TaxRates()
      // await this.AtRates()
      // await this.entityEmployees()
      await this.entityProductsList()
      await this.TaxRates()
      this.$store.commit('UPDATE_IS_LOADER', false)
    },
  },
  mounted() {
    this.productModal = this.$refs.productModal
    this.entityProductsList()
    this.TaxRates()
  },

  methods: {
    productSelect(productId, index) {
      // this.productsArray[index]
      const entityProduct = this.entityProducts.find(product => product.id === productId)
      if (entityProduct && entityProduct.id !== 'new_product') {
        this.productsArray[index].productName = entityProduct.title
        this.productsArray[index].productCode = entityProduct.code
        this.productsArray[index].product_unit = entityProduct.unit
        this.productsArray[index].productHSCode = entityProduct.hs_code
        this.productsArray[index].sdRate = entityProduct.sdRate
        this.productsArray[index].atRate = entityProduct.at
        this.productsArray[index].taxRate = entityProduct.vat_rate
        this.productsArray[index].taxable_value = entityProduct.taxable_value
        this.productsArray[index].qty = 1
        this.productsArray[index].ait = entityProduct.ait
        this.productsArray[index].rd = entityProduct.rd
        this.productsArray[index].cd = entityProduct.cd
      }
    },
    newProductItem() {
      // custom event for adding new line for product
      this.$emit('addNewProductInForm')
    },
    async entityProductsList() {
      try {
        const { data: { entityProducts } } = await EntityApi.entityProducts(this.currentEntity.id)
        this.entityProducts = [{ id: 'new_product', title: 'Add New Product' }, ...entityProducts]
      } catch (error) {
        console.log(error)
      }
    },
    async getProductViaHsCode(event, index) {
      if (this.productsArray[index].productId === 'new_product' && this.productsArray[index].productHSCode) {
        try {
          const { data: { product } } = await EntityApi.dictionaryProductViaHsCode(this.productsArray[index].productHSCode)
          this.productsArray[index].dictionaryProductId = product.id
          this.productsArray[index].product_unit = product.unit
          this.productsArray[index].productName = product.title
          this.productsArray[index].sdRate = product.sd_rate
          this.productsArray[index].atRate = product.at
          this.productsArray[index].ait = product.ait
          this.productsArray[index].cd = product.cd
          this.productsArray[index].rd = product.rd
          // qty,id,code,unit_price
        } catch (error) {
          console.log(error)
        }
      }
    },
    mouseDown(e) {
      window.addEventListener('mousemove', this.mousemove)
      window.addEventListener('mouseup', this.mouseup)
      this.prevX = e.clientX
      this.prevY = e.clientY
    },
    mousemove(e) {
      this.newX = this.prevX - e.clientX
      this.newY = this.prevY - e.clientY
      const rect = this.productModal.getBoundingClientRect()
      this.productModal.style.left = `${rect.left - this.newX}px`
      this.productModal.style.top = `${rect.top - this.newY}px`
      this.prevX = e.clientX
      this.prevY = e.clientY
    },
    mouseup() {
      window.removeEventListener('mousemove', this.mousemove)
      window.removeEventListener('mouseup', this.mouseup)
    },
    removeProduct(index) {
      this.$emit('removeProduct', index)
    },
    async TaxRates() {
      try {
        const { data: { taxRates } } = await EntityApi.TaxesRates()
        this.taxRates = [...taxRates]
      } catch (error) {
        console.log(error)
      }
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
    width:1100px;
    max-width:100%;
     min-height:200px;
    /* height:250px; */
    z-index:1050 !important;
    top:60%;
    left:10%;
    box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
    background:#ffff;
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
