<template>
  <!-- end of draft nav buttons -->
  <section>
    <div class="maincontent d-flex">
      <!-- show-folder tab  -->
      <div v-if="!showFolderTab" class="folder-table flex d-flex flex-col px-2 pt-3 bg-slate-100 cursor-pointer"
        @click="showFolderTab = true">
        <mdicon name="folder-open" class="folder-color" size="25" />
        <p class="rotate-text font-semibold text-md capitalize mt-2">Show Contacts</p>
      </div>
      <!-- end of show-folder tab  -->
      <keep-alive>
        <FolderList v-if="showFolderTab" />
      </keep-alive>
      <!-- @showFilesOfTransaction="showFilesOfTransaction" -->
      <FileList :transaction="transaction" @getSelectedDocuments="getSelectedDocuments" />

      <FileContainer />

      <!-- v-if="!showFolderTab" -->
      <div v-if="!showFolderTab" class="file-details-form bg-white">
        <div class="file-details-form-header py-3 bg-gray-200 d-flex justify-content-between align-items-center px-1">
          <button class="d-flex justify-content-center align-items-center p-1"
            style="background: transparent; border: none">
            <mdicon height="20" class="font-bold" name="chevron-left" style="color: #7467ec" />
            <span style="color: #7467ec">Prev</span>
          </button>
          <p class="submit_process_title rounded-md px-2 py-1">Submit & Proceed</p>
          <button class="justify-content-center align-items-center p-1" style="background: transparent; border: none">
            <span class="text" style="color: #7467ec">Next</span>
            <mdicon size="20" class="font-weight-bold text-dark mt-1" name="chevron-right" />
          </button>
        </div>
        <keep-alive>
          <FormContentForTransaction v-if="hasCurrentTransaction" @closeForm="showFolderTab = true" />
          <div v-else class="form-container">
            <div class="form-content">
              <!-- form content title  -->
              <div class="form-content-title d-flex justify-content-between px-3 mt-2">
                <h6 class="text-sm">Transation Details</h6>
                <p class="d-flex justify-content-center align-items-center">
                  <input type="checkbox" name="mark_as_paid" class="form-check" />
                  <span class="text-sm font-weight-bold" style="margin-left: 3px">Mark as reconciled</span>
                </p>
              </div>
              <!-- end of form content title  -->

              <div class="form-inputs px-1 py-1">
                <!-- //main inputs  -->
                <!-- transaction type  -->
                <div class="row mb-1">
                  <div class="col-4">
                    <label class="font-semibold mr-2">Transaction Type</label>
                  </div>
                  <div class="col-8">
                    <model-list-select v-model="form.transaction_type" :list="transactionTypes" option-value="id"
                      option-text="title" placeholder="select Transaction Type" class="custom-input" />
                    <p v-if="Object.keys(errors).length > 0 && errors.transaction_type"
                      class="text-danger font-weight-bold my-1" v-text="errors.transaction_type[0]" />
                  </div>
                </div>
                <!-- end of transaction type  -->
                <!-- //invoice/bill/treasury challan/ adjustments  -->
                <div class="row mb-1">
                  <div class="col-4">
                    <label for="" class="font-weight-bold mr-2">Invoice/Bill No</label>
                  </div>
                  <div class="col-8">
                    <input v-model="form.invoiceId" type="text" class="custom-input" placeholder="INV-00025" />
                    <p v-if="Object.keys(errors).length > 0 && errors.invoiceId"
                      class="text-danger font-weight-bold my-1" v-text="errors.invoiceId[0]" />
                  </div>
                </div>
                <!-- end of invoice/bill/treasury challan  -->

                <!-- transaction date  -->
                <div class="row mb-1">
                  <div class="col-4">
                    <label class="font-semibold mr-2">Transaction Date</label>
                  </div>
                  <div class="col-8">
                    <date-picker v-model="form.transaction_date" type="date"
                      style="color: #000 !important; width: 100%" />
                    <p v-if="Object.keys(errors).length > 0 && errors.transaction_date"
                      class="text-danger font-weight-bold my-1" v-text="errors.transaction_date[0]" />
                  </div>
                </div>
                <!-- end of transaction date  -->

                <!-- document type start  -->
                <div class="row">
                  <div class="col-4">
                    <label class="font-semibold mr-2">Document Type</label>
                  </div>
                  <div class="col-8">
                    <model-list-select v-model="form.document_type" :list="documentTypes" option-value="id"
                      option-text="title" placeholder="select Document Type" class="custom-input" />
                    <p v-if="Object.keys(errors).length > 0 && errors.document_type"
                      class="text-danger font-weight-bold my-1" v-text="errors.document_type[0]" />
                  </div>
                </div>
                <!-- end of document type  -->

                <!-- //contact section  -->
                <div class="row mb-1">
                  <div class="col-4">
                    <label for="" class="font-weight-bold">Contact </label>
                  </div>
                  <div class="col-8">
                    <model-list-select v-model="form.contact_id" :list="contacts" option-value="id" option-text="name"
                      placeholder="select Contact" class="custom-input" />
                    <p v-if="Object.keys(errors).length > 0 && errors.contact_id"
                      class="text-danger font-weight-bold my-1" v-text="errors.contact_id[0]" />
                  </div>
                </div>
                <article>
                  <div class="row mb-1">
                    <div class="col-4">
                      <label for="contact_name" class="font-weight-bold mr-2">Contact Name</label>
                    </div>
                    <div class="col-8">
                      <input id="contact_name" v-model="form.contact_name" type="text" class="custom-input" />
                      <p v-if="Object.keys(errors).length > 0 && errors.contact_name"
                        class="text-danger font-weight-bold my-1" v-text="errors.contact_name[0]" />
                    </div>
                  </div>
                  <!-- <div class="single-input mb-1">
                        <div class=" d-flex justify-content-between align-items-center">
                          <label
                            for=""
                            class="font-weight-bold mr-2"
                          >Contact Code</label>
                          <input
                            v-model="form.contactCode"
                            type="text"
                            class="custom-input"
                          >
                        </div>
                        <p
                          v-if="Object.keys(errors).length > 0 && errors.contactCode"
                          class="text-danger font-weight-bold my-1 "
                          v-text="errors.contactCode[0]"
                        />
                      </div> -->
                  <div class="row mb-1">
                    <div class="col-4">
                      <label for="" class="font-weight-bold mr-2">Contact Bin</label>
                    </div>
                    <div class="col-8">
                      <input v-model="form.contact_bin_number" type="text" class="custom-input" />
                      <p v-if="Object.keys(errors).length > 0 && errors.contact_bin_number"
                        class="text-danger font-weight-bold my-1" v-text="errors.contact_bin_number[0]" />
                    </div>
                  </div>
                  <div class="row mb-1">
                    <div class="col-4">
                      <label for="" class="font-weight-bold mr-2">Contact Address</label>
                    </div>
                    <div class="col-8">
                      <input v-model="form.contactAddress" type="text" class="custom-input" />
                      <p v-if="Object.keys(errors).length > 0 && errors.contactAddress"
                        class="text-danger font-weight-bold my-1" v-text="errors.contactAddress[0]" />
                    </div>
                  </div>
                </article>
                <!-- end of contact section  -->

                <!-- //end of main form  -->
                <TreasuryFormForTransaction v-if="form.transaction_type === 4" :challan-form="challanForm"
                  :errors="errors" />
                <AdjustmentForm v-else-if="form.transaction_type === 5" :adjustment-form="adjustmentForm"
                  :errors="errors" />
                <!-- //other form  -->
                <div v-else class="other_form_container">
                  <!-- transaction category section  -->
                  <div v-if="form.transaction_category === 'local'" class="row mb-1">
                    <div class="col-4">
                      <label class="font-semibold mr-2">Transaction Category</label>
                    </div>
                    <div class="col-8">
                      <select v-model="form.transaction_category" class="custom-input">
                        <option value="local">local</option>
                        <option value="international">international</option>
                      </select>
                      <p v-if="
                        Object.keys(errors).length > 0 && errors.transaction_category
                      " class="text-danger font-weight-bold mb-1" v-text="errors.transaction_category[0]" />
                    </div>
                  </div>
                  <div v-else class="row mb-1">
                    <div class="col-6">
                      <label for="" class="font-weight-bold pr-2">
                        Transaction Category
                      </label>
                      <select v-model="form.transaction_category" class="custom-input px-1">
                        <option value="local">local</option>
                        <option value="international">international</option>
                      </select>
                      <p v-if="
                        Object.keys(errors).length > 0 && errors.transaction_category
                      " class="text-danger font-weight-bold my-1" v-text="errors.transaction_category[0]" />
                    </div>
                    <div v-if="form.transaction_category === 'international'" class="col-6">
                      <label for="" class="font-weight-bold">CPC</label>

                      <input v-model="form.CPC" type="text" class="custom-input px-1" />
                      <p v-if="Object.keys(errors).length > 0 && errors.CPC" class="text-danger font-weight-bold my-1"
                        v-text="errors.CPC[0]" />
                    </div>
                  </div>
                  <!-- end of transaction category  -->

                  <!-- //cpc office_code item  -->
                  <div v-if="form.transaction_category === 'international'"
                    class="single-input-two mb-1 d-flex justify-content-between align-items-center">
                    <div class="single-one">
                      <label for="" class="font-weight-bold pr-2"> Office Code </label>
                      <input v-model="form.office_code" type="text" class="custom-input px-1" />
                      <p v-if="Object.keys(errors).length > 0 && errors.office_code"
                        class="text-danger font-weight-bold my-1" v-text="errors.office_code[0]" />
                    </div>
                    <div class="single-two">
                      <label for="" class="font-weight-bold">Item No </label>
                      <input v-model="form.item_no" type="text" class="custom-input px-2" />
                      <p v-if="Object.keys(errors).length > 0 && errors.item_no"
                        class="text-danger font-weight-bold my-1" v-text="errors.item_no[0]" />
                    </div>
                  </div>
                  <!-- end of cpc office code item  -->

                  <div class="row">
                    <div class="col-12 d-flex justify-content-center my-1">
                      <button type="button" class="btn button mx-2" :class="[
                        isMultipleProduct ? 'btn-outline-primary' : 'btn-primary',
                      ]" @click="(showProductModal = false), (isMultipleProduct = false)">
                        Single
                      </button>
                      <button type="button" class="btn button" :class="[
                        isMultipleProduct ? 'btn-primary' : 'btn-outline-primary',
                      ]" @click="(showProductModal = true), (isMultipleProduct = true)">
                        multiple
                      </button>
                    </div>
                  </div>
                  <!-- product inputs section  -->
                  <div v-if="isMultipleProduct == false" class="row mb-1">
                    <div class="col-4">
                      <label class="font-weight-bold pr-2">Product ID
                        <button id="tooltip-button-variant" class="cursor-pointer"
                          style="border: none; background: transparent">
                          <mdicon size="20" name="alert-circle-outline" class="text-dark mr-2 font-weight-bold" />
                        </button>
                        <b-tooltip class="text-center" target="tooltip-button-variant" variant="primary">
                          H.s Code <span>{{ form.productHSCode || 0 }}</span><br />
                          SD Rate <span>{{ form.sdRate || 0 }}</span><br />
                          AIT Rate <span>{{ form.ait || 0 }}</span>
                        </b-tooltip>
                      </label>
                    </div>
                    <div class="col-8">
                      <model-list-select v-model="form.productId" :list="entityProducts" option-value="id"
                        option-text="title" placeholder="Product" class="custom-input" />
                      <p v-if="Object.keys(errors).length > 0 && errors.productId"
                        class="text-danger font-weight-bold my-1" v-text="errors.productId[0]" />
                    </div>
                  </div>

                  <article v-if="isMultipleProduct == false">
                    <div class="row mb-1">
                      <div class="col-4">
                        <label class="font-weight-bold">Product Code </label>
                      </div>
                      <div class="col-8">
                        <input v-model="form.productCode" type="text" class="custom-input" />
                        <p v-if="Object.keys(errors).length > 0 && errors.productCode"
                          class="text-danger font-weight-bold my-1" v-text="errors.productCode[0]" />
                      </div>
                    </div>
                    <div class="row mb-1">
                      <div class="col-4">
                        <label for="productHSCode" class="font-weight-bold">Product H.S Code
                        </label>
                      </div>
                      <div class="col-8">
                        <input v-model="form.productHSCode" type="text" :disabled="form.productId !== 'new_product'"
                          class="custom-input" />
                        <p v-if="Object.keys(errors).length > 0 && errors.productHSCode"
                          class="text-danger font-weight-bold my-1" v-text="errors.productHSCode[0]" />
                      </div>
                    </div>

                    <div class="row mb-1">
                      <div class="col-4">
                        <label class="font-weight-bold">Product Name </label>
                      </div>
                      <div class="col-8">
                        <input v-model="form.productName" type="text" class="custom-input" />
                        <p v-if="Object.keys(errors).length > 0 && errors.productName"
                          class="text-danger font-weight-bold my-1" v-text="errors.productName[0]" />
                      </div>
                    </div>
                  </article>
                  <div v-if="isMultipleProduct == false" class="row">
                    <div class="col-4 mb-1">
                      <label for="" class="font-weight-bold pr-2"> AIT </label>
                      <input v-model="form.ait" type="text" class="custom-input" />
                      <p v-if="Object.keys(errors).length > 0 && errors.ait" class="text-danger font-weight-bold my-1"
                        v-text="errors.ait[0]" />
                    </div>
                    <div class="col-4 mb-1">
                      <label for="" class="font-weight-bold pr-1">Product unit </label>

                      <input v-model="form.product_unit" type="text" class="custom-input" />
                      <p v-if="Object.keys(errors).length > 0 && errors.product_unit"
                        class="text-danger font-weight-bold my-1" v-text="errors.product_unit[0]" />
                    </div>
                    <div class="col-4 mb-1">
                      <label for="" class="font-weight-bold">Unit Price </label>
                      <input v-model.number="form.unit_price" type="text" class="custom-input" />
                      <p v-if="Object.keys(errors).length > 0 && errors.unit_price"
                        class="text-danger font-weight-bold my-1" v-text="errors.unit_price[0]" />
                    </div>
                    <div class="col-4 mb-1">
                      <label for="" class="font-weight-bold">Qty </label>
                      <input v-model.number="form.qty" type="number" class="custom-input" />
                      <p v-if="Object.keys(errors).length > 0 && errors.qty" class="text-danger font-weight-bold my-1"
                        v-text="errors.qty[0]" />
                    </div>

                    <div class="col-4 mb-1">
                      <label for="" class="font-weight-bold pr-2"> RD </label>
                      <input v-model="form.rd" type="text" class="custom-input" />
                      <p v-if="Object.keys(errors).length > 0 && errors.rd" class="text-danger font-weight-bold my-1"
                        v-text="errors.rd[0]" />
                    </div>
                    <div class="col-4 mb-1">
                      <label for="" class="font-weight-bold pr-2">CD </label>
                      <input v-model="form.cd" type="text" class="custom-input" />
                      <p v-if="Object.keys(errors).length > 0 && errors.cd" class="text-danger font-weight-bold my-1"
                        v-text="errors.cd[0]" />
                    </div>

                    <div v-if="form.transaction_category === 'international'" class="col-4 mb-1">
                      <label for="" class="font-weight-bold pr-2">AT Rate(%) </label>
                      <input v-model="form.atRate" type="text" class="custom-input px-2" />
                      <p v-if="Object.keys(errors).length > 0 && errors.atRate"
                        class="text-danger font-weight-bold my-1" v-text="errors.atRate[0]" />
                    </div>
                    <div class="col-4 mb-1">
                      <label for="" class="font-weight-bold pr-1"> SD Rate(%) </label>
                      <input v-model.number="form.sdRate" type="text" class="custom-input"
                        style="padding: 0.5rem 10px" />
                      <p v-if="Object.keys(errors).length > 0 && errors.sdRate"
                        class="text-danger font-weight-bold my-1" v-text="errors.sdRate[0]" />
                    </div>
                    <div class="col-4 mb-1">
                      <label for="" class="font-weight-bold pr-1">Vat Rate(%) </label>
                      <model-list-select v-model="form.taxRate" :list="taxRates" option-value="id" option-text="details"
                        class="custom-input" />
                      <p v-if="Object.keys(errors).length > 0 && errors.taxRate"
                        class="text-danger font-weight-bold my-1" v-text="errors.taxRate[0]" />
                    </div>
                  </div>

                  <!-- //multi-product details box  -->
                  <div v-if="productsArray.length && isMultipleProduct" class="calculation-section py-2">
                    <div class="row">
                      <div class="col-md-4">
                        <label style="text-decoration: underline">Description</label>
                      </div>
                      <div class="col-md-2">
                        <label style="text-decoration: underline">Price</label>
                      </div>
                      <div class="col-md-2">
                        <label style="text-decoration: underline">Sd </label>
                      </div>
                      <div class="col-md-2">
                        <label style="text-decoration: underline">At </label>
                      </div>
                      <div class="col-md-2">
                        <label style="text-decoration: underline">Vat</label>
                      </div>
                    </div>
                    <div v-for="(product, index) in productsArray" :key="index" class="row">
                      <div class="col-md-4">
                        <label v-text="
                          product.productName
                            ? product.productName.substr(0, 10) + '...'
                            : ''
                        " />
                      </div>
                      <div class="col-md-2">
                        <label v-text="product.taxable_value" />
                      </div>
                      <div class="col-md-2">
                        <label v-text="product.sdRate" />
                      </div>
                      <div class="col-md-2">
                        <label v-text="product.atRate" />
                      </div>
                      <div class="col-md-2">
                        <label v-text="Number.parseFloat(product.taxValue)" />
                      </div>
                    </div>
                    <hr />
                    <div class="row">
                      <div class="col-md-4">
                        <label>Total</label>
                      </div>
                      <div class="col-md-2">
                        <label v-text="totalTaxableValue" />
                      </div>
                      <div class="col-md-2">
                        <label v-text="totalSdValue" />
                      </div>
                      <div class="col-md-2">
                        <label v-text="totalAtRateValue" />
                      </div>
                      <div class="col-md-2">
                        <label v-text="totalVateRateValue" />
                      </div>
                    </div>
                  </div>
                  <!-- end of multi-product details box  -->
                  <div class="row">
                    <div v-if="isMultipleProduct == false" class="col-6 mb-1">
                      <label class="font-weight-bold">Total Value </label>
                      <input v-model="form.taxable_value" type="number" disabled class="custom-input" />
                      <p v-if="Object.keys(errors).length > 0 && errors.taxable_value"
                        class="text-danger font-weight-bold my-1" v-text="errors.taxable_value[0]" />
                    </div>
                    <div v-if="form.transaction_type === 1 || form.transaction_type === 2" class="col-6">
                      <label for="" class="font-weight-bold">will you pay tax ? </label>
                      <input v-model="form.tax_payable" type="checkbox" class="mx-2" />
                      <p class="text-sm">(for note 24 and 29)</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 pl-2 pr-3" for="toggle_button">
                      <div class="row">
                        <button class="px-2 col-6 bank" :class="[isBanking ? 'active_channel' : 'channel']"
                          style="padding: 0.5rem 0" @click="isBanking = true">
                          Bank
                        </button>
                        <button class="px-2 col-6 rounded-1 cash"
                          :class="[isBanking == false ? 'active_channel' : 'channel']" style="padding: 0.5rem 0"
                          @click="isBanking = false">
                          Cash
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- <div class="row">
                  <div class="col-6">
                    <label
                      for=""
                      class="font-weight-bold "
                    >Employee </label>
                    <model-list-select
                      v-model="form.employee_id"
                      :list="employees"
                      option-value="id"
                      option-text="name"
                      placeholder="select Employee"
                      class="custom-input"
                    />
                    <p
                      v-if="Object.keys(errors).length > 0 && errors.employee_id"
                      class="text-danger font-weight-bold my-1 "
                      v-text="errors.employee_id [0]"
                    />
                  </div>
                </div> -->
              </div>
              <!-- end of transaction type  -->

              <div class="row mb-1">
                <div class="single-input mb-1 py-1 pl-2 d-flex align-items-center justify-start">
                  <p class="badge badge-success rounded-circle mr-2 mt-1">
                    <mdicon size="20" name="check-bold" class="text-light" />
                  </p>
                  <div class="button-content d-flex align-items-center justify-start">
                    <button class="btn-lg px-2 btn-primary mr-2" style="padding-top: 0.5rem; padding-bottom: 0.5rem"
                      @click.prevent="storeNewTransaction">
                      Submit
                    </button>
                    <button v-if="hasApprovePermission" class="btn-lg px-2 btn-info mr-1"
                      style="padding-top: 0.5rem; padding-bottom: 0.5rem"
                      @click.prevent="(form.approve = true), storeNewTransaction()">
                      Approve
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </keep-alive>
      </div>

      <!-- show-folder tab  -->
      <div v-if="showFolderTab" class="folder-table px-2 pt-3 cursor-pointer" @click="showFolderTab = false">
        <mdicon size="25" class="font-weight-bold mt-1 mb-2 folder-color" name="pencil" />
        <p class="rotate-text font-weight-bold font-semibold text-md capitalize">
          Edit Document
        </p>
      </div>
      <!-- end of show-folder tab  -->
    </div>
    <keep-alive>
      <product-modal v-if="showProductModal" buttontext="Close" :products-array="productsArray" :form="form"
        @addNewProductInForm="addNewProductInForm" @removeProduct="removeProductInForm"
        @closeModal="showProductModal = false" />
    </keep-alive>
  </section>
