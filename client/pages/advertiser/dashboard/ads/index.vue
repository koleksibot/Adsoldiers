<template>
  <div class="row">
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
  middleware: "auth",
  async asyncData({ app }) {
    let ads = await app.$axios.$get("ads");
    return {
      ads: ads.data
    };
  }
};
</script>
