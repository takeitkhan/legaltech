import { format } from 'date-fns'

export default function setTransactionDataFormEdit(form, productsArray, challanForm, adjustmentForm, transaction) {
  const { adjustment, treasuryDeposit } = transaction
  const newForm = form
  const newChallanForm = challanForm
  const newAdjustmentForm = adjustmentForm
  // productsArray.splice(0, productsArray.length)
  newForm.id = transaction.id
  newForm.entity_id = transaction?.entity_id
  newForm.transaction_type = transaction.transaction_type_id
  newForm.invoiceId = transaction?.invoice_no
  newForm.contact_id = transaction?.contact_id
  newForm.contact_name = transaction.contact_name
  newForm.contactCode = transaction?.contact?.contact_code
  newForm.contactAddress = transaction?.contact?.address
  newForm.contact_bin_number = transaction?.contact?.bin
  newForm.employee_id = transaction?.employee_id
  newForm.tax_payable = transaction?.tax_payable
  newForm.transaction_channel = transaction?.transaction_channel

  const date = format(new Date(transaction.transaction_date), 'yyyy-MM-dd')
  const transactionDate = date.split('-')
  newForm.transaction_date = new Date(Number(transactionDate[0]), Number(transactionDate[1]) - 1, Number(transactionDate[2]))
  newForm.document_type = transaction?.document_type_id

  newForm.transaction_category = transaction.transaction_category
  newForm.office_code = transaction.office_code
  newForm.item_no = transaction.item_no
  newForm.CPC = transaction.CPC

  // for treasury challan
  if (transaction?.transaction_type_id === 5 && adjustment) {
    newAdjustmentForm.id = adjustment.id
    newAdjustmentForm.title = adjustment.title
    newAdjustmentForm.amount = adjustment.amount
    newAdjustmentForm.vat_rate = adjustment.vat_rate
    newAdjustmentForm.adjustment_date = adjustment.adjustment_date
    newAdjustmentForm.adjustment_type = adjustment.adjustment_type
  } else if (transaction?.transaction_type_id === 4 && treasuryDeposit) {
    // for adjustment
    newChallanForm.id = treasuryDeposit.id
    newChallanForm.bank = treasuryDeposit.bank
    newChallanForm.branch = treasuryDeposit.branch
    newChallanForm.district = treasuryDeposit.district
    newChallanForm.date = treasuryDeposit.date
    newChallanForm.deposit_account_code = treasuryDeposit.deposit_account_code
    newChallanForm.deposit_amount = treasuryDeposit.deposit_amount
    newChallanForm.deposit_type = treasuryDeposit.deposit_type
  } else if (transaction?.transactionsProducts?.length === 1) {
    newForm.productId = transaction.transactionsProducts[0].entity_product_id
    newForm.taxable_value = transaction.transactionsProducts[0].taxable_value
    newForm.productCode = transaction.transactionsProducts[0].entity_product.code
    newForm.productName = transaction.transactionsProducts[0].entity_product.title
    newForm.product_unit = transaction.transactionsProducts[0].entity_product.unit
    newForm.productHSCode = transaction.transactionsProducts[0].entity_product.hs_code
    newForm.unit_price = transaction.transactionsProducts[0].unit_price
    newForm.taxRate = transaction.transactionsProducts[0].tax_rate_id
    newForm.sdRate = transaction.transactionsProducts[0].sd_rate
    newForm.atRate = transaction.transactionsProducts[0].at_rate
    newForm.ait = transaction.transactionsProducts[0].ait
    newForm.rd = transaction.transactionsProducts[0].rd
    newForm.cd = transaction.transactionsProducts[0].cd
    newForm.qty = transaction.transactionsProducts[0].qty
  } else if (transaction?.transactionsProducts?.length > 1) {
    // eslint-disable-next-line no-unused-expressions
    transaction?.transactionsProducts?.forEach(product => {
      const singleProduct = {
        productName: product?.entity_product?.title,
        productId: product?.entity_product_id,
        productCode: product?.entity_product?.code,
        product_unit: product.unit,
        unit_price: product.unit_price,
        productHSCode: product?.entity_product?.hs_code,
        dictionaryProductId: null,
        sdRate: product.sd_rate,
        atRate: product.at_rate,
        taxRate: product.tax_rate_id,
        taxValue: product?.taxRate?.rate,
        taxable_value: product.taxable_value,
        ait: product.ait,
        rd: product.rd,
        cd: product.cd,
        qty: product.qty,
      }
      productsArray.push(singleProduct)
    })
  }
  return [newForm, newChallanForm, newAdjustmentForm]
}
