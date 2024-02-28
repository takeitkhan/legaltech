export default {
  namespaced: true,
  state: {
    documentList: [],
    currentDocument: {},
    currentTransaction: {},
    // this is for showing files according to clicking on upload or contacts of the current entity
    ContactsOrUploadDocs: '',
    selectedDocumentIds: [],
    markSelectedDocuments: false,
    activeDocumentStatusNav: 'All',
    uploadedDocuments: [], // uloaded documents whose will show in upload folder
    contacts: [], /// this contacts are showing in contacts folder list
    trashList: [],
    isOpenFolderNav: false, // for contacts folder nav
    isUploadFolderNav: false, // for upload folder nav
    activeContact: {}, // for active contacts in folder sections
    isOpenSingleFolder: false, // for single folder nav
  },
  getters: {
    GET_CURRENT_TRANSACTION(state) {
      return state.currentTransaction
    },
    GET_CURRENT_DOCUMENT(state) {
      return state.currentDocument
    },
    errorGetter() {
      throw new Error('Error from transaction getters')
    },
  },
  mutations: {
    UPDATE_DOCUMENT_LIST(state, documents) {
      state.documentList = documents
    },
    SET_CURRENT_TRANSACTION(state, transaction) {
      state.currentTransaction = transaction
    },
    SET_CONTACT_OR_UPLOAD_DOCS(state, payload) {
      state.ContactsOrUploadDocs = payload
    },
    SET_CURRENT_DOCUMENT(state, document) {
      state.currentDocument = document
    },
    SET_SELECTED_DOCUMENTIDS(state, documentId) {
      state.selectedDocumentIds.push(documentId)
    },
    UPDATE_SELECTED_DOCUMENTIDS(state, documents) {
      state.selectedDocumentIds = [...documents]
    },
    POP_SELECTED_DOCUMENTIDS(state, documentId) {
      const itemIndex = state.selectedDocumentIds.findIndex(item => item === documentId)
      if (itemIndex > -1) {
        state.selectedDocumentIds.splice(itemIndex, 1)
      }
    },
    UPDATE_UPLOADED_DOCUMENTS(state, documents) {
      state.uploadedDocuments = documents
    },
    POP_UPLOADED_DOCUMENTS(state, documentIds) {
      if (documentIds.length > 0) {
        state.uploadedDocuments = state.uploadedDocuments.filter(document => !documentIds.includes(document.id))
        console.log(state.uploadedDocuments, documentIds, 'from vuex')
      }
    },
    UPDATE_MARKSelectedDocuments(state, bool) {
      state.markSelectedDocuments = bool
    },
    UPDATE_ACTIVE_DOCUMENT_STATUS_NAV(state, activeNav) {
      state.activeDocumentStatusNav = activeNav
    },
    UPDATE_CONTACTS(state, contacts) {
      state.contacts = contacts
    },
    UPDATE_TRASHLIST(state, trashList) {
      state.trashList = trashList
    },
    // FOR FOLDER LIST TAB
    UPDATE_IS_OPEN_FOLDER(state, payload) {
      state.isOpenFolderNav = payload
    },
    UPDATE_IS_UPLOAD_FOLDER(state, payload) {
      state.isUploadFolderNav = payload
    },
    UPDATE_ACTIVE_CONTACT(state, payload) {
      state.activeContact = payload
    },
    UPDATE_IS_SINGLE_FOLDER_NAV(state, payload) {
      state.isOpenSingleFolder = payload
    },

  },
  actions: {},
}
