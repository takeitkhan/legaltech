import authConfig from '@/api/auth/authConfig'
import EntityApi from '@/api/entity/EntityApi'

export default {
  methods: {
    async getDocuments() {
      this.$store.commit('UPDATE_IS_LOADER', true)
      const activeNav = this.activeDocumentStatusNav.toLowerCase()
      if (activeNav === 'select' || activeNav === 'processing') {
        try {
          const error = await this.updateStore('draft')
          if (error) {
            this.redirectGuardUser()
          }
        } catch (error) {
          this.redirectGuardUser()
        }
      } else if (activeNav === 'all') {
        try {
          const error = await this.updateStore('all')
          if (error) {
            this.redirectGuardUser()
          }
        } catch (error) {
          this.redirectGuardUser()
        }
      } else if (activeNav === 'approved') {
        try {
          if (Object.keys(this.currentTransaction).length > 0) {
            this.getDocumentsViaTransaction()
          } else {
            const { data: { documents } } = await this.getDocumentsRequest('approved')
            this.documents = documents
            this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
          }
        } catch (error) {
          console.log(error)
        }
      } else if (activeNav === 'Review') {
        try {
          if (Object.keys(this.currentTransaction).length > 0) {
            this.getDocumentsViaTransaction()
          } else {
            const error = await this.updateStore('review')
            if (error) {
              this.redirectGuardUser()
            }
          }
        } catch (error) {
          if (error?.response?.status === 401) {
            this.redirectGuardUser()
          }
        }
      } else if (this.activeNav.toLowerCase() === 'failed') {
        try {
          await this.updateStore('failed')
        } catch (error) {
          this.redirectGuardUser()
        }
      }
    },
    redirectGuardUser() {
      localStorage.removeItem(authConfig.storageTokenKeyName)
      this.$router.push({ name: 'login' })
    },
    async updateStore(status) {
      try {
        const { data: { documents } } = await this.getDocumentsRequest(status)
        this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
        if (status === 'all' || status === 'draft') {
          this.$store.commit('transactions/SET_CURRENT_TRANSACTION', {})
        }
      } catch {
        return false
      }
      return true
    },
    getDocumentsRequest(status) {
      return EntityApi.entityDocuments(this.currentEntity.id, status)
    },

    async getFoldersViaEntity() {
      try {
        const { data: { contacts } } = await EntityApi.entityContactsFolder(this.currentEntity.id)
        this.contacts = contacts
      } catch (error) {
        localStorage.removeItem(authConfig.storageTokenKeyName)
        console.log(error)
      }
    },

    async getEntityDraftDocuments() {
      try {
        const { data: { documents } } = await EntityApi.entityDocuments(this.currentEntity.id, 'draft')
        this.documents = documents
        // this.$store.commit('transactions/UPDATE_UPLOADED_DOCUMENTS', documents)
        this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
        this.activeDocument = { ...documents[0] }
      } catch (error) {
        console.log(error)
      }
    },
  },
}
