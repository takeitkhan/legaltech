<template>
  <!-- //folder files list  -->
  <div class="filelist-container">
    <!-- folder file list header  -->
    <div class="file-type-nav d-flex px-1 py-2">
      <FileTypeNav
        name="All"
        @updateActive="setActiveNav"
      />
      <FileTypeNav
        name="Processing"
        @updateActive="setActiveNav"
      />
      <FileTypeNav
        name="Review"
        @updateActive="setActiveNav"
      />
      <FileTypeNav
        name="Approved"
        @updateActive="setActiveNav"
      />
      <FileTypeNav
        name="Failed"
        @updateActive="setActiveNav"
      />
      <FileTypeNav
        name="Select"
        @updateActive="setActiveNav"
      />
    </div>
    <!-- end of folder file list header  -->
    <div class="folder_file_list bg-white">
      <div
        class="folder-file-header  px-2 d-flex justify-content-between"
        style="padding:5px"
      >
        <p class="d-flex justify-content-center align-items-center">
          <mdicon
            size="20"
            style="color:#6259CF!important"
            name="file-document-multiple-outline"
          />
          <span style="color:#6259CF;margin-left:10px;font-weight:900;">Docs</span>
        </p>
        <p>
          <span class="mr-1">Sort By</span>
          <select
            id="sort_by"
            name="sort_by"
          >
            <option value="bill_date">
              Bill Date
            </option>
            <option value="due_date">
              Due Date
            </option>
            <option value="upload_date">
              Upload Date
            </option>
            <option value="amount">
              Amount
            </option>
          </select>
        </p>
      </div>

      <!-- //upload and file selection button  -->
      <div
        v-if="activeDocumentStatusNav === 'Select'"
        class="for-select-transaction_button d-flex flex-column align-items-center justify-content-center"
      >
        <button
          v-if="!markSelectedDocuments || selectedDocumentIds.length === 0"
          class="btn-nav_bar py-1"
          style="margin:5px;font-size:0.8rem"
          @click="$emit('getSelectedDocuments')"
          v-text="`Mark as single transaction`"
        />
        <button
          v-else-if="markSelectedDocuments && selectedDocumentIds.length"
          class="btn py-1 btn-success"
          style="margin:5px;font-size:0.8rem"
          @click="UnmarkedSelectedDocuments"
          v-text="`Marked`"
        />
      </div>
      <div
        v-else
        class="for-upload_button d-flex flex-column align-items-center justify-content-center"
      >
        <button
          style="text-align:center;padding-top:0.6rem;padding-bottom:0.6rem; margin:5px;font-size:0.8rem"
          class="btn-nav_bar active_btn_nav_bar px-1"
          @click="showModal=true"
        >
          <mdicon
            size="16"
            class="font-weight-bold"
            name="file-document"
          />
          <span style="letter-spacing:0.5px;">Upload Document</span>
        </button>

      </div>
      <!-- //end of upload and file selection button  -->

      <!-- files list  -->
      <div class="files mb-1">
        <!-- single file  -->
        <SingleFile
          v-for="(document,index) in documents"
          :key="index"
          :document="document"
        />
      <!-- end of single file  -->
      </div>
      <!-- end of files list  -->

      <Modal
        v-if="showModal"
        buttontext="Close"
        @closeModal="showModal=false,getDraftDocuments()"
      >
        <template v-slot:header>
          Upload Files (jpg,png,pdf,jpeg) only
        </template>
        <template v-slot:content>
          <vue-dropzone
            id="dropzone"
            ref="myVueDropzone"
            name="document"
            :use-custom-slot="true"
            :options="dropzoneOptions"
            @vdropzone-files-added="getFiles"
            @vdropzone-sending="sendingEvent"
          >
            <div class="dropzone-custom-content">
              <h3 class="dropzone-custom-title">
                Drag and drop to upload content!
              </h3>
              <div class="subtitle">
                ...or click to select a file from your computer
              </div>
            </div>
          </vue-dropzone>
        </template>
      </Modal>
    </div>
  </div>

  <!-- end of folder files list  -->
</template>

<script>
import Modal from '@/components/global/Modal.vue'
import vue2Dropzone from 'vue2-dropzone'
import apiConfig from '@/api/apiConfig'
import authConfig from '@/api/auth/authConfig'
import entityConfig from '@/api/entity/entityConfig'
import FileTypeNav from '@/components/draftInvoice/FileTypeNav.vue'
import EntityApi from '@/api/entity/EntityApi'
import { mapState } from 'vuex'
import SingleFile from './SingleFile.vue'