</template>

<script>
import { ref } from "@vue/composition-api";
import FileList from "@/components/draftInvoice/FileList.vue";
import FolderList from "@/components/draftInvoice/FolderList.vue";
import FileContainer from "@/components/draftInvoice/FileContainer.vue";
import { BTooltip } from "bootstrap-vue";
// import { format } from 'date-fns'
import { ModelListSelect } from "vue-search-select";
import { mapState, mapGetters } from "vuex";
import EntityApi from "@/api/entity/EntityApi";
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";
import FormContentForTransaction from "@/components/draftInvoice/FormContentForTransaction.vue";
import Permissions from "@/helpers/Permissions";
import ContactsListMixin from "@/mixins/ContactsListMixin";
import ProductModal from "@/components/global/ProductModal.vue";
import RateMixinForProduct from "@/mixins/RateMixinForProduct";
import EntityDocuments from "@/mixins/EntityDocuments";
import authConfig from "@/api/auth/authConfig";
import TreasuryFormForTransaction from "@/components/draftInvoice/TreasuryFormForTransaction.vue";
import AdjustmentForm from "@/components/draftInvoice/AdjustmentForm.vue";

export default {
  setup() {
    const showFolderTab = ref(true);
    return {
      showFolderTab,
    };
  },
  components: {
    FolderList,
    FileList,
    FileContainer,
    BTooltip,
    ModelListSelect,
    FormContentForTransaction,
    ProductModal,
    TreasuryFormForTransaction,
    AdjustmentForm,
  },
  mixins: [ContactsListMixin, RateMixinForProduct, EntityDocuments], // for contacts list via entity
  data() {
    return {
      selectedFileForContainer: "",
      date: new Date(),
      due_date: new Date(),
      showProductModal: false,
      addNewProduct: false,
      addNewContact: false,
      isSingleProduct: true, // for single or multiple product
      form: {
        transaction_date: new Date(),
        transaction_type: null,
        document_type: null,

        contact_id: null, // contact
        contact_name: null, // contact
        contact_bin_number: null, // contact
        contactAddress: null, // contact
        contactCode: null, // contact

        transaction_category: "local",
        office_code: null,
        item_no: null,
        CPC: null,

        employee_id: null,
        invoiceId: null,
        documents: [],
        approve: false,

        productName: null, // product
        productCode: null, // product
        productId: null, // product
        product_unit: null, // product
        unit_price: 0, // product
        productHSCode: null, // product
        dictionaryProductId: null, // product
        sdRate: 0, // product
        atRate: 0, // product
        taxRate: 0, // product
        taxable_value: 0, // product
        ait: null, // product
        rd: null, // product
        cd: null, // product
        qty: 1,
        tax_payable: false,
        transaction_channel: "banking",
      },
      productsArray: [
        {
          productName: "",
          productId: null,
          productCode: null,
          product_unit: null,
          unit_price: 0,
          productHSCode: null,
          dictionaryProductId: null,
          sdRate: 0,
          atRate: 0,
          taxRate: 0,
          taxValue: 0,
          taxable_value: 0,
          ait: null,
          rd: null,
          cd: null,
          qty: 1,
        },
      ],
      isMultipleProduct: false,
      errors: [],
      error: "",
      documentTypes: [],
      transactionTypes: [],
      // productNatures: [],
      contacts: [{ id: "new_contact", name: "Add New Contact" }],
      taxRates: [],
      sdRates: [],
      atRates: [],
      employees: [],
      banks: [],
      entityProducts: [{ id: "new_product", title: "Add New Product" }],
      transaction: { id: 0 },
      // treasury form for treasury challan
      challanForm: {
        bank: null,
        branch: null,
        district: null,
        date: null,
        deposit_account_code: null,
        deposit_amount: 0,
        deposit_type: null,
      },
      adjustmentForm: {
        title: null,
        amount: 0,
        vat_rate: null,
        adjustment_date: null,
        adjustment_type: null,
      },
      isBanking: true,
    };
  },
  computed: {
    ...mapState(["currentEntity", "AuthUserEntityRole"]),
    ...mapState("transactions", {
      currentDocument: (state) => state.currentDocument,
      documentList: (state) => state.documentList,
      selectedDocumentIds: (state) => state.selectedDocumentIds,
      currentTransaction: (state) => state.currentTransaction,
      uploadedDocuments: (state) => state.uploadedDocuments,
    }),
    ...mapGetters("transactions", {
      GET_CURRENT_TRANSACTION: "GET_CURRENT_TRANSACTION",
    }),
    hasCurrentTransaction() {
      return !!Object.keys(this.GET_CURRENT_TRANSACTION).length;
    },
    // for permissions
    hasApprovePermission() {
      return Permissions.approvePermission(this.AuthUserEntityRole.role_name);
    },
    totalTaxableValue() {
      return (
        this.productsArray.reduce(
          (t, product) => Number.parseFloat(product.taxable_value) + t,
          0
        ) || 0
      );
    },
    totalSdValue() {
      return (
        this.productsArray.reduce((t, product) => this.getsdRate(product) + t, 0) || 0
      );
    },
    totalAtRateValue() {
      return (
        this.productsArray.reduce((t, product) => this.getAtRate(product) + t, 0) || 0
      );
    },
    totalVateRateValue() {
      return (
        this.productsArray.reduce((t, product) => this.getVatRate(product) + t, 0) || 0
      );
    },
  },
  watch: {
    isBanking(newVal) {
      if (newVal) {
        this.form.transaction_channel = "banking";
      } else {
        this.form.transaction_channel = "cash";
      }
    },
    async currentEntity() {
      this.$store.commit("UPDATE_IS_LOADER", true);
      await this.entityContacts();
      await this.TaxRates();
      await this.AtRates();
      await this.entityEmployees();
      await this.entityProductsList();
      this.$store.commit("UPDATE_IS_LOADER", false);
    },
    selectedDocumentIds() {
      this.form.documents = [...this.selectedDocumentIds];
      if (this.selectedDocumentIds.length === 0) {
        this.$store.commit("transactions/UPDATE_MARKSelectedDocuments", false);
      }
    },
    "form.unit_price": function (newVal) {
      if (typeof newVal === "number" && typeof this.form.qty === "number") {
        this.form.taxable_value = newVal * this.form.qty;
      }
    },
    "form.qty": function (newVal) {
      console.log(newVal);
      if (typeof newVal === "number" && typeof this.form.unit_price === "number") {
        this.form.taxable_value = newVal * this.form.unit_price;
      }
    },

    // eslint-disable-next-line func-names
    // 'form.is_MRP': function (newVal) {
    //   if (newVal) {
    //     this.form.is_MRP = 1
    //   } else {
    //     this.form.is_MRP = 0
    //   }
    // },
    // eslint-disable-next-line func-names
    "form.contact_id": function (newVal) {
      if (newVal === "new_contact") {
        this.addNewContact = true;
      } else {
        this.addNewContact = false;
        if (newVal !== null) this.getContactViaId(newVal);
      }
    },

    // eslint-disable-next-line func-names
    "form.productId": function (newVal) {
      if (newVal === "new_product") {
        this.addNewProduct = true;
      } else {
        this.addNewProduct = false;
        if (newVal !== null) this.getProductViaId(newVal);
      }
    },
    // eslint-disable-next-line func-names
    "form.productHSCode": function (newVal) {
      if (newVal !== null) this.getProductViaHsCode();
    },
  },
  async mounted() {
    this.$store.commit("UPDATE_IS_LOADER", true);
    await this.getDocumentType();
    await this.bankList();
    await this.getTransactionTypes();
    await this.entityContacts();
    await this.TaxRates();
    await this.AtRates();
    await this.entityEmployees();
    await this.entityProductsList();
    this.$store.commit("UPDATE_IS_LOADER", false);
  },
  methods: {
    addNewProductInForm() {
      this.productsArray.push({
        productId: null,
        productName: "",
        productCode: null,
        productHSCode: null,
        product_unit: null,
        unit_price: 0,
        qty: 1,
        dictionaryProductId: null,
        sdRate: 0,
        atRate: 0,
        taxRate: 0,
        taxValue: 0,
        ait: null,
        rd: null,
        cd: null,
        taxable_value: 0,
      });
    },

    // for multiple transaction product
    removeProductInForm(index) {
      const item = this.productsArray.find((_, index1) => index1 === index);
      if (item) {
        this.productsArray.splice(index, 1);
      }
    },
    // mark selected document as marked for transactions
    getSelectedDocuments() {
      // update documents of form for transactions
      this.form.documents = [...this.selectedDocumentIds];

      /** if selecteddocuments length  greater then
      0 so that selected document should be marked as
      selected and notification should be show * */
      if (this.selectedDocumentIds.length > 0) {
        this.$store.commit("transactions/UPDATE_MARKSelectedDocuments", true);
        this.$toast({
          component: ToastificationContent,
          props: {
            title: "Document has been selected for transactions",
            icon: "EditIcon",
            variant: "success",
          },
        });
      } else {
        // else please select documents notification should be show
        this.$store.commit("transactions/UPDATE_MARKSelectedDocuments", false);
        this.$toast({
          component: ToastificationContent,
          props: {
            title: "Please Select Documents",
            icon: "XCircleIcon",
            variant: "danger",
          },
        });
      }
    },
    async getProductViaId(productId) {
      try {
        const {
          data: { entityProduct },
        } = await EntityApi.getEntitySingleProduct(this.currentEntity.id, productId);
        this.form.product_unit = entityProduct.unit;
        this.form.productHSCode = entityProduct.hs_code;
        this.form.productName = entityProduct.title;
        this.form.productCode = entityProduct.code;
        this.form.sdRate = entityProduct.sd_rate;
        this.form.taxRate = entityProduct.vat_rate;
        this.form.atRate = entityProduct.at;
        this.form.ait = entityProduct.ait;
        this.form.cd = entityProduct.cd;
        this.form.atv = entityProduct.atv;
        this.form.rd = entityProduct.rd;
      } catch (error) {
        console.log(error);
      }
    },

    async getContactViaId(contactId) {
      try {
        const {
          data: { contact },
        } = await EntityApi.getEntitySingleContact(this.currentEntity.id, contactId);
        this.form.contact_id = contact.id;
        this.form.contact_name = contact.name;
        this.form.contact_bin_number = contact.bin;
        this.form.contactAddress = contact.address;
        this.form.contactCode = contact.contact_code;
      } catch (error) {
        console.log(error.response);
      }
    },

    async getDocumentType() {
      try {
        const {
          data: { documentTypes },
        } = await EntityApi.entityDocumentTypes();
        this.documentTypes = documentTypes;
      } catch (error) {
        console.log(error);
      }
    },
    async getTransactionTypes() {
      try {
        const {
          data: { transactionTypes },
        } = await EntityApi.getTransactionTypes();
        this.transactionTypes = transactionTypes;
      } catch (error) {
        console.log(error);
      }
    },
    async entityContacts() {
      try {
        const {
          data: { contacts },
        } = await EntityApi.entityContacts(this.currentEntity.id);
        this.contacts = [{ id: "new_contact", name: "Add New Contact" }, ...contacts];
      } catch (error) {
        console.log(error);
      }
    },
    async entityProductsList() {
      try {
        const {
          data: { entityProducts },
        } = await EntityApi.entityProducts(this.currentEntity.id);
        this.entityProducts = [
          { id: "new_product", title: "Add New Product" },
          ...entityProducts,
        ]
      } catch (error) {
        console.log(error);
      }
    },
    async TaxRates() {
      try {
        const {
          data: { taxRates },
        } = await EntityApi.TaxesRates();
        this.taxRates = [...taxRates]
      } catch (error) {
        console.log(error)
      }
    },
    async SDRate() {
      try {
        const {
          data: { sdRates },
        } = await EntityApi.SdRates()
        this.sdRates = [...sdRates]
      } catch (error) {
        console.log(error)
      }
    },
    async AtRates() {
      try {
        const {
          data: { atRates },
        } = await EntityApi.ATRates();
        this.atRates = [...atRates];
      } catch (error) {
        console.log(error);
      }
    },
    async bankList() {
      try {
        const {
          data: { banks },
        } = await EntityApi.bankList();
        this.banks = banks;
      } catch (error) {
        console.log(error);
      }
    },
    async entityEmployees() {
      try {
        const {
          data: { employees },
        } = await EntityApi.entityEmployees(this.currentEntity.id);
        this.employees = employees;
      } catch (error) {
        console.log(error);
      }
    },
    // async getProductNatures() {
    //   try {
    //     const { data: { productNatures } } = await EntityApi.getProductNatures()
    //     this.productNatures = productNatures
    //   } catch (error) {
    //     console.log(error)
    //   }
    // },

    async getProductViaHsCode() {
      if (this.form.productId === "new_product" && this.form.productHSCode) {
        try {
          const {
            data: { product },
          } = await EntityApi.dictionaryProductViaHsCode(this.form.productHSCode);
          this.form.dictionaryProductId = product.id;
          this.form.product_unit = product.unit;
          this.form.productHSCode = product.hs_code;
          this.form.productName = product.title;
          this.form.sdRate = product.sd_rate;
          this.form.taxRate = product.vat_rate;
          this.form.atRate = product.at;
          this.form.ait = product.ait;
          this.form.cd = product.cd;
          this.form.rd = product.rd;
        } catch (error) {
          console.log(error);
        }
      }
    },

    async storeNewTransaction() {
      // check if documents has not been selected then show alert message
      if (this.form.documents.length === 0) {
        this.$toast({
          component: ToastificationContent,
          props: {
            title: "Please Select Document",
            icon: "XCircleIcon",
            variant: "danger",
          },
        });
        return;
      }

      this.$store.commit("UPDATE_IS_LOADER", true);
      let formData = null;
      if (this.form.transaction_type === 4) {
        formData = { ...this.form, challanForm: this.challanForm, isMultiple: false };
      } else if (this.form.transaction_type === 5) {
        formData = {
          ...this.form,
          adjustmentForm: this.adjustmentForm,
          isMultiple: false,
        };
      } else if (this.isMultipleProduct) {
        formData = { ...this.form, productsArray: this.productsArray, isMultiple: true };
      } else {
        formData = { ...this.form, isMultiple: false };
      }
      EntityApi.newTransaction(formData, this.currentEntity.id)
        .then(({ data: { success, transaction } }) => {
          this.$store.commit("UPDATE_IS_LOADER", false);
          this.$store.commit("transactions/UPDATE_SELECTED_DOCUMENTIDS", []);
          this.$store.commit("transactions/UPDATE_MARKSelectedDocuments", false);
          // new code
          this.$store.commit("transactions/POP_UPLOADED_DOCUMENTS", this.form.documents);
          this.$store.commit("transactions/UPDATE_IS_OPEN_FOLDER", true);
          this.$store.commit("transactions/UPDATE_IS_SINGLE_FOLDER_NAV", true);
          this.$store.commit(
            "transactions/UPDATE_ACTIVE_CONTACT",
            transaction?.contact?.name
          );
          this.$store.commit("transactions/SET_CURRENT_DOCUMENT", {});
          this.$store.commit("transactions/SET_CURRENT_TRANSACTION", transaction);
          this.$store.commit("transactions/UPDATE_ACTIVE_DOCUMENT_STATUS_NAV", "Review");
          // this.$store.commit('transactions/UPDATE_IS_UPLOAD_FOLDER', false)
          // end new code for showing recent store transaction

          // refetch transactions for updating docs page

          this.getFoldersViaEntity(); // defined in contactlistmixin
          // this.getEntityDraftDocuments()
          this.resetForm(); // reset form
          this.showProductModal = false; // close multi product modal
          this.showFolderTab = true;
          this.$toast({
            component: ToastificationContent,
            props: {
              title: success,
              icon: "EditIcon",
              variant: "success",
            },
          });
        })
        .catch((error) => {
          this.$store.commit("UPDATE_IS_LOADER", false);
          if (error?.response?.status === 422) {
            this.errors = error.response.data.errors;
          } else if (error?.response?.status === 500) {
            this.$toast({
              component: ToastificationContent,
              props: {
                title: error.response?.data?.error,
                icon: "XCircleIcon",
                variant: "danger",
              },
            });
          } else if (error?.response?.status === 404) {
            this.$toast({
              component: ToastificationContent,
              props: {
                title: error.response.data.message,
                icon: "XCircleIcon",
                variant: "danger",
              },
            });
          }
        });
    },
    resetForm() {
      console.log(this.form);
      this.form = {
        transaction_date: new Date(),
        transaction_type: null,
        document_type: null,

        contact_id: null, // contact
        contact_name: null, // contact
        contact_bin_number: null, // contact
        contactAddress: null, // contact
        contactCode: null, // contact

        transaction_category: "local",
        office_code: null,
        item_no: null,
        CPC: null,

        employee_id: null,
        invoiceId: null,
        documents: [],
        approve: false,
        productName: null, // product
        productCode: null, // product
        productId: null, // product
        product_unit: null, // product
        unit_price: 0, // product
        productHSCode: null, // product
        dictionaryProductId: null, // product
        sdRate: 0, // product
        atRate: 0, // product
        taxRate: 0, // product
        taxable_value: 0, // product
        ait: null, // product
        rd: null, // product
        cd: null, // product
      };
    },
    redirectGuardUser() {
      localStorage.removeItem(authConfig.storageTokenKeyName);
      this.$router.push({ name: "login" });
    },
  },
};
</script>

