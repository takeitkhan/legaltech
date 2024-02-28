export default
{
  // all post endpoint
  uploadDocmentEndPoint: 'documents/upload',
  transactionEndPoint: 'transaction',
  transactionDetailsEndPoint: '/transaction/details',
  transactionUpdateEndPoint: '/transaction/update',
  transactionUpdateStatusEndPoint: '/transaction/update/status', // has param entity_id,transaction_id, status
  transactionListEndPoint: '/transactions', // has entity_id
  transactionsListViaDateTimeQueryEndPoint: '/transactions', // has entity_id,dateTimeQuery
  transactionViaDocument: '/transaction', // has param entity_id,document_id

  // all get request
  entitiesEndPoint: 'auth_user/entities',
  entityDocumentsViaStatusEndPoint: 'documents', // has params entity_id status
  entityDocumentsViaStatusAndTransactionEndPoint: 'documents', // has params entity_id status transaction_id
  entitydocumentTypesEndPoint: 'documentTypes',

  entityContactsEndPoint: 'get-contacts', // has params entity_id
  entitySingleContactEndPoint: '/entity/contacts/transactions', // has params entity_id,contact_id

  SDRatesEndPoint: 'sd_rates', // has params entity_id
  ATRatesEndPoint: 'at_rates', // has params entity_id
  TaxRatesEndPoint: 'tax_rates', // has params entity_id

  entityProductsEndPoint: 'entity_products', // has params entity_id
  entityUntrackingProductsEndPoint: 'entity_untracking_products', // has params entity_id
  entitySingleProductEndPoint: 'entity_products', // has params entity_id, product_id

  productViaHSCODE_EndPoint: 'product', // has params entity_id
  bankListEndPoint: 'banks', // has params entity_id
  entityDocumentsViaTransactionEndPoint: 'documents', // entity,transaction_id,status

  // inventory routes
  registerProductEndPoint: 'registerProduct', // has entity_id params
  transactionProductsViaEntityProductIdEndPoint: 'transactionProducts', // entity_id and entity_product_id column
  // end of inventory routes

  entityEmployeesEndPoint: 'entity/employees', // has params entity_id
  getFoldersViaEntityEndPoint: '/entity/contacts/transactions', // has params entity_id
  getTransactionTypesEndPoint: 'transactionTypes',
  getProductNaturesEndPoint: 'productNatures',

  // reportninepointone endpoint
  getSellsTransactionsInDate: 'sells_transactions', // has params entity_id,date
  getSellsTransactionsInDateRange: 'sells_transactions', // has params entity_id,from_date,to_date
  getPurchaseTransactionsInDate: 'purchase_transactions', // has params entity_id,from_date,to_date
  getPurchaseTransactionsInDateRange: 'purchase_transactions', // has params entity_id,from_date,to_date

  getLocalTransactionInDate: 'localTransactionDetails', // has params entity_id and note,transactionType,transactionCategory,date

  getLocalTransactionInDateRange: 'localTransactionDetails', // has params entity_id and note,transactionType,transactionCategory
  getImportTransactionInDateRange: 'importTransactionDetails', // has params entity_id and note,transactionCategory
  getImportTransactionInDate: 'importTransactionDetails', // has params entity_id and note,transactionCategory

  // report nine- point one pdf
  generatePDFUsingDateRange: '/report-nine-point-one/pdf',
  generatePDFUsingDate: '/report-nine-point-one/pdf',

  // report nine- point one excel
  generateExcelUsingDateRange: '/report-nine-point-one/excel',
  generateExcelUsingDate: '/report-nine-point-one/excel',

  // trash documents
  trashDocumentEndPoint: 'documents/trash/document',
  deleteDocumentEndPoint: 'documents/delete/document',

  getAdjustmentsViaDateRange: 'getAdjustments',
  getAdjustmentsInDate: 'getAdjustments',

  getTreasuryDepositsInDateEndPoint: 'getTreasuryDeposits',
  getTreasuryDepositsInDateRangeEndPoint: 'getTreasuryDeposits',
  getTreasuryDepositsInDateRangeViaDepositTypeEndPoint: 'getTreasuryDepositsViaDepositType',
  getTreasuryDepositsInDateViaDepositTypeEndPoint: 'getTreasuryDepositsViaDepositType',

  getTransactionProductsViaProductIdInDateEndPoint: 'getTransactionProductsViaProductIdInDate',
  getTransactionProductsViaProductIdInDateRangeEndPoint: 'getTransactionProductsViaProductIdInDateRange'

}
