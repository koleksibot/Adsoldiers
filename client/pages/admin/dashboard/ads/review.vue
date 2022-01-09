<template>
  <div class="row">
    <h1>Review Ads</h1>
    <ads-index :initialAds="ads" />
  </div>
</template>


<script>
import AdsIndex from "@/components/dashboard/ads/index";

export default {
  data() {
    return {
      ads: []
    };
  },
  components: {
    AdsIndex
  },
  layout: "dashboard",
  middleware: ["auth", "admin"],
  async asyncData({ app }) {
    let response = await app.$axios.$get("ads");
    return {
      ads: response.data
    };
  }
};
</script>
