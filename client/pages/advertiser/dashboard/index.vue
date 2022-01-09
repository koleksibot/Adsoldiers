<template>
  <div class="row">
    <dashboard :stats="stats" />
  </div>
</template>

<script>
import Dashboard from "@/components/statistics";

export default {
  data() {
    return {
      stats: ""
    };
  },
  async asyncData({ app, store }) {
    let response = await app.$axios.$get("/statistics/advertiser");
    return {
      stats: response.data
    };
  },
  components: {
    Dashboard
  },
  middleware: "auth",
  layout: "dashboard"
};
</script>
