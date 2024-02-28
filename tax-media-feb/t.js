/* eslint-disable quotes */

// intially variables store
let transactionProducts = [
  { date: "06-27", qty: 12, id: 1 }, //  prev+0 =0, == | 
  { date: "06-27", qty: -12, id: 2 }, // X = close0     | 0
  { date: "06-27", qty: 5, id: 3 }, // 1
  { date: "06-29", qty: -5, id: 4 }, //
  { date: "07-01", qty: 12, id: 5 },
]

const purchaseProducts = [
  { date: "06-27", qty: 12, id: 1 },
  { date: "06-27", qty: 5, id: 3 },
  { date: "07-01", qty: 12, id: 5 },
]
//all sold prices with same which date is same of price then i will store soldprice with purchase price id 
const soldPrices[1] = { date: "06-27", qty: -12, id: 2 } ///here 1 is product_id 


// after removing soldprices products from transactionProducts 
transactionProducts  = [
  { date: "06-27", qty: 12, id: 1 }, // prev + 12 
  { date: "06-27", qty: 5, id: 3 },
  { date: "06-29", qty: -5, id: 4 },
  { date: "07-01", qty: 12, id: 5 },
]
const closingStock   = []
const closingBalance = []
const openingStock   = []
const openingBalance = []

///
const prevClosingStock = 0
const prevClosingBalance = 0*500
closingStock=[prevClosingStock,]
transactionProducts.forEach((product,key) =>{
    //if product is purchase then 
    if(product.transaction.transaction_type_id === 1 ){
            this.openingStock[key]    = this.closingStock[key] + product.qty //current row
            this.openingBalance[key]  = this.closingBalance[key] + (product.qty * product.entity_product.unit_price)
        if(soldPrices[product.id]){

            this.closingStock[key+1]  = (this.closingStock[key] + product.qty) - soldPrices[product.id].qty //for next row 
            this.closingBalance[key+1]  = (this.closingBalance[key] + (product.entity_product.unit_price * product.qty)) -  (soldPrices[product.id].qty * soldPrices[product.id].entity_product.unit_price) //for next row 

        }
        else{
            closingStock[key+1]    = this.closingStock[key] + product.qty //for next row 
            closingBalance[key+1]  = this.closingBalance[key] + (product.entity_product.unit_price * product.qty)//for next ro
        }
    }
    else{
        // if product is sells then 
        this.openingStock[key]     = this.closingStock[key] //current row
        this.openingBalance[key]   = this.closingBalance[key]
        this.closingStock[key+1]   = this.closingStock[key].qty - product.qty
        this.closingBalance[key+1] = this.closingBalance[key] - (product.qty * product.entity_product.unit_price)
    }
})

// I want to find a uniqe index by which I will find closingStock,closingBalance 
// totalproduct = 5, (purchaseProduct=3, soldPrices=1)=3  so equal is purchaseProduct + tempSellsProducts=3+1=4//so the 
//output will be 
///closingStock = [12-12=0,5-5=0,0+12=12] = [0,0,12]   
//openingStock  = [0,]
