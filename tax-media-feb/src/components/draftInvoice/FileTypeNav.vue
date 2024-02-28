<template>
  <button
    :class="[activeDocumentStatusNav == name?'active_btn_nav':'btn-nav']"
    @click="$emit('updateActive',name)"
  >
    {{ name }}
  </button>
</template>

<script>
import { mapState } from 'vuex'

export default {
  props: ['name', 'active'],
  data() {
    return {
      showModal: false,
    }
  },
  computed: {
    ...mapState('transactions', {
      activeDocumentStatusNav: state => state.activeDocumentStatusNav,
    }),
  },
}
</script>

<style scoped>
 .folder_file_list{
    width:500px;
}
.btn-nav,.active_btn_nav{
    margin-right:5px;
    border:1px solid #6259CF !important;
    /* padding:0.3rem 0.8rem; */
    padding:0.3rem 0.5rem;
    border-radius: 0.3rem;
    color:#6259CF;
    background:#fff;
    font-weight:500;
    text-transform: capitalize;
    font-size:0.9rem;
    /* font-size:0.6rem; */
    /* clip-path: polygon(11% 0, 92% 0, 100% 100%, 0 99%); */
}
.active_btn_nav{
  background:#6259CF;
  color:#fff;
  border:1px solid #6259CF !important;
}
.btn-approve{
    background:#2f92e9;
    color:#fff;
}

.single-file{
    cursor:pointer;
}
.single-file:hover{
  color:#6259CF;
  background:#F4F7FE
}
.file-type-nav{
    background:#F3F8FB;
    padding:0.4rem;
}
.warning-icon{
    color:#E59118;
}
</style>