<style scoped>
.maincontent {
  width: 100vw;
}

.file-type-nav {
  background: #f4f7fe;
  padding: 0.4rem;
}

.btn-nav,
.active_btn_nav {
  margin-right: 8px;
  border: 1px solid #6259cf !important;
  padding: 0.3rem 0.8rem;
  border-radius: 0.3rem;
  color: #6259cf;
  background: #fff;
  font-weight: 500;
  text-transform: capitalize;
  font-size: 0.9rem;
}

.active_btn_nav {
  background: #6259cf;
  color: #fff;
  border: 1px solid #6259cf !important;
}

.btn-approve {
  background: #2f92e9;
  color: #fff;
}

.file-details-form {
  width: 24%;
  height: calc(100vh - 82px - 64px);
}

.form-container {
  width: 100%;
  height: calc(100vh - 82px - 65px - 92px);
  background: #fff;
}

.form-content {
  overflow-y: auto;
  height: 100%;
  background: #fff;
}

.folder-color {
  color: #7766ff;
}

/* file image details nav  */
.folder-modification-nav {
  background: #f3f8fb;
}

.file-image-container {
  width: 100%;
  height: 100vh;
  background: #fff;
  overflow: hidden;
  padding-top: 2rem;
  text-align: center;
}

.warning-icon {
  color: #e59118;
}

