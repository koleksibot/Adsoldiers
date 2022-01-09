<template>
  <div class="test">
    <form
      :action="redirectURL"
      class="paymentWidgets"
      data-brands="VISA MASTER AMEX"
    ></form>
  </div>
</template>

<script>
export default {
  computed: {
    checkout() {
      return this.$store.getters["localStorage/checkout"];
    },
    redirectURL() {
      if (process.client) {
        return window.location.href + "/status/";
      }
    },
  },

  mounted() {
    this.appendPaymentScript();
  },

  methods: {
    appendPaymentScript() {
      if (!this.checkout.result.code == "000.200.100") return;

      let paymentScript = document.createElement("script");
      paymentScript.src =
        `https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=` +
        this.checkout.id;
      document.body.appendChild(paymentScript);
    },
  },
};
</script>
