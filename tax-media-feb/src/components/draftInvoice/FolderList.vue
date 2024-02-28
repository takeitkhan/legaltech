<template>

  <section class="folder-list-section">
    <!-- folder list nav  -->
    <div class="folder_list_nav">
      <div
        class="folder-headers px-2 pt-2 mb-2"
        style="padding-bottom:0.3rem;"
      >
        <div class="folder-headers-single">
          <!-- v-if="typeof datepicker === 'string' " -->
          <p v-if="Array.isArray(datepicker)">
            <strong>
              {{ `${formatter(datepicker[0],'yyyy-mm-dd')} to ${formatter(datepicker[1],'yyyy-mm-dd')}` }}
            </strong>
          </p>
          <p v-else>
            {{ datepicker }}
          </p>
          <div
            class="d-flex justify-content-center align-items-center py-1"
            style="margin-top:-1rem;"
          >
            <date-picker
              v-model="datepicker"
              type="date"
              format="YYYY-MM-DD"
              value-type="date"
              range
            />
            <!-- :format="format" -->
            <div class="filtered-entries ml-1">
              <select
                v-model="datepicker"
                class="form-control"
                style="width:100%;min-width:250px;"
              >
                <option
                  disabled
                  value=""
                >
                  None
                </option>
                <option
                  v-for="(custom,key) in customSelectOption"
                  :key="key"
                  :value="custom.format"
                >
                  {{ custom.text }}
                </option>
              </select>
            </div>
            <button
              class="ml-1 btn btn-primary px-1"
              style="padding-top:0.8rem; padding-bottom:0.8rem;border:none !important;"
            >
              Filter
            </button>
          </div>
        </div>

      </div>
      <div
        class="folder-header d-flex justify-content-between align-items-center"
        style="background:#F4F7FE;padding:12px 10px !important"
      >
        <div class="d-flex justify-content-between align-items-center ">

          <h6 class="text-sm font-weight-bold">
            <mdicon
              size="25"
              class="font-weight-bold  mr-1 folder-color"
              name="file-document-multiple"
            />
            All Documents
          </h6>

        </div>
      </div>
      <!-- contacts folder list  -->
      <div class="folder-list">
        <!-- single folder  -->
        <div class="single-folder">
          <div
            class="single-folder-header d-flex  cursor-pointer pt-1 px-1"
            @click="openUploadFolderList"
          >
            <h5 class="d-flex ">
              <!-- for menud-down or menu right icon  -->
              <mdicon
                v-if="isUploadFolderNav"
                size="20"
                class="text-gray-400 font-bold"
                name="menu-down"
              />
              <mdicon
                v-else
                size="20"
                class="text-gray-400 font-bold"
                name="menu-right"
              />
              <!-- end  for menud-down or menu right icon  -->
              <!-- for folder open and folder-outline  -->
              <mdicon
                v-if="isUploadFolderNav"
                size="20"
                class="folder-color font-bold"
                name="folder-open"
              />
              <mdicon
                v-else
                size="20"
                class="folder-color font-bold"
                name="folder"
              />
              <!-- for folder open and folder-outline  -->
              <span
                class="text-md capitalize"
                style="margin-left:5px;"
              >Uploads ({{ totalUploadedDocuments }})</span>
            </h5>

          </div>
          <div
            v-if="isUploadFolderNav"
            class="ml-1 single-folder-content-list"
            style="margin-top:-10px;"
          >
            <SingleUploadDocument
              v-for="document in uploadedDocuments"
              :key="document.id"
              :document="document"
            />
          </div>
        </div>
        <!-- end of single folder  -->
      </div>
      <!-- end of uploader list  -->

      <!-- contacts folder list  -->
      <div class="folder-list">
        <!-- single folder  -->
        <div class="single-folder">
          <div
            class="single-folder-header d-flex  cursor-pointer pt-1 px-1"
            @click="openFolderList"
          >
            <h5 class="d-flex ">
              <!-- for menud-down or menu right icon  -->
              <mdicon
                v-if="isOpenFolderNav"
                size="20"
                class="text-gray-400 font-bold"
                name="menu-down"
              />
              <mdicon
                v-else
                size="20"
                class="text-gray-400 font-bold"
                name="menu-right"
              />
              <!-- end  for menu-down or menu right icon  -->

              <!-- for folder open and folder-outline  -->
              <mdicon
                v-if="isOpenFolderNav"
                size="20"
                class="folder-color font-bold"
                name="folder-open"
              />
              <mdicon
                v-else
                size="20"
                class="folder-color font-bold"
                name="folder"
              />
              <!-- for folder open and folder-outline  -->
              <span
                class="text-md capitalize"
                style="margin-left:5px;"
                v-text="`Contacts (${totalTransactionsOfEntity})`"
              />
            </h5>

          </div>
          <div
            v-if="isOpenFolderNav"
            class="ml-1 single-folder-content-list"
            style="margin-top:-10px;"
          >
            <SingleFolder
              v-for="contact in contacts"
              :key="contact.id"
              :contact="contact"
            />
          </div>
        </div>
        <!-- end of single folder  -->
      </div>
      <!-- end of contacts list  -->

      <div class="trash-list cursor-pointer pt-1 px-1">
        <div

          class="trash-list-header"
          @click="isTrashFolderOpen=!isTrashFolderOpen"
        >
          <mdicon
            size="20"
            class="text-gray-400 font-bold text-danger"
            name="trash-can-outline"
          />
          <span>Trash ({{ trashLength }})</span>
        </div>
        <div class="single-folder">
          <div
            v-if="isTrashFolderOpen"
            class="single-folder-content-list"
          >

            <SingleUploadDocument
              v-for="document in trashList"
              :key="document.id"
              :document="document"
            />
            <!-- :active="activeDocument" -->
          <!-- @showActiveFolder="setUploadDocument" -->

            <!-- @showActiveFolder="setUploadDocument" -->
            <!-- @showfiles="showFilesInFileList" -->
          </div>
        </div>
      </div>
    </div>
    <!-- end of folder list nav  -->
  </section>

