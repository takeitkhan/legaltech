<template>
  <div>
    <tr>
      <td v-text="product.transaction.transaction_date" />
      <td v-text="closingStock[index]" />
      <td v-text="closingStock[index] !== 0 ? closingBalance[index] : 0" />
      <td v-text="product.qty" />
      <td v-text="product.unit_price * product.qty" />
      <td v-text="openingStock[index]" />
      <td v-text="openingBalance[index] !== 0 ? openingBalance[index] * openingStock[index] : 0" />
      <td>Seller Information</td>
      <td>Purchase Challan/Bill of Entry Details name</td>
      <td v-text="product.transaction.transaction_date" />
      <td v-text="soldPrices[index] ? soldPrices[index].soldQty : ''" />
      <td v-text="soldPrices[index] ? soldPrices[index].soldQty * soldPrices[index].soldUnitPrice : ''" />
      <td v-text="soldPrices[index] ? soldPrices[index].sd : ''" />
      <td v-text="soldPrices[index] ? soldPrices[index].vat : ''" />
      <td v-text="soldPrices[index] ? soldPrices[index].contact.name : ''" />
      <td v-text="soldPrices[index] ? soldPrices[index].transaction.invoice_no : ''" />
      <td v-text="soldPrices[index] ? soldPrices[index].transaction.transaction_date : ''" />
      <td v-text="closingStock[index + 1] ? closingStock[index + 1] : 0" />
      <td v-text="closingBalance[index + 1] ? closingBalance[index + 1] : 0" />
    </tr>
    <div v-if="hasSellsProductsAtSameDate">
      <tr
        v-for="(pro) in sellsProductsInSameDate"
        :key="pro.id"
      >
        <td v-text="pro.transaction.transaction_date" />
        <td v-text="closingStock[index]" />
        <td v-text="closingStock[index] !== 0 ? closingBalance[index] : 0" />
        <td v-text="''" />
        <td v-text="''" />
        <td v-text="openingStock[index]" />
        <td v-text="openingBalance[index] !== 0 ? openingBalance[index] * openingStock[index] : 0" />
        <td>Seller Information</td>
        <td>Purchase Challan/Bill of Entry Details name</td>
        <td v-text="pro.transaction.transaction_date" />
        <td v-text="updateClosingStock(pro)" />
        <td v-text="pro.qty * pro.unit_price" />
        <td v-text="pro.sd" />
        <td v-text="pro.tax_rate" />
        <td v-text="pro.contact.name" />
        <td v-text="pro.transaction.invoice_no" />
        <td v-text="pro.transaction.transaction_date" />
        <td v-text="closingStock[index + 1] ? closingStock[index + 1] : 0" />
        <td v-text="closingBalance[index + 1] ? closingBalance[index + 1] : 0" />
      </tr>

    </div>
  </div>
</template>

<script>
/* eslint-disable indent */
export default {
    props: ['product', 'soldPrices', 'closingBalance', 'closingStock', 'openingStock', 'openingBalance', 'index', 'tempSellsProducts'],
    data() {
        return {
            sellsProductsInSameDate: [],
        }
    },
    computed: {
        hasSellsProductsAtSameDate() {
            return !!this.sellsProductsInSameDate.length
        },
        updateClosingStock() {
            return product => {
                this.closingStock[this.index] -= product.qty
                this.closingBalance[this.index] -= (this.product?.entity_product?.unit_price * product.qty)
                return product.qty
            }
        },
    },
    mounted() {
        const sellsProducts = this.tempSellsProducts.filter(pro => pro.transaction.transaction_date === this.product.transaction.transaction_date)
        this.sellsProductsInSameDate = sellsProducts
    },

}
</script>
