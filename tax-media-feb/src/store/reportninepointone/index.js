export default {
  namespaced: true,
  state: {
    totalPurchaseValue: 0,
    totalPurchaseVAT: 0,
    totalPurchaseSD: 0,
    totalSellsValue: 0,
    totalSellsVAT: 0,
    totalSellsSD: 0,
    sellsTransactionProducts: [],
    purchaseTransactionProducts: [],
    // increasing any other adjustments
    increasingAnyOtherAdjustments: [], // ntoe 27
    increasingAdjustmentForNote24: [], // note 32

    // for decreasing adjustment
    decreasingAnyOtherAdjustments: [],
    decreasingAdjustmentForNote29: [],

    // for 58 and 59 note
    treasuryVATDeposits: [], // note 58
    treasurySDDeposits: [],
    totalIncreasingAdjustmentsAmount: 0, // TOTAL INCREASING ADJUSTMENT NOTE 28
    totalDecreasingAdjustmentsAmount: 0, // NOTE  decreasing adjustment note 33
    totalVATDeposits: 0, // total VAT of note 58 not required now
    totalSDDeposits: 0, // total SD note 59 //not required now 
    totalAtValue: 0, // for note 31

    // net tax calculation
    NetPayableVatForNote34: 0, // (9c-23B+28 -33)
    NetPayableVATAfterAdjustmentWithClosingBalanceVATForNote35: 0, // (34 - (52+56))
    NetPayableSDForNote36: 0, // (9B + 38 - (39 + 40))
    NetPayableSDAfterAdjustmentWithClosingBalanceSDForNote37: 0,
    NetPayableVATForTreasuryDepositNote50: 0, // (35+41+43+44)
    NetPayableSDForTreasuryDepositNote51: 0, // (37+42)
    closingBalanceVATNote52: 0,
    closingBalanceSDNote53: 0,
  },
  getters: {
    TOTAL_PURCHASE_VALUE_GETTERS(state) {
      return state.totalPurchaseValue
    },
    TOTAL_PURCHASE_VAT_GETTERS(state) {
      return state.totalPurchaseVAT
    },
    TOTAL_PURCHASE_SD_GETTERS(state) {
      return state.totalPurchaseSD
    },
    TOTAL_SELLS_VAT_GETTERS(state) {
      return state.totalSellsVAT
    },
    TOTAL_SELLS_SD_GETTERS(state) {
      return state.totalSellsSD
    },
    TOTAL_SELLS_VALUE_GETTERS(state) {
      return state.totalSellsValue
    },
    TOTAL_AT_VALUE_GETTERS(state) {
      return Math.round(state.totalAtValue)
    },
    errorGetter() {
      throw new Error('Error from report 9.1 getters')
    },
  },
  mutations: {
    SET_TOTAL_PURCHASE_VALUE(state, payload) {
      state.totalPurchaseValue = payload
    },
    SET_TOTAL_PURCHASE_VAT(state, payload) {
      state.totalPurchaseVAT = payload
    },
    SET_TOTAL_PURCHASE_SD(state, payload) {
      state.totalPurchaseSD = payload
    },
    SET_TOTAL_SELLS_VALUE(state, payload) {
      state.totalSellsValue = payload
    },
    SET_TOTAL_SELLS_VAT(state, payload) {
      state.totalSellsVAT = payload
    },
    SET_TOTAL_SELLS_SD(state, payload) {
      state.totalSellsSD = payload
    },
    SET_SELLS_TRANSACTION_PRODUCTS(state, payload) {
      state.sellsTransactionProducts = payload
    },
    SET_PURCHASE_TRANSACTION_PRODUCTS(state, payload) {
      state.purchaseTransactionProducts = payload
    },
    SET_TOTAL_AT_VALUE(state, payload) {
      state.totalAtValue = payload
    },
    SET_TREASURY_VAT_DEPOSITS(state, payload) {
      state.treasuryVATDeposits = payload
    },
    SET_TREASURY_SD_DEPOSITS(state, payload) {
      state.treasurySDDeposits = payload
    },
    SET_INCREASING_ANY_OTHER_ADJUSTMENTS(state, payload) {
      state.increasingAnyOtherAdjustments = payload
    },
    SET_INCREASING_ADJUSTMENT__FOR_NOTE_24(state, payload) {
      state.increasingAdjustmentForNote24 = payload
    },
  },
  actions: {},
}
