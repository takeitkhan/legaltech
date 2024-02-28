<template>
  <div class="single-input mb-3 d-flex justify-content-between align-items-center">
    <label
      for=""
      class="font-weight-bold "
    >Product Name </label>
    <select

      id="document-type"
      v-model="form.productName"
      class="custom-input px-1"
      style="color:#000 !important;"
    >
      <option
        value=""
        disabled
        selected
      >
        Choose
      </option>
      <option value="invoice">
        invoice
      </option>
      <option value="pdf">
        pdf
      </option>
      <option value="mushak">
        mushak
      </option>
    </select>
  </div>

</template>

<script>
export default {

}
</script>


<style scoped>
.single-input label{
  /* border:1px solid red; */
  width:50%;
}
.custom-input{
  width:100%;
  border:1px solid #D1D5DB;
  padding:10px;
  border-radius: 5px;
  outline:none;
}
label{
  font-weight:bold !important;
}

</style>