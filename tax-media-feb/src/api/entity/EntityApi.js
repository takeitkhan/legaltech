import Api from '../Api'
import entityConfig from './entityConfig'

export default {
  upload(form) {
    return Api().post(entityConfig.uploadDocmentEndPoint, form)
  },
  bankList() {
    return Api().get(entityConfig.bankListEndPoint)
  },
  entityList(form) {
    return Api().get(entityConfig.entitiesEndPoint, form)
  },
  entityDocuments(entityId, status) {
    return Api().get(`${entityConfig.entityDocumentsViaStatusEndPoint}/${entityId}/${status}`)
  },
  entityDocumentViaTransaction(entityId, transactionId, status) {
    return Api().get(`${entityConfig.entityDocumentsViaTransactionEndPoint}/${entityId}/${transactionId}/${status}`)
  },
  entityDocumentTypes() {
    return Api().get(`${entityConfig.entitydocumentTypesEndPoint}`)
  },
  entityContacts(entityId) {
    return Api().get(`${entityConfig.entityContactsEndPoint}/${entityId}`)
  },
  SdRates() {
    return Api().get(`${entityConfig.SDRatesEndPoint}`)
  },
  ATRates() {
    return Api().get(`${entityConfig.ATRatesEndPoint}`)
  },
  TaxesRates() {
    return Api().get(`${entityConfig.TaxRatesEndPoint}`)
  },
  entityProducts(entityId) {
    return Api().get(`${entityConfig.entityProductsEndPoint}/${entityId}`)
  },
  entityUntrackingProducts(entityId) {
    return Api().get(`${entityConfig.entityUntrackingProductsEndPoint}/${entityId}`)
  },
  dictionaryProductViaHsCode(hsCode) {
    return Api().get(`${entityConfig.productViaHSCODE_EndPoint}/${hsCode}`)
  },
  entityEmployees(entityId) {
    return Api().get(`${entityConfig.entityEmployeesEndPoint}/${entityId}`)
  },
  entityContactsFolder(entityId) {
    return Api().get(`${entityConfig.getFoldersViaEntityEndPoint}/${entityId}`)
  },
  getTransactionTypes() {
    return Api().get(entityConfig.getTransactionTypesEndPoint)
  },
  getProductNatures() {
    return Api().get(entityConfig.getProductNaturesEndPoint)
  },

  newTransaction(form, entityId) {
    return Api().post(`${entityConfig.transactionEndPoint}/${entityId}`, form)
  },
  transactionDetails(entityId, transactionId) {
    return Api().get(`${entityConfig.transactionDetailsEndPoint}/${entityId}/${transactionId}`)
  },
  transactionUpdate(form, entityId, transactionId) {
    return Api().post(`${entityConfig.transactionUpdateEndPoint}/${entityId}/${transactionId}`, form)
  },
  transactionUpdateStatus(entityId, transactionId, status) {
    return Api().post(`${entityConfig.transactionUpdateStatusEndPoint}/${entityId}/${transactionId}/${status}`)
  },
  transactions(entityId) {
    return Api().get(`${entityConfig.transactionListEndPoint}/${entityId}`)
  },
  transactionsViaQuery(entityId, dateTimeQuery) {
    return Api().get(`${entityConfig.transactionsListViaDateTimeQueryEndPoint}/${entityId}/${dateTimeQuery}`)
  },
  transactionViaDocument(entityId, documentId) {
    return Api().get(`${entityConfig.transactionViaDocument}/${entityId}/${documentId}`)
  },
  getEntitySingleProduct(entityId, productId) {
    return Api().get(`${entityConfig.entitySingleProductEndPoint}/${entityId}/${productId}/product`)
  },
  getEntitySingleContact(entityId, contactId) {
    return Api().get(`${entityConfig.entitySingleContactEndPoint}/${entityId}/${contactId}`)
  },

  getSellsTransactionInDate(entityId, date) {
    return Api().get(`${entityConfig.getSellsTransactionsInDate}/${entityId}/${date}`)
  },
  getSellsTransactionInDateRange(entityId, fromDate, toDate) {
    return Api().get(`${entityConfig.getSellsTransactionsInDateRange}/${entityId}/${fromDate}/${toDate}`)
  },
  getPurchaseTransactionInDate(entityId, date) {
    return Api().get(`${entityConfig.getPurchaseTransactionsInDate}/${entityId}/${date}`)
  },
  getPurchaseTransactionInDateRange(entityId, fromDate, toDate) {
    return Api().get(`${entityConfig.getPurchaseTransactionsInDateRange}/${entityId}/${fromDate}/${toDate}`)
  },

  getLocalTransactionInDateRange(entityId, note, fromDate, toDate, transactionType) {
    return Api().get(`${entityConfig.getLocalTransactionInDateRange}/${entityId}/${note}/${fromDate}/${toDate}/${transactionType}`)
  },
  getLocalTransactionInDate(entityId, note, date, transactionType) {
    return Api().get(`${entityConfig.getLocalTransactionInDate}/${entityId}/${note}/${date}/${transactionType}`)
  },

  getImportTransactionInDateRange(entityId, note, fromDate, toDate, transactionType) {
    return Api().get(`${entityConfig.getImportTransactionInDateRange}/${entityId}/${note}/${fromDate}/${toDate}/${transactionType}`)
  },
  getImportTransactionInDate(entityId, note, date, transactionType) {
    return Api().get(`${entityConfig.getImportTransactionInDate}/${entityId}/${note}/${date}/${transactionType}`)
  },

  /// trash documents
  trashDocument(entityId, documentId) {
    return Api().post(`${entityConfig.trashDocumentEndPoint}/${entityId}/${documentId}`)
  },

  /// trash documents
  deleteDocument(entityId, documentId) {
    return Api().post(`${entityConfig.deleteDocumentEndPoint}/${entityId}/${documentId}`)
  },

  // start pdf section
  generatePDFUsingDateRange(entityId, fromDate, toDate) {
    return Api().get(`${entityConfig.generatePDFUsingDateRange}/${entityId}/${fromDate}/${toDate}`)
  },
  generatePDFUsingDate(entityId, date) {
    return Api().get(`${entityConfig.generatePDFUsingDateRange}/${entityId}/${date}`)
  }, // pdf section

  getTreasuryDepositsInDate(entityId, date) {
    return Api().get(`${entityConfig.getTreasuryDepositsInDateEndPoint}/${entityId}/${date}`)
  },
  getTreasuryDepositsInDateRange(entityId, fromDate, toDate) {
    return Api().get(`${entityConfig.getTreasuryDepositsInDateRangeEndPoint}/${entityId}/${fromDate}/${toDate}`)
  },
  getTreasuryDepositsInDateRangeViaDepositType(entityId, fromDate, toDate, depositType) {
    return Api().get(`${entityConfig.getTreasuryDepositsInDateRangeViaDepositTypeEndPoint}/${entityId}/${fromDate}/${toDate}/${depositType}`)
  },
  getTreasuryDepositsInDateViaDepositType(entityId, date, depositType) {
    return Api().get(`${entityConfig.getTreasuryDepositsInDateViaDepositTypeEndPoint}/${entityId}/${date}/${depositType}`)
  },

  getAdjustmentsViaDateRange(entityId, fromDate, toDate, adjustmentType) {
    return Api().get(`${entityConfig.getAdjustmentsViaDateRange}/${entityId}/${fromDate}/${toDate}/${adjustmentType}`)
  },
  getAdjustmentsInDate(entityId, date, adjustmentType) {
    return Api().get(`${entityConfig.getAdjustmentsInDate}/${entityId}/${date}/${adjustmentType}`)
  },

  // inventory
  registerProduct(entityId, form) {
    return Api().post(`${entityConfig.registerProductEndPoint}/${entityId}`, form)
  },

  transactionProducts(entityId, entityProductId) {
    return Api().get(`${entityConfig.transactionProductsViaEntityProductIdEndPoint}/${entityId}/${entityProductId}`)
  },

  getTransactionProductsViaProductIdInDate(entityId, productId, date) {
    return Api().get(`${entityConfig.getTransactionProductsViaProductIdInDateEndPoint}/${entityId}/${productId}/${date}`)
  },
  getTransactionProductsViaProductIdInDateRange(entityId, productId, fromDate, toDate) {
    return Api().get(`${entityConfig.getTransactionProductsViaProductIdInDateRangeEndPoint}/${entityId}/${productId}/${fromDate}/${toDate}`)
  },

}