</template>

<script>
import { ref } from '@vue/composition-api'
import { format } from 'date-fns'
import getQuarterMonth from '@/composition/helpers/getQuarterMonth'
import getFinancialYear from '@/composition/helpers/getFinancialYear'
import { mapState } from 'vuex'
import ContactsListMixin from '@/mixins/ContactsListMixin'
import EntityDocuments from '@/mixins/EntityDocuments'
import SingleFolder from './SingleFolder.vue'
import SingleUploadDocument from './SingleUploadDocument.vue'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
  components: {
    SingleFolder,
    SingleUploadDocument,
  },
  mixins: [ContactsListMixin, EntityDocuments],
  data() {
    return {
      isUploadFolder: false,
      isTrashFolderOpen: false,
      datepicker: '',
      format: 'YYYY-MM-DD',
    }
  },
  computed: {
    ...mapState(['currentEntity']),
    ...mapState('transactions', {
      uploadedDocuments: state => state.uploadedDocuments,
      contacts: state => state.contacts,
      trashList: state => state.trashList,
      isOpenFolderNav: state => state.isOpenFolderNav,
      isUploadFolderNav: state => state.isUploadFolderNav,
      activeContact: state => state.activeContact,
    }),
    totalTransactionsOfEntity() {
      return this.contacts?.reduce((t, cont) => t + cont?.transactions?.length || 0, 0)
    },
    totalUploadedDocuments() {
      return this.uploadedDocuments.length
    },
    formatter() {
      return (date, dateformat) => format(new Date(date), dateformat)
    },
    trashLength() {
      return this.trashList?.length
    },
  },
  setup() {
    // methods
    function getLastMonth(date) {
      let lastMonth = date.getMonth() - 1
      let year = date.getFullYear()
      if (lastMonth < 0) {
        lastMonth = 11
        year = date.getFullYear() - 1
      }
      return format(new Date(year, lastMonth), 'MMM yyyy')
    }
    const customSelectOption = ref({
      this_month: { format: format(new Date(), 'MMM yyyy'), text: 'This month' },
      this_quarter: { format: getQuarterMonth(new Date()), text: 'This quarter' },
      this_financial_year: { format: getFinancialYear(new Date()), text: 'This Financial Year' },
      last_month: { format: getLastMonth(new Date()), text: 'Last month' },
      last_quarter: { format: getQuarterMonth(new Date(), true), text: 'Last Quarter' },
      last_finalcial: { format: getFinancialYear(new Date(), true), text: 'Last Finalcial Year' },
    })
    const month = ref({
      month: (new Date()).getMonth(),
      year: (new Date()).getFullYear(),
    })
    const filteredDate = ref(new Date())
    const active = ref({ active: null })

    return {
      month,
      customSelectOption,
      active,
      filteredDate,
      // showFilesInFileList,
      // activeFolder,
    }
  },

  watch: {
    currentEntity() {
      this.getFoldersViaEntity()
      this.getEntityDraftDocuments()
      this.getEntityDocumentsViaStatus('trashed')
    },
    datepicker(newVal) {
      console.log(typeof newVal)
    },
    // trashList() {
    //   this.getEntityDocumentsViaStatus('trashed')
    // },
  },
  async mounted() {
    this.$store.commit('UPDATE_IS_LOADER', true)
    await this.getFoldersViaEntity() // defined in contactslist mixins
    await this.getEntityDraftDocuments()
    await this.getEntityDocumentsViaStatus('trashed')
    this.$store.commit('UPDATE_IS_LOADER', false)
  },

  methods: {
    openFolderList() {
      // this.isUploadFolder = false
      this.$store.commit('transactions/UPDATE_IS_OPEN_FOLDER', !this.isOpenFolderNav)
      this.$store.commit('transactions/SET_CONTACT_OR_UPLOAD_DOCS', 'contacts')
    },
    openUploadFolderList() {
      // this.isUploadFolder = !this.isUploadFolder
      this.$store.commit('transactions/UPDATE_IS_UPLOAD_FOLDER', !this.isUploadFolderNav)
      // this.isOpenFolder = false
      this.$store.commit('transactions/SET_CURRENT_TRANSACTION', {})
      this.$store.commit('transactions/SET_CONTACT_OR_UPLOAD_DOCS', 'upload')
    },
    selectMonth(event) {
      console.log(event)
    },
    setActiveFolder(activeContact) {
      this.active.active = activeContact
    },

  },

}
</script>

