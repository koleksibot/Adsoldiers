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
  mounted() {},
  methods: {},
  async asyncData({ app, store }) {
    let response = await app.$axios.$get("/me/statistics");

    return {
      stats: response.data
    };
  },
  components: {
    Dashboard
  },
  layout: "dashboard",
  middleware: "auth"
};
</script>
