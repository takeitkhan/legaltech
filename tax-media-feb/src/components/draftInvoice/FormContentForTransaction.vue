<template>
  <div>
    <!-- form content title  -->
    <div class="form-container">

      <div class="form-content">
        <!-- form content title  -->
        <div class="form-content-title d-flex justify-content-between px-3 mt-2">
          <h6 class="text-sm">
            Transation Details
          </h6>
          <p class="d-flex justify-content-center align-items-center">
            <input
              type="checkbox"
              name="mark_as_paid"
              class="form-check"
            >
            <span
              class="text-sm font-weight-bold"
              style="margin-left:3px;"
            >Mark as reconciled</span>
          </p>
        </div>
        <div class="form-inputs px-3 pb-1">

          <!-- //start transaction type  -->
          <div class="row mb-1">
            <div class="col-4">
              <label
                class="font-semibold mr-2"
              >Transaction Type</label>
            </div>
            <div class="col-8">
              <model-list-select
                v-model="form.transaction_type"
                :list="transactionTypes"
                option-value="id"
                option-text="title"
                :disabled="isApproved"
                placeholder="select Transaction Type"
                class="custom-input px-1"
              />
              <p
                v-if="Object.keys(errors).length > 0 && errors.transaction_type"
                class="text-danger font-weight-bold my-1 "
                v-text="errors.transaction_type[0]"
              />
            </div>
          </div>
          <!-- end of transaction type  -->

          <!-- //invoice  -->
          <div class="row mb-1">
            <div class="col-4">
              <label
                for=""
                class="font-weight-bold mr-2"
              >Invoice/Bill No</label>
            </div>
            <div class="col-8">
              <input
                v-model="form.invoiceId"
                :disabled="isApproved"
                type="text"
                class="custom-input px-2"
              >
              <p
                v-if="Object.keys(errors).length > 0 && errors.invoiceId"
                class="text-danger font-weight-bold my-1 "
                v-text="errors.invoiceId[0]"
              />
            </div>
          </div>
          <!-- end of invoice id  -->

          <!-- //transaction Date  -->
          <div class="row mb-1">
            <div class="col-4">
              <label
                class="font-semibold mr-2"
              >Transaction Date</label>
            </div>
            <div class="col-8">
              <date-picker
                ref="transaction_date"
                v-model="form.transaction_date"
                type="date"
                :disabled="isApproved"
                style="color:#000 !important;width:100%;"
              />
              <p
                v-if="Object.keys(errors).length > 0 && errors.transaction_date"
                class="text-danger font-weight-bold my-1 "
                v-text="errors.transaction_date[0]"
              />
            </div>
          </div>
          <!-- end of transaction date  -->

          <!-- document type  -->
          <div class="single-input form-group">
            <div class=" d-flex justify-content-between align-items-center">
              <label
                class="font-semibold mr-2"
              >Document Type</label>
              <model-list-select
                v-model="form.document_type"
                :list="documentTypes"
                :disabled="isApproved===true"
                option-value="id"
                option-text="title"
                placeholder="select Document Type"
                class="custom-input px-1"
              />
            </div>
            <p
              v-if="Object.keys(errors).length > 0 && errors.document_type"
              class="text-danger font-weight-bold my-1 "
              v-text="errors.document_type[0]"
            />
          </div>
          <!-- end of document type  -->
          <!-- //contact section  -->
          <div class="row my-1">
            <div class="col-4">
              <label
                for=""
                class="font-weight-bold"
              >Contact </label>
            </div>
            <div class="col-8">
              <model-list-select
                v-model="form.contact_id"
                :list="contacts"
                :disabled="isApproved"
                option-value="id"
                option-text="name"
                placeholder="select Contact"
                class="custom-input px-1 pb-1"
                @change="getContactViaId"
              />
              <p
                v-if="Object.keys(errors).length > 0 && errors.contact_id"
                class="text-danger font-weight-bold my-1 "
                v-text="errors.contact_id[0]"
              />
            </div>
          </div>
          <article>
            <div class="single-input my-1">
              <div class="d-flex justify-content-between align-items-center">
                <label
                  for=""
                  class="font-weight-bold mr-2"
                >Contact Name</label>
                <input
                  v-model="form.contact_name"
                  :disabled="isApproved "
                  type="text"
                  class="custom-input px-2"
                >
              </div>
              <p
                v-if="Object.keys(errors).length > 0 && errors.contact_name"
                class="text-danger font-weight-bold my-1 "
                v-text="errors.contact_name[0]"
              />
            </div>
            <div class="single-input mb-1">
              <div class=" d-flex justify-content-between align-items-center">
                <label
                  for=""
                  class="font-weight-bold mr-2"
                >Contact Code</label>
                <input
                  v-model="form.contactCode"
                  :disabled="isApproved"
                  type="text"
                  class="custom-input px-2"
                >
              </div>
              <p
                v-if="Object.keys(errors).length > 0 && errors.contactCode"
                class="text-danger font-weight-bold my-1"
                v-text="errors.contactCode[0]"
              />
            </div>
            <div class="single-input mb-1">
              <div class=" d-flex justify-content-between align-items-center">
                <label
                  for=""
                  class="font-weight-bold mr-2"
                >Contact Bin(*)</label>
                <input
                  v-model="form.contact_bin_number"
                  :disabled="isApproved"
                  type="text"
                  class="custom-input px-2"
                >
              </div>
              <p
                v-if="Object.keys(errors).length > 0 && errors.contact_bin_number"
                class="text-danger font-weight-bold my-1 "
                v-text="errors.contact_bin_number[0]"
              />
            </div>
            <div class="single-input mb-1">
              <div class=" d-flex justify-content-between align-items-center">
                <label
                  for=""
                  class="font-weight-bold mr-2"
                >Contact Address</label>
                <input
                  v-model="form.contactAddress"
                  :disabled="isApproved"
                  type="text"
                  class="custom-input px-2 "
                >
              </div>
              <p
                v-if="Object.keys(errors).length > 0 && errors.contactAddress"
                class="text-danger font-weight-bold my-1 "
                v-text="errors.contactAddress[0]"
              />
            </div>
          </article>
          <!-- //end of contact section  -->
          <!-- end of main form  -->
          <TreasuryFormTransactionForEdit
            v-if="form.transaction_type === 4"
            :challan-form="challanForm"
          />
          <AdjustmentFormForEdit
            v-else-if="form.transaction_type === 5"
            :adjustment-form="adjustmentForm"
          />
          <div
            v-else
            class="other_form_container"
          >
            <div
              v-if="form.transaction_category === 'local'"
              class="row mb-1"
            >
              <div class="col-4">
                <label
                  class="font-semibold mr-2"
                >Transaction Category</label>
              </div>
              <div class="col-8">
                <select
                  v-model="form.transaction_category"
                  class="custom-input"
                  :disabled="isApproved"
                >
                  <option value="local">
                    local
                  </option>
                  <option value="international">
                    international
                  </option>
                </select>
                <p
                  v-if="Object.keys(errors).length > 0 && errors.transaction_category"
                  class="text-danger font-weight-bold my-1 "
                  v-text="errors.transaction_category[0]"
                />
              </div>
            </div>

            <div
              v-else
              class="row mb-1"
            >
              <div class="col-6">
                <label
                  for=""
                  class="font-weight-bold pr-2"
                > Transaction Category
                </label>
                <select
                  v-model="form.transaction_category"
                  class="custom-input px-1"
                  :disabled="isApproved"
                >
                  <option value="local">
                    local
                  </option>
                  <option value="international">
                    international
                  </option>
                </select>
                <p
                  v-if="Object.keys(errors).length > 0 && errors.transaction_category"
                  class="text-danger font-weight-bold my-1 "
                  v-text="errors.transaction_category[0]"
                />
              </div>
              <div
                v-if="form.transaction_category === 'international'"
                class="col-6"
                :disabled="isApproved"
              >
                <label
                  for=""
                  class="font-weight-bold "
                >CPC</label>
                <input
                  v-model="form.CPC"
                  type="text"
                  :disabled="isApproved"
                  class="custom-input px-1"
                >
                <p
                  v-if="Object.keys(errors).length > 0 && errors.CPC"
                  class="text-danger font-weight-bold my-1 "
                  v-text="errors.CPC[0]"
                />
              </div>
            </div>

            <div
              v-if="form.transaction_category === 'international'"
              class="single-input-two mb-3 d-flex justify-content-between align-items-center"
            >
              <div class="single-one">
                <label
                  for=""
                  class="font-weight-bold pr-2"
                > Office Code
                </label>
                <input
                  v-model="form.office_code"
                  type="text"
                  :disabled="isApproved"
                  class="custom-input px-1"
                >
                <p
                  v-if="Object.keys(errors).length > 0 && errors.office_code"
                  class="text-danger font-weight-bold my-1 "
                  v-text="errors.office_code[0]"
                />
              </div>
              <div class="single-two">
                <label
                  for=""
                  class="font-weight-bold "
                >Item No </label>
                <input
                  v-model="form.item_no"
                  type="text"
                  :disabled="isApproved"
                  class="custom-input px-2"
                >
                <p
                  v-if="Object.keys(errors).length > 0 && errors.item_no"
                  class="text-danger font-weight-bold my-1 "
                  v-text="errors.item_no[0]"
                />
              </div>
            </div>

            <div class="row">
              <div class="col-12 d-flex justify-content-center  my-1">
                <button
                  type="button"
                  class="btn button mx-2"
                  :disabled="isApproved"
                  :class="[isMultipleProduct?'btn-outline-primary':'btn-primary']"
                  @click="showProductModal=false,isMultipleProduct=false"
                >
                  Single
                </button>
                <button
                  type="button"
                  class="btn  button"
                  :disabled="isApproved"
                  :class="[isMultipleProduct?'btn-primary':'btn-outline-primary']"
                  @click="showProductModal=true,isMultipleProduct=true"
                >
                  multiple
                </button>
              </div>
            </div>
            <div
              v-if="isMultipleProduct == false"
              class="row mb-1"
            >
              <div class="col-4">
                <label
                  for=""
                  class="font-weight-bold pr-2"
                >Product ID
                  <button
                    id="tooltip-button-variant"
                    class="cursor-pointer"
                    style="border:none;background:transparent;"
                  >
                    <mdicon
                      size="20"
                      name="alert-circle-outline"
                      class="text-dark mr-2 font-weight-bold"
                    />
                  </button>
                  <b-tooltip
                    class="text-center"
                    target="tooltip-button-variant"
                    variant="primary"
                  >
                    H.s Code <span>{{ form.productHSCode || 0 }}</span><br>
                    SD Rate <span>{{ form.sdRate || 0 }}</span><br>
                    AIT  Rate <span>{{ form.ait || 0 }}</span>
                  </b-tooltip>

                </label>
              </div>
              <div class="col-8">
                <model-list-select
                  v-model="form.productId"
                  :list="entityProducts"
                  option-value="id"
                  :disabled="isApproved"
                  option-text="title"
                  placeholder="Product"
                  class="custom-input px-1"
                  @input="getProductViaId"
                />
                <p
                  v-if="Object.keys(errors).length > 0 && errors.productId"
                  class="text-danger font-weight-bold my-1"
                  v-text="errors.productId[0]"
                />
              </div>
            </div>
            <article v-if="isMultipleProduct==false">
              <div class="row mb-1">
                <div class="col-4">
                  <label
                    class="font-weight-bold"
                  >Product Code</label>
                </div>
                <div class="col-8">
                  <input
                    v-model="form.productCode"
                    type="text"
                    :disabled="isApproved"
                    class="custom-input px-1"
                  >
                  <p
                    v-if="Object.keys(errors).length > 0 && errors.productCode"
                    class="text-danger font-weight-bold my-1 "
                    v-text="errors.productCode[0]"
                  />
                </div>
              </div>
              <div class="row mb-1">
                <div class="col-4">
                  <label
                    for=""
                    class="font-weight-bold "
                  >Product H.S Code </label>
                </div>
                <div class="col-8">
                  <input
                    v-model="form.productHSCode"
                    type="text"
                    :disabled="isApproved"
                    class="custom-input px-1"
                  >
                  <p
                    v-if="Object.keys(errors).length > 0 && errors.productHSCode"
                    class="text-danger font-weight-bold my-1 "
                    v-text="errors.productHSCode[0]"
                  />
                </div>
              </div>

              <div class="row my-1">
                <div class="col-4">
                  <label
                    class="font-weight-bold"
                  >Product Name </label>
                </div>
                <div class="col-8">
                  <input
                    v-model="form.productName"
                    type="text"
                    :disabled="isApproved"
                    class="custom-input px-1"
                  >
                  <p
                    v-if="Object.keys(errors).length > 0 && errors.productName"
                    class="text-danger font-weight-bold my-1 "
                    v-text="errors.productName[0]"
                  />
                </div>
              </div>
            </article>
            <div
              v-if="isMultipleProduct==false"
              class="row"
            >
              <div class="col-4 mb-1">
                <label
                  for=""
                  class="font-weight-bold pr-2"
                >AIT
                </label>

                <input
                  v-model="form.ait"
                  type="text"
                  :disabled="isApproved"
                  class="custom-input"
                >
                <p
                  v-if="Object.keys(errors).length > 0 && errors.ait"
                  class="text-danger font-weight-bold my-1 "
                  v-text="errors.ait[0]"
                />
              </div>
              <div class="col-4">
                <label
                  for=""
                  class="font-weight-bold pr-2"
                >Product Unit</label>
                <input
                  v-model="form.product_unit"
                  type="text"
                  :disabled="isApproved"
                  class="custom-input"
                >
                <p
                  v-if="Object.keys(errors).length > 0 && errors.product_unit"
                  class="text-danger font-weight-bold my-1 "
                  v-text="errors.product_unit[0]"
                />
              </div>
              <div class="col-4">
                <label
                  for=""
                  class="font-weight-bold pr-2"
                >Unit price
                </label>

                <input
                  v-model.number="form.unit_price"
                  type="number"
                  :disabled="isApproved"
                  class="custom-input"
                >
                <p
                  v-if="Object.keys(errors).length > 0 && errors.unit_price"
                  class="text-danger font-weight-bold my-1"
                  v-text="errors.unit_price[0]"
                />
              </div>
              <div class="col-4 mb-1">
                <label
                  for=""
                  class="font-weight-bold "
                >Qty </label>
                <input
                  v-model.number="form.qty"
                  type="number"
                  :disabled="isApproved"
                  class="custom-input"
                >
                <p
                  v-if="Object.keys(errors).length > 0 && errors.qty"
                  class="text-danger font-weight-bold my-1 "
                  v-text="errors.qty[0]"
                />
              </div>
              <div class="col-4 mb-1">
                <label
                  for=""
                  class="font-weight-bold pr-2"
                > RD
                </label>
                <input
                  v-model.number="form.rd"
                  type="number"
                  :disabled="isApproved"
                  class="custom-input"
                >
                <p
                  v-if="Object.keys(errors).length > 0 && errors.rd"
                  class="text-danger font-weight-bold my-1 "
                  v-text="errors.rd[0]"
                />
              </div>
              <div class="col-4">
                <label
                  for=""
                  class="font-weight-bold pr-2"
                >CD
                </label>
                <input
                  v-model.number="form.cd"
                  type="number"
                  :disabled="isApproved"
                  class="custom-input"
                >
                <p
                  v-if="Object.keys(errors).length > 0 && errors.cd"
                  class="text-danger font-weight-bold my-1"
                  v-text="errors.cd[0]"
                />
              </div>
              <div
                v-if="form.transaction_category === 'international'"
                class="col-4 mb-1"
              >
                <label
                  for=""
                  class="font-weight-bold pr-2"
                >AT Rate(%)
                </label>
                <input
                  v-model="form.atRate"
                  type="text"
                  class="custom-input px-2"
                  :disabled="isApproved"
                >
                <p
                  v-if="Object.keys(errors).length > 0 && errors.atRate"
                  class="text-danger font-weight-bold my-1 "
                  v-text="errors.atRate[0]"
                />
              </div>
              <div class="col-4 mb-1">
                <label
                  for=""
                  class="font-weight-bold pr-2"
                > SD Rate(%)
                </label>
                <input
                  v-model.number="form.sdRate"
                  :disabled="isApproved"
                  type="text"
                  class="custom-input"
                  style="padding:0.5rem 10px;"
                >
                <p
                  v-if="Object.keys(errors).length > 0 && errors.sdRate"
                  class="text-danger font-weight-bold my-1 "
                  v-text="errors.sdRate[0]"
                />
              </div>
              <div class="col-4 mb-1">
                <label
                  for=""
                  class="font-weight-bold pr-1"
                >
                  Tax Rate(%)
                </label>
                <model-list-select
                  v-model="form.taxRate"
                  :list="taxRates"
                  option-value="id"
                  option-text="details"
                  :disabled="isApproved"
                  class="custom-input"
                />
                <p
                  v-if="Object.keys(errors).length > 0 && errors.taxRate"
                  class="text-danger font-weight-bold my-1 "
                  v-text="errors.taxRate[0]"
                />
              </div>
            </div>
            <!-- //multi-product details box  -->
            <div
              v-if="productsArray.length && isMultipleProduct"
              class="calculation-section py-2"
            >
              <div class="row">
                <div class="col-md-4">
                  <label style="text-decoration:underline">Description</label>
                </div>
                <div class="col-md-2">
                  <label style="text-decoration:underline">Price</label>
                </div>
                <div class="col-md-2">
                  <label style="text-decoration:underline">Sd</label>
                </div>
                <div class="col-md-2">
                  <label style="text-decoration:underline">At  </label>
                </div>
                <div class="col-md-2">
                  <label style="text-decoration:underline">Vat</label>
                </div>
              </div>
              <div
                v-for="(product,index) in productsArray"
                :key="index"
                class="row"
              >
                <div class="col-md-4">
                  <label v-text="product.productName ? product.productName.substr(0,10)+'...' : '' " />
                </div>
                <div class="col-md-2">
                  <label v-text="product.taxable_value" />
                </div>
                <div class="col-md-2">
                  <label v-text="getsdRate(product)" />
                </div>
                <div class="col-md-2">
                  <label v-text="getAtRate(product)" />
                </div>
                <div class="col-md-2">
                  <label v-text="getVatRate(product)" />
                </div>
              </div>
              <hr>
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
            <div class="row mb-1">
              <div
                v-if="isMultipleProduct == false"
                class="col-6 mb-1"
              >
                <label
                  class="font-weight-bold"
                >Total Value</label>
                <input
                  v-model.number="form.taxable_value"
                  disabled
                  type="number"
                  class="custom-input px-1"
                >
                <p
                  v-if="Object.keys(errors).length > 0 && errors.taxable_value"
                  class="text-danger font-weight-bold my-1"
                  v-text="errors.taxable_value[0]"
                />
              </div>

              <div
                v-if="form.transaction_type === 1 || form.transaction_type === 2"
                class="col-6"
              >
                <label
                  for=""
                  class="font-weight-bold "
                >will you pay tax ?  </label>
                <input
                  v-model="form.tax_payable"
                  type="checkbox"
                  class="mx-2"
                >
                <p class="text-sm">
                  (for note 24 and 29)
                </p>
              </div>
              <!--
              <div class="col-6">
                <label
                  for=""
                  class="font-weight-bold"
                >Employee </label>
                <model-list-select
                  v-model="form.employee_id"
                  :list="employees"
                  option-value="id"
                  option-text="name"
                  placeholder="select Employee"
                  :disabled="isApproved===true"
                  class="custom-input"
                />
                <p
                  v-if="Object.keys(errors).length > 0 && errors.employee_id"
                  class="text-danger font-weight-bold my-1 "
                  v-text="errors.employee_id [0]"
                />
              </div> -->
            </div>
            <!-- end of product inputs section  -->
            <div class="row">
              <div
                class="col-12 pl-2 pr-3"
                for="toggle_button"
              >
                <div class="row">
                  <button
                    class="px-2 col-6 bank"
                    :class="[isBanking ? 'active_channel' : 'channel' ]"
                    style="padding:0.5rem 0;"
                    @click="isBanking = true"
                  >Bank</button>
                  <button
                    class="px-2 col-6 rounded-1 cash"
                    :class="[isBanking == false ? 'active_channel' : 'channel' ]"
                    style="padding:0.5rem 0;"
                    @click="isBanking=false"
                  >Cash</button>
                </div>
              </div>
            </div>

          </div>
          <!-- product inputs section  -->
        </div>
      </div>

      <!-- <hr> -->
      <div class="single-input mb-3 py-1 pl-2 d-flex align-items-center justify-start">
        <p class="badge badge-success rounded-circle mr-2 mt-1">
          <mdicon
            size="20"
            name="check-bold"
            class="text-light"
          />
        </p>
        <div class="button-content d-flex align-items-center justify-start">
          <button
            v-if="!isApproved"
            class="btn-lg px-2 btn-primary mr-2"
            style="padding-top:0.5rem;padding-bottom:0.5rem"
            @click.prevent="updateTransaction"
          >
            Update
          <!-- & Proceeed -->
          </button>
          <button
            v-if="isApproved"
            class="btn-lg px-1 btn-primary mr-2"
            style="padding-top:0.5rem;padding-bottom:0.5rem"
            disabled
          >
            <span>Approved</span>
            <mdicon
              size="20"
              name="check-bold"
              class="text-white mr-2 font-weight-bold "
            />
          </button>
          <button
            v-if="isRejected"
            class="btn-lg px-1 btn-danger mr-2"
            style="padding-top:0.5rem;padding-bottom:0.5rem"
            disabled
          >
            <span>Rejected</span>
            <mdicon
              size="20"
              name="check-bold"
              class="text-white mr-2 font-weight-bold"
            />
          </button>

          <button
            v-if="!isApproved && hasApprovePermission"
            class="btn-lg px-2 btn-outline-primary"
            style="padding-top:0.5rem;padding-bottom:0.5rem"
            @click.prevent="status='approved',updateTransactionStatus()"
          >
            Approve
          </button>
          <button
            v-if="!isApproved && hasRejectPermission"
            class="btn-lg px-2  btn-danger"
            style="padding-top:0.5rem;padding-bottom:0.5rem"
            @click.prevent="status='rejected',updateTransactionStatus()"
          >
            Reject
          </button>
        </div>
      </div>
    </div>
    <!-- //calculation section -->

    <!-- <hr> -->
    <keep-alive>
      <product-modal-for-edit
        v-if="showProductModal"
        buttontext="Close"
        :products-array="productsArray"
        :form="form"
        :is-approved="isApproved"
        @addNewProductInForm="addNewProductInForm"
        @removeProduct="removeProductInForm"
        @closeModal="showProductModal=false"
      />
    </keep-alive>
  </div>
