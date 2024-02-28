<template>
  <div
    class="single-file d-flex justify-content-between align-items-center px-4 py-2"
    :class="[isDocumentCurrent(document.id)?'active_nav':'']"
    @click="CheckedCheckBox(),showDocumentInFileContainer()"
  >
    <div
      v-if="activeDocumentStatusNav === 'Select'"
      class="form-check form-check-success"
    >
      <div class="custom-control-success custom-control custom-checkbox">
        <input
          type="checkbox"
          class="custom-control-input"
          :checked="activeDocumentStatusNav === 'Select' && (isChecked || documentIdExist(document.id) )"
        ><label
          class="custom-control-label"
        />
      </div>
    </div>
    <!-- end of for testing  -->

    <div class="single-file-left d-flex justify-content-center align-items-center">
      <img
        :src="document.file_as_image"
        width="50"
        height="50"
        alt=""
        class="mr-2"
      >
      <div class="single-file-details pt-2">
        <p class="text-lg capitalize">
          {{ document.name }}
        </p>
        <p class="text-sm">
          Date: <span>{{ formatDate(document.created_at) }}</span>
        </p>
      </div>
      <p @click="trashDocument">
        <mdicon
          v-if="document.status == 'failed' || document.status === 'draft'"
          size="20"
          class="font-weight-bold trash-icon mt-1 mb-2 ml-4 text-danger"
          name="trash-can-outline"
        />
      </p>
    </div>
    <p
      v-if="document.status == 'failed' || document.status == 'trashed'"
    >
      <mdicon
        class="text-danger"
        name="block-helper"
      />
    </p>
    <p v-else-if="document.status === 'review'">
      <mdicon
        class="text-primary"
        name="printer-search"
      />
    </p>
    <p v-else-if="document.status === 'approved'">
      <mdicon
        class="text-success"
        name="check-bold"
      />
    </p>
    <p v-else-if="document.status == 'draft'">
      <mdicon
        class="text-warning"
        name="cached"
      />
    </p>

    <!-- <p>
      <mdicon
        class="text-rose-500"
        name="block-helper"
      />
    </p> -->
  </div>
</template>

<script>
import { mapState } from 'vuex'
import { format } from 'date-fns'
import EntityApi from '@/api/entity/EntityApi'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
import EntityDocuments from '@/mixins/EntityDocuments'

export default {
  name: 'SingleFile',
  mixins: [EntityDocuments],
  props: ['document'],
  data() {
    return {
      isChecked: false,
    }
  },
  computed: {
    ...mapState('transactions', {
      selectedDocumentIds: state => state.selectedDocumentIds,
      currentDocument: state => state.currentDocument,
      activeDocumentStatusNav: state => state.activeDocumentStatusNav,
      currentTransaction: state => state.currentTransaction,
      contacts: state => state.contacts,
    }),
    ...mapState(['currentEntity']),
    documentIdExist() {
      return id => {
        if (this.selectedDocumentIds.find(item => item === id)) {
          this.isChecked = true
          return true
        }
        return false
      }
    },
    isDocumentCurrent() {
      return documentId => this.currentDocument?.id === documentId
    },
    formatDate() {
      return date => format(new Date(date), 'yyyy-MM-dd')
    },
  },
  watch: {
    // if no selected items for transactions then reset checked to false
    selectedDocumentIds(newVal) {
      if (newVal.length === 0) {
        this.documentIdExist(0)
      }
    },
  },
  methods: {
    CheckedCheckBox() {
      if (this.activeDocumentStatusNav === 'Select') {
        this.isChecked = !this.isChecked
        // add documents to array for taransaction if isChecked is true
        if (this.isChecked) {
          this.$store.commit('transactions/SET_SELECTED_DOCUMENTIDS', this.document.id)
        } else {
          this.$store.commit('transactions/POP_SELECTED_DOCUMENTIDS', this.document.id)
        }
      }
    },
    showDocumentInFileContainer() {
      if (this.activeDocumentStatusNav === 'Select') {
        this.$store.commit('transactions/SET_CURRENT_DOCUMENT', this.document)
      }
      if (this.activeDocumentStatusNav !== 'Select') {
        this.$store.commit('transactions/SET_CURRENT_DOCUMENT', this.document)

        // set document transaction in form if document status is review or approved or failed
        // or may filed in future
        if (this.document?.status === 'review' || this.document?.status === 'approved' || this.document?.status === 'failed') {
          const findTransaction = this.document?.transaction
          if (findTransaction) {
            this.$store.commit('transactions/SET_CURRENT_TRANSACTION', findTransaction)
            const contact = this.contacts.find(cont => cont.id === findTransaction.contact_id)

            if (contact) {
              this.$store.commit('transactions/UPDATE_IS_OPEN_FOLDER', true)
              this.$store.commit('transactions/UPDATE_IS_SINGLE_FOLDER_NAV', true)
              this.$store.commit('transactions/UPDATE_ACTIVE_CONTACT', contact?.name)
            }
          }
        } else {
          this.$store.commit('transactions/SET_CURRENT_TRANSACTION', {})
          this.$store.commit('transactions/UPDATE_ACTIVE_CONTACT', {})
          this.$store.commit('transactions/UPDATE_IS_OPEN_FOLDER', true)
          this.$store.commit('transactions/UPDATE_IS_SINGLE_FOLDER_NAV', true)
        }
      }
    },
    async trashDocument() {
      try {
        const { isDenied } = await this.$swal.fire({
          title: 'Are your sure? you want to Trash this Document',
          showDenyButton: true,
          showCancelButton: false,
          confirmButtonText: 'Delete',
          denyButtonText: 'Cancel',
        })
        if (isDenied) {
          return
        }
        const { data: { success } } = await EntityApi.trashDocument(this.currentEntity?.id, this.document.id)
        this.$toast({
          component: ToastificationContent,
          props: {
            title: success,
            icon: 'EditIcon',
            variant: 'success',
          },
        })
        if (this.activeDocumentStatusNav === 'Processing') {
          await this.getEntityDocumentsViaStatus('draft')// defined in mixins
        } else if (this.activeDocumentStatusNav === 'Review') {
          await this.getEntityDocumentsViaStatus('review')// defined in mixins
        } else if (this.activeDocumentStatusNav === 'Approved') {
          await this.getEntityDocumentsViaStatus('approved')// defined in mixins
        } else if (this.activeDocumentStatusNav === 'Failed') {
          await this.getEntityDocumentsViaStatus('failed')// defined in mixins
        }
        await this.getEntityDocumentsViaStatus('trashed')
        // await this.getDocumentsViaTransaction('trashed')
      } catch (error) {
        console.log(error.response)
        if (error?.response?.status === 404) {
          this.$toast({
            component: ToastificationContent,
            props: {
              title: error?.response?.data?.error,
              icon: 'XCircleIcon',
              variant: 'danger',
            },
          })
        }
        if (error?.response?.status === 500) {
          this.$toast({
            component: ToastificationContent,
            props: {
              title: error?.response?.data?.error,
              icon: 'XCircleIcon',
              variant: 'danger',
            },
          })
        }
      }
    },
  },
}
</script>

<style scoped>
.single-file{
    cursor:pointer;
}

.single-file:hover{
  color:#6259CF;
  background:#F4F7FE
}

.trash-icon{
  display:none;
  position:relative !important;
  z-index:100 !important;
}
.single-file:hover .trash-icon{
  display:block;
    position:relative !important;
  z-index:100 !important;
}
.active_nav{
   color:#6259CF;
  background:#F4F7FE
}
</style>
