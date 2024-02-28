import authConfig from '@/api/auth/authConfig'
import EntityApi from '@/api/entity/EntityApi'
import { mapState } from 'vuex'

export default {
  computed: {
    ...mapState('transactions', {
      currentTransaction: state => state.currentTransaction,
    }),
  },
  methods: {
    async getEntityDraftDocuments() {
      try {
        const { data: { documents } } = await EntityApi.entityDocuments(this.currentEntity.id, 'draft')
        this.$store.commit('transactions/UPDATE_UPLOADED_DOCUMENTS', documents)
        if (Object.keys(this.currentTransaction).length === 0) {
          this.$store.commit('transactions/SET_CURRENT_DOCUMENT', documents[0])
          this.$store.commit('transactions/UPDATE_IS_UPLOAD_FOLDER', true)
        }
        // this.isUploadFolder = true
      } catch (error) {
        if (error?.response?.status === 422) {
          this.redirectGuardUser()
        }
      }
    },
    async getEntityDocumentsViaStatus(status) {
      try {
        const { data: { documents } } = await EntityApi.entityDocuments(this.currentEntity.id, status)
        if (status === 'draft') {
          this.$store.commit('transactions/UPDATE_UPLOADED_DOCUMENTS', documents)
          this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
          this.$store.commit('transactions/SET_CURRENT_TRANSACTION', {})
        } else if (status === 'approved') {
          this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
        } else if (status === 'review') {
          this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
        } else if (status === 'failed') {
          this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
        } else if (status === 'trashed') {
          this.$store.commit('transactions/UPDATE_TRASHLIST', documents)
          // this.$store.commit('transactions/UPDATE_TRANSLIST', 'Failed')
        }
        console.log('running from entity draft documents.js')
      } catch (error) {
        if (error?.response?.status === 422) {
          this.redirectGuardUser()
        }
      }
    },
    redirectGuardUser() {
      localStorage.removeItem(authConfig.storageTokenKeyName)
      this.$router.push({ name: 'login' })
    },

  },
}