</template>

<script>
import { BTooltip } from 'bootstrap-vue'
import { ModelListSelect } from 'vue-search-select'
import { mapGetters, mapState } from 'vuex'
import EntityApi from '@/api/entity/EntityApi'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
import setTransactionDataFormEdit from '@/helpers/setTransactionDataFormEdit'
import Permissions from '@/helpers/Permissions'
import ContactsListMixin from '@/mixins/ContactsListMixin'
import EntityDocuments from '@/mixins/EntityDocuments'
import RateMixinForProduct from '@/mixins/RateMixinForProduct'
import FormatNumberMixin from '@/mixins/FormatNumberMixin'
import ProductModalForEdit from '@/components/global/ProductModalForEdit.vue'
import TreasuryFormTransactionForEdit from '@/components/draftInvoice/TreasuryFormTransactionForEdit.vue'
import AdjustmentFormForEdit from '@/components/draftInvoice/AdjustmentFormForEdit.vue'

export default {
  emits: ['closeForm'],
  components: {
    BTooltip,
    ModelListSelect,
    ProductModalForEdit,
    TreasuryFormTransactionForEdit,
    AdjustmentFormForEdit,
  },
  mixins: [ContactsListMixin, EntityDocuments, RateMixinForProduct, FormatNumberMixin],
  data() {
    return {
      addNewProduct: false,
      addNewContact: false,
      isMultipleProduct: false,
      showProductModal: false,
      form: {
        id: null,
        transaction_date: new Date(),
        transaction_type: null,
        document_type: null,
        contact_id: null,
        contact_name: null,
        contact_bin_number: null,
        contactAddress: null,
        contactCode: null,

        transaction_category: 'local',
        office_code: null,
        item_no: null,
        CPC: null,
        employee_id: null,
        invoiceId: null,

        productName: null,
        productCode: null,
        productId: null,
        product_unit: null,
        unit_price: null,
        productHSCode: null,
        dictionaryProductId: null,
        sdRate: null,
        atRate: null,
        taxRate: null,
        taxable_value: null,
        ait: null,
        rd: null,
        cd: null,
        qty: 1,
        tax_payable: false,
        transaction_channel: null,
      },
      productsArray: [],
      // {
      //   productName: '',
      //   productId: null,
      //   productCode: null,
      //   product_unit: null,
      //   unit_price: null,
      //   productHSCode: null,
      //   dictionaryProductId: null,
      //   sdRate: null,
      //   atRate: null,
      //   taxRate: null,
      //   taxable_value: null,
      //   ait: null,
      //   rd: null,
      //   cd: null,
      //   qty: 1,
      // }
      errors: [],
      error: '',
      documentTypes: [],
      transactionTypes: [],
      // productNatures: [],
      challanForm: {
        id: null,
        bank: null,
        branch: null,
        district: null,
        date: null,
        deposit_account_code: null,
        deposit_amount: 0,
        deposit_type: null,
      },
      adjustmentForm: {
        id: null,
        title: null,
        amount: 0,
        vat_rate: null,
        adjustment_date: null,
        adjustment_type: null,
      },
      contacts: [],
      taxRates: [],
      sdRates: [],
      atRates: [],
      employees: [],
      banks: [],
      entityProducts: [],
      transaction: { id: 0 },
      isApproved: false,
      isRejected: false,
      status: 'approved',
      isBanking: true,
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
    hasApprovePermission() {
      return Permissions.approvePermission(this.AuthUserEntityRole.role_name) || this.authUser?.type === 'superadmin'
    },
    hasRejectPermission() {
      return Permissions.rejectPermission(this.AuthUserEntityRole.role_name) || this.authUser?.type === 'superadmin'
    },
    totalTaxableValue() {
      return this.productsArray.reduce((t, product) => Number.parseFloat(product.taxable_value) + t, 0) || 0
    },
    totalSdValue() {
      return this.productsArray.reduce((t, product) => this.getsdRate(product) + t, 0) || 0
    },
    totalAtRateValue() {
      return this.productsArray.reduce((t, product) => this.getAtRate(product) + t, 0) || 0
    },
    totalVateRateValue() {
      const vatRate = this.productsArray.reduce((t, product) => this.getVatRate(product) + t, 0) || 0
      return parseFloat(vatRate).toFixed(2) || 0
    },
  },
  watch: {
    isBanking(newVal) {
      if (newVal) {
        this.form.transaction_channel = 'banking'
      } else {
        this.form.transaction_channel = 'cash'
      }
    },
    currentEntity() {
      this.entityContacts()
      this.TaxRates()
      this.AtRates()
      this.entityEmployees()
      this.entityProductsList()
    },
    async currentTransaction(newVal, oldValue) {
      if (newVal?.id === oldValue?.id || !newVal) {
        return
      }
      this.$store.commit('UPDATE_IS_LOADER', true)
      if (newVal?.review_status === 'approved') {
        this.isApproved = true
        this.isRejected = false
      } else if (newVal?.review_status === 'rejected') {
        this.isRejected = true
        this.isApproved = false
      } else {
        this.isApproved = false
        this.isRejected = false
      }
      await this.getCurrentTransaction()
      // await this.entityContacts()
      // await this.TaxRates()
      // await this.AtRates()
      // await this.entityEmployees()
      // await this.entityProductsList()
      this.$store.commit('UPDATE_IS_LOADER', false)
    },

    isMultipleProduct(newVal) {
      if (newVal === true) {
        const singleProduct = {
          productName: this.form?.productName,
          productId: this.form?.productId,
          productCode: this.form?.productCode,
          product_unit: this.form?.product_unit,
          unit_price: this.form?.unit_price,
          productHSCode: this.form?.productHSCode,
          dictionaryProductId: null,
          sdRate: this.form?.sdRate,
          atRate: this.form?.atRate,
          taxRate: this.form?.taxRate,
          taxValue: this.form?.taxValue,
          taxable_value: this.form?.taxable_value,
          ait: this.form?.ait,
          rd: this.form?.rd,
          cd: this.form?.cd,
          qty: this.form?.qty,
        }
        this.productsArray.push(singleProduct)
      }
    },

    'form.unit_price': function (newVal) {
      console.log(newVal)
      if (typeof newVal === 'number' && typeof this.form.qty === 'number') {
        this.form.taxable_value = newVal * this.form.qty
      }
    },
    'form.qty': function (newVal) {
      if (typeof newVal === 'number' && typeof this.form.unit_price === 'number') {
        this.form.taxable_value = newVal * this.form.unit_price
      }
    },
    // eslint-disable-next-line func-names
    'form.contact_id': function (newVal) {
      if (newVal === 'new_contact') {
        this.addNewContact = true
      } else {
        this.addNewContact = false
        if (newVal) {
          // this.getContactViaId(newVal)
        }
      }
    },
    // eslint-disable-next-line func-names
    'form.productId': function (newVal) {
      if (newVal === 'new_product') {
        this.addNewProduct = true
      } else {
        this.addNewProduct = false
        if (newVal) {
          // this.getProductViaId(newVal)
        }
      }
    },
  },
  async mounted() {
    this.$store.commit('UPDATE_IS_LOADER', true)
    await this.getCurrentTransaction()
    await this.getTransactionTypes()
    // await this.getProductNatures()
    await this.getDocumentType()
    await this.entityContacts()
    await this.TaxRates()
    await this.AtRates()
    await this.entityEmployees()
    await this.entityProductsList()
    // await this.bankList()
    this.$store.commit('UPDATE_IS_LOADER', false)
  },
  methods: {
    addNewProductInForm() {
      this.productsArray.push({
        productId: null,
        productName: '',
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
      })
    },
    // for multiple transaction product
    removeProductInForm(index) {
      const item = this.productsArray.find((_, index1) => index1 === index)
      if (item) {
        this.productsArray.splice(index, 1)
      }
    },
    async getCurrentTransaction() {
      try {
        const { data: { transaction } } = await EntityApi.transactionDetails(this.currentEntity.id, this.GET_CURRENT_TRANSACTION.id)
        this.$store.commit('transactions/SET_CURRENT_TRANSACTION', transaction)
        if (transaction?.transactionsProducts?.length > 1) {
          this.isMultipleProduct = true
          this.showProductModal = true
        }
        this.setTransactionInForm(transaction)
        // this.form = setTransactionDataFormEdit(this.form, transaction)
        // this.transaction = transaction
        // if (transaction.review_status === 'approved') {
        //   this.isApproved = true
        // } else if (transaction.review_status === 'rejected') {
        //   this.isRejected = true
        // }
      } catch (error) {
        console.log(error)
      }
    },
    async setTransactionInForm(transaction) {
      this.productsArray.length = await 0
      const [newForm, newChallanForm, newAdjustmentForm] = await setTransactionDataFormEdit(this.form, this.productsArray, this.challanForm, this.adjustmentForm, transaction)
      if (this.form.transaction_channel === 'banking') {
        this.isBanking = true
      } else {
        this.isBanking = false
      }
      // update form data with newForm Value
      this.form = newForm
      // update challanForm data with newChallanForm Value
      this.challanForm = newChallanForm
      // update adjustmentForm data with newAdjustmentForm value
      this.adjustmentForm = newAdjustmentForm
      this.transaction = transaction
      if (transaction?.review_status === 'approved') {
        this.isApproved = true
      } else if (transaction?.review_status === 'rejected') {
        this.isRejected = true
      }
    },
    async getContactViaId() {
      try {
        const { data: { contact } } = await EntityApi.getEntitySingleContact(this.currentEntity.id, this.form.contact_id)
        this.form.contact_id = contact.id
        this.form.contact_name = contact.name
        this.form.contact_bin_number = contact.bin
        this.form.contactAddress = contact.address
        this.form.contactCode = contact.contact_code
      } catch (error) {
        console.log(error)
      }
    },
    async getProductViaId() {
      try {
        const { data: { entityProduct } } = await EntityApi.getEntitySingleProduct(this.currentEntity.id, this.form.productId)
        this.form.product_unit = entityProduct.unit
        this.form.productHSCode = entityProduct.hs_code
        this.form.productName = entityProduct.title
        this.form.productCode = entityProduct.code
        this.form.sdRate = entityProduct.sd_rate
        this.form.taxRate = entityProduct.vat_rate
        this.form.atRate = entityProduct.at
        this.form.ait = entityProduct.ait
        this.form.cd = entityProduct.cd
        this.form.rd = entityProduct.rd
        // this.form.taxable_value = entityProduct.taxable_value;
      } catch (error) {
        console.log(error)
      }
    },
    getSelectedDocuments() {
      this.form.documents = [...this.selectedDocumentIds]
    },
    async getDocumentType() {
      try {
        const { data: { documentTypes } } = await EntityApi.entityDocumentTypes()
        this.documentTypes = documentTypes
      } catch (error) {
        console.log(error)
      }
    },
    async getTransactionTypes() {
      try {
        const { data: { transactionTypes } } = await EntityApi.getTransactionTypes()
        this.transactionTypes = transactionTypes
      } catch (error) {
        console.log(error)
      }
    },
    async entityContacts() {
      try {
        const { data: { contacts } } = await EntityApi.entityContacts(this.currentEntity.id)
        this.contacts = [{ id: 'new_contact', name: 'Add New Contact' }, ...contacts]
      } catch (error) {
        console.log(error)
      }
    },
    async entityProductsList() {
      try {
        const { data: { entityProducts } } = await EntityApi.entityProducts(this.currentEntity.id)
        this.entityProducts = [{ id: 'new_product', title: 'Add New Product' }, ...entityProducts]
      } catch (error) {
        console.log(error)
      }
    },
    async TaxRates() {
      try {
        const { data: { taxRates } } = await EntityApi.TaxesRates()
        this.taxRates = [...taxRates]
      } catch (error) {
        console.log(error)
      }
    },
    async SDRate() {
      try {
        const { data: { sdRates } } = await EntityApi.SdRates()
        this.sdRates = [...sdRates]
      } catch (error) {
        console.log(error)
      }
    },
    async AtRates() {
      try {
        const { data: { atRates } } = await EntityApi.ATRates()
        this.atRates = [...atRates]
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
    // },
    async entityEmployees() {
      try {
        const { data: { employees } } = await EntityApi.entityEmployees(this.currentEntity.id)
        this.employees = employees
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

    async getProductViaHsCode() {
      if (this.form.productId === 'new_product' && this.form.productHSCode) {
        try {
          const { data: { product } } = await EntityApi.dictionaryProductViaHsCode(this.form.productHSCode)
          // set product to form
          this.form.dictionaryProductId = product.id
          this.form.product_unit = product.unit
          this.form.productHSCode = product.hs_code
          this.form.productName = product.title
          this.form.sdRate = product.sd_rate
          this.form.vat_rate = product.vat_rate
          this.form.atRate = product.at
          this.form.ait = product.ait
          this.form.cd = product.cd
          this.form.rd = product.rd
        } catch (error) {
          console.log(error)
        }
      }
    },
    updateTransactionStatus() {
      this.$store.commit('UPDATE_IS_LOADER', true)
      EntityApi.transactionUpdateStatus(this.currentEntity.id, this.form.id, this.status)
        .then(({ data: { success, transaction } }) => {
          this.$store.commit('UPDATE_IS_LOADER', false)
          if (this.status === 'approved') {
            this.$store.commit('transactions/UPDATE_ACTIVE_DOCUMENT_STATUS_NAV', 'Approved')
            this.isApproved = true
          } else if (this.status === 'rejected') {
            this.isRejected = true
            this.$store.commit('transactions/UPDATE_ACTIVE_DOCUMENT_STATUS_NAV', 'Failed')
          }

          this.getFoldersViaEntity()
          this.getEntityDraftDocuments()
          this.setTransactionInForm(transaction)
          this.$store.commit('transactions/SET_CURRENT_TRANSACTION', transaction)
          this.$store.commit('transactions/UPDATE_IS_OPEN_FOLDER', true)
          this.$toast({
            component: ToastificationContent,
            props: {
              title: success,
              icon: 'EditIcon',
              variant: 'success',
            },
          })
        }).catch(error => {
          this.$store.commit('UPDATE_IS_LOADER', false)
          if (error.response?.status === 422) {
            this.$toast({
              component: ToastificationContent,
              props: {
                title: error.response?.data?.message,
                icon: 'XCircleIcon',
                variant: 'danger',
              },
            })
          } else if (error.response?.status === 500) {
            this.$toast({
              component: ToastificationContent,
              props: {
                title: error.response?.data?.message,
                icon: 'XCircleIcon',
                variant: 'danger',
              },
            })
          }
        })
    },
    async updateTransaction() {
      this.errors = []
      // if (this.form.reject === true) {
      //   const { isDenied } = await this.$swal.fire({
      //     title: 'Are Your Sure? You Want to Reject This File',
      //     showDenyButton: true,
      //     showCancelButton: false,
      //     confirmButtonText: 'Proceed',
      //     denyButtonText: 'Cancel',
      //   })
      //   if (isDenied) {
      //     return
      //   }
      // }
      this.$store.commit('UPDATE_IS_LOADER', true)
      let formData = null
      if (this.form.transaction_type === 4) {
        formData = { ...this.form, challanForm: this.challanForm, isMultiple: false }
      } else if (this.form.transaction_type === 5) {
        formData = { ...this.form, adjustmentForm: this.adjustmentForm, isMultiple: false }
      } else if (this.isMultipleProduct) {
        formData = { ...this.form, productsArray: this.productsArray, isMultiple: true }
      } else {
        formData = { ...this.form, isMultiple: false }
      }
      EntityApi.transactionUpdate(formData, this.currentEntity.id, formData.id)
        .then(({ data: { success, transaction } }) => {
          this.$store.commit('UPDATE_IS_LOADER', false)
          this.isMultipleProduct = false
          this.showProductModal = false
          this.resetForm()// reset form
          this.setTransactionInForm(transaction)
          if (transaction?.transactionsProducts?.length > 1) {
            this.isMultipleProduct = true
            this.showProductModal = true
          }

          if (transaction.review_status === 'approved') {
            this.$store.commit('transactions/UPDATE_ACTIVE_DOCUMENT_STATUS_NAV', 'Approved')
          } else if (transaction.review_status === 'rejected') {
            this.$store.commit('transactions/UPDATE_ACTIVE_DOCUMENT_STATUS_NAV', 'Failed')
          }

          this.getFoldersViaEntity()
          this.getEntityDraftDocuments()
          this.$store.commit('transactions/SET_CURRENT_TRANSACTION', transaction)
          this.$store.commit('transactions/UPDATE_IS_OPEN_FOLDER', true)
          this.$toast({
            component: ToastificationContent,
            props: {
              title: success,
              icon: 'EditIcon',
              variant: 'success',
            },
          })
        })
        .catch(error => {
          this.$store.commit('UPDATE_IS_LOADER', false)
          if (error?.response?.status === 422) {
            this.errors = error.response.data.errors
          } else if (error?.response?.status === 500) {
            this.$toast({
              component: ToastificationContent,
              props: {
                title: error.response?.data?.error,
                icon: 'XCircleIcon',
                variant: 'danger',
              },
            })
          } else if (error.response?.status === 404) {
            this.$toast({
              component: ToastificationContent,
              props: {
                title: error.response.data.message,
                icon: 'XCircleIcon',
                variant: 'danger',
              },
            })
          }
        })
    },
    resetForm() {
      this.form = {
        id: null,
        transaction_date: new Date(),
        transaction_type: null,
        document_type: null,
        contact_id: null,
        contact_name: null,
        contact_bin_number: null,
        contactAddress: null,
        contactCode: null,

        transaction_category: 'local',
        office_code: null,
        item_no: null,
        CPC: null,
        employee_id: null,
        invoiceId: null,

        productName: null,
        productCode: null,
        productId: null,
        product_unit: null,
        unit_price: null,
        productHSCode: null,
        dictionaryProductId: null,
        sdRate: null,
        atRate: null,
        taxRate: null,
        taxable_value: null,
        ait: null,
        rd: null,
        cd: null,
      }
      this.productsArray = []
    },

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

.bank{
 border-top-left-radius:0.5rem;
 border-bottom-left-radius:0.5rem;
}
.cash{
  border-top-right-radius:0.5rem;
  border-bottom-right-radius:0.5rem;
}
.bank,.cash{
  border:none;
  padding:0.5rem 0;
}
.channel{
  background:#E3E0FF;
  color:black;
}
.active_channel{
  background:#7367F0;
  color:#fff;
}
</style>
