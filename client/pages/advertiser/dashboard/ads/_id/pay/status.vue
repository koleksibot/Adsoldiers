<template>
  <div>{{ status.description }}</div>
</template>

<script>
export default {
  data() {
    return {
      status: "",
    };
  },

  mounted() {
    this.getPaymentStatus();
  },

  middleware: "auth",

  layout: "dashboard",

  methods: {
    getPaymentStatus() {
      this.$axios
        .post("advertiser/transactions/status", {
          payment_id: this.$route.query.id,
        })
        .then((res) => {
          this.status = JSON.parse(res.data.data).result;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>