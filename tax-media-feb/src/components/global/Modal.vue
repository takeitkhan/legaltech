<template>
  <div class="modal-size-lg d-inline-block">
    <!-- Button trigger modal -->
    <div
      id="large"
      class="modal  text-left  "
      tabindex="-1"
      aria-labelledby="myModalLabel17"
      aria-modal="true"
      role="dialog"
    >
      <div
        class="modal-dialog modal-dialog-centered modal-lg"
        role="document"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h4
              id="myModalLabel17"
              class="modal-title text-success"
            >
              <!-- Large Modal -->
              <slot name="header" />
            </h4>
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
            <slot name="content" />
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
export default {
  props: ['buttontext'],
  data() {
    return {

    }
  },
  methods: {

  },
}
</script>

<style scoped>
#large{
    background:rgba(0, 0, 0,0.4) !important;
    display: block; padding-right: 17px;
}
.modal-body{
  height:auto !important;
  overflow:auto !important;;
}
.modal .modal-body{
  max-height:500px !important;
  overflow:auto !important;
}
.modal-size-lg{
  overflow:auto !important;
}
</style>
