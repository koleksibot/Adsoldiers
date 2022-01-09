<template>
  <campaign-title :campaign="campaign" />
</template>

<script>
import CampaignTitle from "@/components/dashboard/campaigns/title";

export default {
  data() {
    return {
      campaign: ""
    };
  },
  components: {
    CampaignTitle
  },
  layout: "dashboard",
  middleware: "auth",
  async asyncData({ app, params, error }) {
    try {
      let response = await app.$axios.$get(`campaigns/${params.id}`);
      return {
        campaign: response.data
      };
    } catch (e) {
      error({ statusCode: e.status, message: e.message });
    }
  }
};
</script>