<style scoped>
.folder-list-section{
  width:24%;
}
.folder_list_nav{
    height:calc(100vh - 82px - 65px);
    overflow-y:auto;
    border-right:1px solid #F4F7FC;
    box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
    background:#fff;
}
.folder-headers{
  background:#F3F8FB;
}
.btn{
    border:1px solid #85C7FF !important;
    padding:0.2rem 0.5rem;
    border-radius: 0.2rem;
    color:#2f92e9;
    font-weight:600;

}
.file-type-nav{
    /* background:#D1D5DB; */
    background:#F3F8FB;
    padding:0.4rem;
}

.btn-nav,.active_btn_nav{
    border:1px solid #fff !important;
    padding:0 0.5em;
    border-radius: 0.2rem;
    /* color:#fff; */
    color:#000000;
    background:#fff;
    font-weight:500;
    text-transform: capitalize;
    font-size:0.9rem;
     clip-path: polygon(11% 0, 92% 0, 100% 100%, 0 99%);
}
.active_btn_nav{
  background:#D1D5DB;
  color:#000000;
  border:1px solid #D1D5DB !important;
}
.btn-approve{
    background:#2f92e9;
    color:#fff;
}

.single-file{
    cursor:pointer;
}

/* .folder_file_list{
    width:400px;
} */

/* .draft-expense-image{
    width:calc(100vw - 250px - 400px);
} */

/* clip-path: polygon(13% 0, 86% 0, 100% 100%, 0% 100%); */

/* file image details nav  */
.folder-modification-nav{
  background:#D1D5DB;
}

#month{
  width:100%;
  padding-top:6px;
  padding-bottom:6px;
  border:0.6px solid rgb(214, 212, 212,0.4);
  border-radius: 5px;
}

.warning-icon{
    color:#E59118;
}
.uploads_button{
  /* background:#9289F4; */
  color:#fff;
  border:none;
  margin-left:5px;
  padding:8px 20px;
  border-radius: 5px;
  letter-spacing: 0.1px;
  font-size:16px;
}
.folder-color{
  color:#7766FF;
}

.tags-list-header{
  background:#F3F6FD;
  padding:1rem 0.5rem;
}
</style>
