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
        <div class="form-group">
          <input
            v-model="form.title"
            type="text"
            placeholder="Adjustment Title"
            class="form-control"
          >
        </div>
        <div class="form-group">
          <input
            v-model="form.amount"
            type="number"
            placeholder="Adjustment Amount"
            class="form-control"
          >
        </div>
        <div class="form-group">
          <select
            v-model="form.adjustment_type"
            class="form-control"
            disabled
          >
            <option value="increasing">
              Increasing
            </option>
            <option value="decreasing">
              decreasing
            </option>
          </select>
        </div>
        <div class="form-group">
          <input
            v-model="form.adjustment_date"
            type="date"
            placeholder="Adjustment Amount"
            class="form-control"
          >
        </div>
        <div class="form-group">
           <button class="btn btn-primary btn-sm">save</button>
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

export default {
  emits: [],
  components: {

  },
  props: ['buttontext', 'form', 'title'],
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
