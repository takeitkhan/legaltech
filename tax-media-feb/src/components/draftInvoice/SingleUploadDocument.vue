<template>
  <div>
    <!-- v-if="openFolder && active.name === document.name" -->
    <div

      class="transaction_docs ml-4"
      :class="activeDocumentClass"
      style="margin-top:5px;"
    >
      <div
        class="single-transaction cursor-pointer"
        @click="setCurrentDocument"
      >
        <mdicon
          size="20"
          class="folder-color font-bold "
          name="file-document-outline"
        />
        {{ name }}
      </div>
    </div>
  </div>
</template>

<script>
import { format } from 'date-fns'
import { mapGetters, mapState } from 'vuex'

export default {
  props: ['document'],
  data() {
    return {
      openFolder: false,
    }
  },
  computed: {
    formatTransactionDate() {
      return date => format(new Date(date), 'yyyy_mm_dd')
    },
    ...mapGetters('transactions', {
      GET_DOCUMENT: 'GET_CURRENT_DOCUMENT',
    }),
    ...mapState('transactions', {
      activeDocumentStatusNav: state => state.activeDocumentStatusNav,
    }),
    hasActiveDocument() {
      return typeof this.GET_DOCUMENT === 'object' && Object.keys(this.GET_DOCUMENT).length > 0 ? this.GET_DOCUMENT : false
    },
    name() {
      return this.document?.name
    },
    activeDocumentClass() {
      return [this.GET_DOCUMENT?.name === this.name || (this.hasActiveDocument && (this.hasActiveDocument?.id === this.document?.id)) ? 'activeColor' : '']
    },
  },
  methods: {
    setCurrentDocument() {
      console.log('this is from set current document')
      if (this.GET_DOCUMENT?.name === this.document?.name) {
        this.openFolder = !this.openFolder
      } else {
        this.openFolder = false
      }
      this.$store.commit('transactions/SET_CURRENT_DOCUMENT', this.document)
      if (this.document?.status === 'trashed') {
        this.$store.commit('transactions/UPDATE_ACTIVE_DOCUMENT_STATUS_NAV', 'All')
      } else if (this.document?.status === 'draft') {
        this.$store.commit('transactions/UPDATE_ACTIVE_DOCUMENT_STATUS_NAV', 'Processing')
      }
      this.$store.commit('transactions/SET_CURRENT_TRANSACTION', {})
    },
  },

}
</script>

<style scoped>
.folder-color{
  color:#796DF0;
}
.activeColor{
    background:#F3F8FB;
}
</style>
