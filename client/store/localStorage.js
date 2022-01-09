export const state = () => ({
  amount: "",
  orderNumber: "",
  checkout: ""
});

export const getters = {
  amount(state) {
    return state.amount;
  },
  orderNumber(state) {
    return state.orderNumber;
  },
  checkout(state) {
    return state.checkout;
  }
};

export const mutations = {
  SET_PAYMENT_AMOUNT(state, paymentAmount) {
    state.amount = paymentAmount;
  },
  SET_PAYMENT_ORDER_NUMBER(state, orderNumber) {
    state.orderNumber = orderNumber;
  },
  SET_PAYMENT_CHECKOUT_ID(state, checkout) {
    state.checkout = checkout;
  }
};