.file-details-form-header {
  background: #f3f8fb;
  color: #8b89b8;
  padding: 0.6rem 1rem !important;
}

.rotate-text {
  writing-mode: vertical-rl;
  text-orientation: mixed;
  letter-spacing: 0.1ch;
}

.folder-table {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: start;
  background: #f4f7fe;
  color: #767884;
  width: 20px;
  box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
  height: calc(100vh - 82px - 64px);
}

#sort_by {
  border: 1px solid #d1d5db;
  padding: 5px;
  border-radius: 5px;
  outline: none;
}

.custom-input {
  width: 100%;
  border: 1px solid #d1d5db;
  padding: 5px 10px !important;
  border-radius: 5px;
  outline: none;
}

label {
  font-weight: bold !important;
}

.rotate_img {
  object-fit: contain;
  width: 80%;
  height: 80%;
  box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
}

/* submit_process_title */
.submit_process_title {
  font-weight: bold;
  color: #6259cf;
  letter-spacing: 0.2px;
  /* border:1px solid red; */
  margin-top: 1rem;
}

/* //image container  */
.file-image-details-button {
  background: #f3f8fb;
  color: #6259cf;
  border: none;
}

.single-input label {
  /* border:1px solid red; */
  width: 50%;
}

.single-two {
  margin-left: 10px;
}

.bank {
  border-top-left-radius: 0.5rem;
  border-bottom-left-radius: 0.5rem;
}

.cash {
  border-top-right-radius: 0.5rem;
  border-bottom-right-radius: 0.5rem;
}

.bank,
.cash {
  border: none;
  padding: 0.5rem 0;
}

.channel {
  background: #e3e0ff;
  color: black;
}

.active_channel {
  background: #7367f0;
  color: #fff;
}
</style>
