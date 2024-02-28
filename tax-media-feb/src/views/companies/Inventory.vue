<template>

  <section id="dashboard-ecommerce">

    <div class="row match-height">
      <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
          <div class="mb-2">
            <h2 class="my-2 font-weight-bold">
              Inventory
            </h2>
            <div class="row">
              <div class="col-md-12">
                <div class="inventory-search d-flex justify-content-start align-items-center bg-white">
                  <mdicon
                    size="20"
                    class="font-weight-bold search-icon"
                    name="magnify"
                  />
                  <input
                    type="text"
                    class="search-input"
                    placeholder="Search by product name or code"
                  >
                </div>
              </div>
            </div>
          </div>
          <button
            class="btn btn-primary"
            @click="showInventoryProductModal=true"
          >
            <mdicon
              size="16"
              class="font-weight-bold text-white"
              name="plus-circle"
            />
            Add Product
          </button>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card">

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table ">
                <thead class="bg-white">
                  <tr>
                    <th width="5%">
                      <b-form-checkbox
                        value="A"
                        class="custom-control-primary"
                      >
                        <!-- Primary -->
                      </b-form-checkbox>
                    </th>
                    <th
                      width="10%"
                    >
                      Product Code
                    </th>
                    <th width="15%">
                      Product Name
                    </th>
                    <th width="10%">
                      Avg cost
                    </th>
                    <th width="10%">
                      Quantity
                    </th>
                    <th width="10%">
                      Total Value
                    </th>
                    <th
                      width="10%"
                      align="center"
                    >
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>

                  <tr
                    v-for="entity_product in entityProducts"
                    :key="entity_product.id"
                  >
                    <td>
                      <b-form-checkbox
                        :value="entity_product.id"
                        class="custom-control-primary"
                      />
                    </td>
                    <td
                      style="text-align:center;"
                    >{{ entity_product.code }}
                    </td>
                    <td
                      style="text-align:center;"
                    >{{ entity_product.title }}
                    </td>
                    <td
                      style="text-align:center;"
                    >{{ entity_product.unit_price }}
                    </td>
                    <td
                      style="text-align:center;"
                    >{{ entity_product.qty }}
                    </td>
                    <td
                      style="text-align:center;"
                      v-text="entity_product.qty * entity_product.unit_price"
                    />
                    <td
                      style="text-align:center;padding-left:0px"
                    >
                      <div class="d-flex align-items-center justify-content-start">
                        <b-dropdown variant="white">
                          <template #button-content>
                            <button class="text-secondary btn">
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="14"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-more-vertical font-medium-3 cursor-pointer"
                                data-toggle="dropdown"
                              ><circle
                                cx="12"
                                cy="12"
                                r="1"
                              /><circle
                                cx="12"
                                cy="5"
                                r="1"
                              /><circle
                                cx="12"
                                cy="19"
                                r="1"
                              /></svg>
                            </button>
                          </template>
                          <b-dropdown-item :to="{name:'InventoryProductDetails',params:{product_id:entity_product.id}}">
                            Details
                          </b-dropdown-item>
                          <b-dropdown-item href="#">
                            Edit
                          </b-dropdown-item>
                          <b-dropdown-item href="#">
                            Settings
                          </b-dropdown-item>
                        </b-dropdown>
                      </div>
                    </td>

                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>

    <keep-alive>
      <inventory-product-modal
        v-if="showInventoryProductModal"
        buttontext="Close"
        :form="form"
        :errors="errors"
        @registerProduct="registerProduct"
        @closeModal="showInventoryProductModal=false"
      />
    </keep-alive>
  </section>

</template>

<script>
import {
  BDropdown, BDropdownItem, BFormCheckbox,
} from 'bootstrap-vue'

// import AdminUserApi from '@/api/admin/user'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
import EntityApi from '@/api/entity/EntityApi'
import InventoryProductModal from '@/components/inventory/InventoryProductModal.vue'
import { mapState } from 'vuex'

export default {
  components: {
    BFormCheckbox,
    BDropdownItem,
    BDropdown,
    InventoryProductModal,
  },
  data() {
    return {
      entityProducts: [{
        id: 1,
        code: 1234,
        product_name: 'pran juice',
        qty: 23.50,
        unit_price: 550,

      }],
      showInventoryProductModal: false,
      form: {
        productName: '',
        productId: null,
        details: null,
        productCode: null,
        product_unit: null,
        unit_price: 0,
        productHSCode: null,
        dictionaryProductId: null,
        sdRate: null,
        atRate: null,
        vatRate: null,
        taxValue: null,
        ait: null,
        rd: null,
        cd: null,
        qty: 1,
        is_tracking: false,
      },
      errors: {},
    }
  },
  computed: {
    ...mapState(['currentEntity', 'AuthUserEntityRole']),
  },
  watch: {
    currentEntity() {
      this.getAllEntityProducts()
    },
  },
  mounted() {
    this.getAllEntityProducts()
  },
  methods: {
    async getAllEntityProducts() {
      try {
        const { data: { entityProducts } } = await EntityApi.entityProducts(this.currentEntity.id)
        this.entityProducts = entityProducts
      } catch (error) {
        console.log(error)
      }
    },
    async registerProduct() {
      try {
        const { data: { message } } = await EntityApi.registerProduct(this.currentEntity.id, this.form)
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
  },

}
</script>

<style>
.user-timeline-list{
    border-left:1px solid
}
.user-timeline-list .single-timeline .badge{
  width:20px;
  height:20px !important;
  border-radius:50% !important;

}
.inventory-search{
 margin:0.5rem 0;
 border:1px solid #DCDAE4;
 padding:2px 5px;
 border-radius:10px;
}
.search-icon{
  padding-right:10px;
}
.search-input{
 border:none;
 min-width:250px;
 border-top-right-radius:5px;
 border-bottom-right-radius:5px;
 padding:1rem 1rem 1rem 0;
 outline:none;
 height: 17px;
 font-style: normal;
 font-weight: 400;
 font-size: 14px;
 line-height: 17px;
 /* identical to box height */
 color: rgba(85, 91, 106, 0.7);

}
</style>
