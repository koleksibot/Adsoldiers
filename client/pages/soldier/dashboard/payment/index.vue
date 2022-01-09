<template>
  <div>
    <Payment />
  </div>
</template>

<script>
import Payment from "@/components/dashboard/payment-form";
export default {
  components: {
    Payment
  },
  middleware: "auth",
  layout: "dashboard"
};
</script>
