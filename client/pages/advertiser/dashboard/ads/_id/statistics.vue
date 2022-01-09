<template>
  <div class="row">
    <statistics :stats="stats" />
  </div>
</template>

<script>
import Statistics from "@/components/statistics";

export default {
  data() {
    return {
      stats: ""
    };
  },
  async asyncData({ app, store, params }) {
    let response = await app.$axios.$get(`/statistics/ads/${params.id}`);
    return {
      stats: response.data
    };
  },
  components: {
    Statistics
  },
  middleware: "auth",
  layout: "dashboard"
};
</script>
