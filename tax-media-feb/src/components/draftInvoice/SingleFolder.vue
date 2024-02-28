<template>
  <div>
    <div
      class=" single-folder-content hover:bg-gray-200  px-1  cursor-pointer d-flex pt-1"
      @click="emitEvent"
    >
      <!-- <Mdi-Icon  class="text-gray-400 font-bold" height="18" icon="mdi:menu-down"/> -->
      <mdicon
        v-if="isOpenSingleFolder && activeContact == contactName"
        size="18"
        class="text-gray-400 font-bold"
        name="menu-down"
      />
      <mdicon
        v-else
        size="18"
        class="text-gray-400 font-bold"
        name="menu-right"
      />

      <mdicon
        v-if="isOpenSingleFolder && activeContact == contactName"
        size="20"
        class="folder-color font-bold "
        name="folder-open"
      />
      <mdicon
        v-else
        size="20"
        class="folder-color font-bold "
        name="folder"
      />
      <span
        class="text-md capitalize"
        style="margin-left:5px;"
      >{{ contactName }} ({{ totalTransactions }})</span>

    </div>
    <div
      v-if="isOpenSingleFolder && activeContact == contactName"
      class="transaction_docs ml-4 "
      style="margin-top:5px;"
    >
      <div
        v-for="(transaction,index) in transactions"
        :key="index"
        class="single-transaction cursor-pointer "
        :class="[hasTransaction && transaction.id === hasTransaction.id ?'activeColor':'']"
        @click="showFiles(transaction)"
      >
        <mdicon
          size="20"
          class="folder-color font-bold "
          name="file-document-outline"
        />
        {{ formatTransactionDate(transaction.transaction_date)+"_"+transaction.document_type }}

      </div>
    </div>
  </div>
</template>

<script>
import { format } from 'date-fns'
import { mapGetters, mapState } from 'vuex'

export default {
  props: ['contact'],
  computed: {
    ...mapState('transactions', {
      isOpenFolderNav: state => state.isOpenFolderNav,
      activeContact: state => state.activeContact,
      isOpenSingleFolder: state => state.isOpenSingleFolder,
    }),
    totalTransactions() {
      return this.contact?.transactions?.length || 0
    },
    contactName() {
      return this.contact?.name || ''
    },
    transactions() {
      return this.contact?.transactions || []
    },
    formatTransactionDate() {
      return date => format(new Date(date), 'yyyy_MM_dd')
    },
    ...mapGetters('transactions', {
      CURRENT_TRANSACTION: 'GET_CURRENT_TRANSACTION',
    }),
    hasTransaction() {
      return typeof this.CURRENT_TRANSACTION === 'object' && Object.keys(this.CURRENT_TRANSACTION).length ? this.CURRENT_TRANSACTION : false
    },
  },
  methods: {
    emitEvent() {
      this.$store.commit('transactions/UPDATE_ACTIVE_CONTACT', this.contact.name)
      if (this.activeContact === this.contact.name) {
        this.$store.commit('transactions/UPDATE_IS_SINGLE_FOLDER_NAV', true)
      } else {
        this.$store.commit('transactions/UPDATE_IS_SINGLE_FOLDER_NAV', false)
      }
    },
    showFiles(transaction) {
      this.$store.commit('transactions/SET_CURRENT_TRANSACTION', transaction)
      if (transaction.review_status === 'approved') {
        this.$store.commit('transactions/UPDATE_ACTIVE_DOCUMENT_STATUS_NAV', 'Approved')
      } else if (transaction.review_status === 'submitted') {
        this.$store.commit('transactions/UPDATE_ACTIVE_DOCUMENT_STATUS_NAV', 'Review')
      } else if (transaction.review_status === 'rejected') {
        this.$store.commit('transactions/UPDATE_ACTIVE_DOCUMENT_STATUS_NAV', 'Failed')
      }
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
