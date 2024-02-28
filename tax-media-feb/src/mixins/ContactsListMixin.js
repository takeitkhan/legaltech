import authConfig from '@/api/auth/authConfig'
import EntityApi from '@/api/entity/EntityApi'

export default {
  methods: {
    async getFoldersViaEntity() {
      try {
        const { data: { contacts } } = await EntityApi.entityContactsFolder(this.currentEntity.id)
        this.$store.commit('transactions/UPDATE_CONTACTS', contacts)
        // this.$store.commit('transactions/UPDATE_ACTIVE_DOCUMENT_STATUS_NAV', 'Approved')
      } catch (error) {
        if (error?.response?.status === 401) {
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