export default {
  components: {
    SingleFile, Modal, vueDropzone: vue2Dropzone, FileTypeNav,
  },

  data() {
    return {
      dropzoneOptions: {
        url: `${apiConfig.baseURL}/${entityConfig.uploadDocmentEndPoint}`,
        thumbnailWidth: 150,
        maxFilesize: 10240,
        // autoProcessQueue: false,
        headers: {
          'Access-Control-Allow-Origin': `${apiConfig.baseURL}`,
          'X-Requested-With': 'XMLHttpRequest',
          'Access-Control-Allow-credentials': false,
          Authorization: `${authConfig.tokenType} ${localStorage.getItem(authConfig.storageTokenKeyName)}`,
        },
        acceptedFiles: '.jpg, .jpeg, .png',
        maxFiles: 30,
        addRemoveLinks: true,
        // uploadMultiple: true,
        // autoProcessQueue: false,
      },
      documents: [],
      showModal: false,
    }
  },
  computed: {
    ...mapState(['currentEntity']),
    ...mapState('transactions', {
      currentTransaction: state => state.currentTransaction,
      ContactsOrUploadDocs: state => state.ContactsOrUploadDocs,
      documentList: state => state.documentList,
      selectedDocumentIds: state => state.selectedDocumentIds,
      markSelectedDocuments: state => state.markSelectedDocuments,
      activeDocumentStatusNav: state => state.activeDocumentStatusNav,
    }),
  },
  watch: {
    activeDocumentStatusNav() {
      this.getDocuments()
    },
    currentEntity() {
      this.getDocuments()
    },
    async selectedDocumentIds() {
      if (this.selectedDocumentIds.length === 0) {
        this.$store.commit('transactions/UPDATE_MARKSelectedDocuments', false)
      }
    },
    ContactsOrUploadDocs(newVal) {
      if (newVal === 'upload') {
        this.getDocumentViaUploadOrContact('draft')
      } else if (newVal === 'contacts') {
        this.getDocumentViaUploadOrContact('all')
      }
    },
    currentTransaction(newVal) {
      if (newVal !== null && Object.keys(newVal).length > 0) {
        this.getDocumentsViaTransaction()
      }
    },
    // when ever document list is updated then set 0 index element as current document
    documentList(newVal) {
      if (Array.isArray(newVal)) {
        this.documents = newVal
        this.$store.commit('transactions/SET_CURRENT_DOCUMENT', this.documentList[0])
      }
    },
  },

  mounted() {
    this.$nextTick(() => {
      this.getDocuments()
    })
  },
  methods: {
    UnmarkedSelectedDocuments() {
      this.$store.commit('transactions/UPDATE_MARKSelectedDocuments', false)
    },
    getFiles(files) {
      console.log(files)
    },
    sendingEvent(file, xhr, formData) {
      formData.append('entity_id', this.currentEntity.id)
    },
    setActiveNav(name) {
      this.$store.commit('transactions/UPDATE_ACTIVE_DOCUMENT_STATUS_NAV', name)
    },
    async getDocuments() {
      this.documents = []
      this.$store.commit('UPDATE_IS_LOADER', true)
      if (this.activeDocumentStatusNav.toLowerCase() === 'select') {
        try {
          const { data: { documents } } = await this.getDocumentsRequest('draft')
          this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
          // for updated uploads documents
          this.$store.commit('transactions/UPDATE_UPLOADED_DOCUMENTS', documents)
          this.$store.commit('transactions/SET_CURRENT_TRANSACTION', {})
        } catch (error) {
          console.log(error)
        }
      } else if (this.activeDocumentStatusNav.toLowerCase() === 'processing') {
        try {
          const { data: { documents } } = await this.getDocumentsRequest('draft')
          this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
          // for updated uploads documents
          this.$store.commit('transactions/UPDATE_UPLOADED_DOCUMENTS', documents)// for showing in upload folder and select and processing list
          this.$store.commit('transactions/SET_CURRENT_TRANSACTION', {})
        } catch (error) {
          console.log(error)
        }
      } else if (this.activeDocumentStatusNav.toLowerCase() === 'all') {
        try {
          const { data: { documents } } = await this.getDocumentsRequest('all')
          this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
          this.$store.commit('transactions/SET_CURRENT_TRANSACTION', {})
        } catch (error) {
          console.log(error)
        }
      } else if (this.activeDocumentStatusNav.toLowerCase() === 'review') {
        try {
          if (Object.keys(this.currentTransaction).length > 0) {
            this.getDocumentsViaTransaction()
          } else {
            const { data: { documents } } = await this.getDocumentsRequest('review')
            this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
          }
        } catch (error) {
          console.log(error)
        }
      } else if (this.activeDocumentStatusNav.toLowerCase() === 'approved') {
        try {
          if (Object.keys(this.currentTransaction).length > 0) {
            this.getDocumentsViaTransaction()
          } else {
            const { data: { documents } } = await this.getDocumentsRequest('approved')
            this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
          }
        } catch (error) {
          console.log(error)
        }
      } else if (this.activeDocumentStatusNav.toLowerCase() === 'failed') {
        try {
          const { data: { documents } } = await this.getDocumentsRequest('trashed')
          this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
        } catch (error) {
          console.log(error)
        }
      }
      this.$store.commit('UPDATE_IS_LOADER', false)
    },
    getDocumentsRequest(status) {
      return EntityApi.entityDocuments(this.currentEntity.id, status)
    },
    async getDocumentViaUploadOrContact(status) {
      if (this.ContactsOrUploadDocs === 'upload' && status === 'draft') {
        this.$store.commit('transactions/UPDATE_ACTIVE_DOCUMENT_STATUS_NAV', 'Processing')
        this.$store.commit('transactions/SET_CURRENT_TRANSACTION', {})
        try {
          const { data: { documents } } = await EntityApi.entityDocuments(this.currentEntity.id, status)
          this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
        } catch (error) {
          console.log(error)
        }
      } else if (this.ContactsOrUploadDocs === 'contacts' && status === 'all') {
        try {
          this.$store.commit('transactions/UPDATE_ACTIVE_DOCUMENT_STATUS_NAV', 'All')

          this.$store.commit('transactions/SET_CURRENT_TRANSACTION', {})
          const { data: { documents } } = await EntityApi.entityDocuments(this.currentEntity.id, 'all')
          this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
        } catch (error) {
          console.log(error)
        }
      }
    },

    async getDocumentsViaTransaction() {
      try {
        if (this.activeDocumentStatusNav === 'Review') {
          const { data: { documents } } = await EntityApi.entityDocumentViaTransaction(this.currentEntity.id, this.currentTransaction.id, 'review')
          // this.$store.commit('transactions/UPDATE_ACTIVE_DOCUMENT_STATUS_NAV', 'Review')
          this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
        }
        if (this.activeDocumentStatusNav === 'Approved') {
          const { data: { documents } } = await EntityApi.entityDocumentViaTransaction(this.currentEntity.id, this.currentTransaction.id, 'approved')
          // this.documents = documents
          // this.$store.commit('transactions/UPDATE_ACTIVE_DOCUMENT_STATUS_NAV', 'Approved')
          // this.activeNav = 'Approved'
          this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
        }
        if (this.activeDocumentStatusNav === 'Failed') {
          const { data: { documents } } = await EntityApi.entityDocumentViaTransaction(this.currentEntity.id, this.currentTransaction.id, 'approved')
          // this.documents = documents
          // this.$store.commit('transactions/UPDATE_ACTIVE_DOCUMENT_STATUS_NAV', 'Failed')
          this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
        }
      } catch (error) {
        console.log(error)
      }
    },

    async getDraftDocuments() {
      try {
        const { data: { documents } } = await this.getDocumentsRequest('draft')
        this.$store.commit('transactions/UPDATE_DOCUMENT_LIST', documents)
        // for updated uploads documents
        this.$store.commit('transactions/UPDATE_UPLOADED_DOCUMENTS', documents)// for showing in upload folder and select and processing list
        this.$store.commit('transactions/SET_CURRENT_TRANSACTION', {})
      } catch (error) {
        console.log(error)
      }
      await this.getDocuments()
    },
  },
}
</script>

<style scoped>
.filelist-container{
  width:27%;
}
 .folder_file_list{
    /* width:500px; */
    /* width:30%; */
    height:calc(100vh - 82px - 65px - 70px);
    overflow-y:hidden;
}
.files{
  height:100%;
  overflow-y:auto;
}
.btn-nav_bar,.active_btn_nav_bar{
    margin-right:8px;
    border:1px solid #6259CF !important;
    padding:0.3rem 0.8rem;
    border-radius: 0.3rem;
    color:#6259CF;
    background:#fff;
    font-weight:500;
    text-transform: capitalize;
    font-size:0.9rem;
}
.active_btn_nav_bar{
  background:#6259CF;
  color:#fff;
  border:1px solid #6259CF !important;
}
.btn-approve{
    background:#2f92e9;
    color:#fff;
}

.file-type-nav{
    background:#F3F8FB;
    padding:0.4rem;
}
.warning-icon{
    color:#E59118;
}

#sort_by{
  border:1px solid #D1D5DB;
  padding:5px;
  border-radius: 5px;
  outline:none;
}

/* for drop zone  */
.dropzone-custom-content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

.dropzone-custom-title {
  margin-top: 0;
  color: #00b782;
}

.subtitle {
  color: #314b5f;
}
</style>
