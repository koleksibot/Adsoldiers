<template>
  <div class="row">
    <!-- Error Message  -->
    <div class="white-box" v-if="stats.status != 200">
      <h1>{{stats.data.message}}</h1>
    </div>
    <!-- Statistics -->
    <statistics :stats="stats.data" v-if="stats.status == 200" />
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
  async asyncData({ app, params }) {
    let response = await app.$axios.$get(`/statistics/campaigns/${params.id}`);
    return {
      stats: response
    };
  },
  components: {
    Statistics
  },
  middleware: "auth",
  layout: "dashboard"
};
</script>
