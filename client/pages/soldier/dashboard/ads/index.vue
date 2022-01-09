<template>
  <div class="row">
    <div class="col-sm-12">
      <!-- if user level 3 show ads -->
      <ads-index :initialAds="ads" v-if="user.tasks_lvl == 3" />
      <!-- else show message -->
      <p
        class="white-box lead bold"
        v-if="user.tasks_lvl < 3"
      >You Have To Complete The Tasks To Be Able To Proceed!</p>
    </div>
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
  mounted() {
    this.$axios.get("soldier/levelup");
    this.$auth.fetchUser();
  },
  components: {
    AdsIndex
  },
  layout: "dashboard",
  middleware: "auth",
  async asyncData({ app, error }) {
    try {
      let ads = await app.$axios.$get("ads");
      return {
        ads: ads.data
      };
    } catch (e) {
      error({ statusCode: e.status, message: e.message });
    }
  }
};
</script>