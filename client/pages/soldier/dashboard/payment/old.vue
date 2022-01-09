<template>
  <div class="row">
    <div class="col-md-12">
      <!-- Success Message -->
      <div class="alert alert-danger" v-if="successMessage">{{successMessage}}</div>
      <!-- Create New Ad Component -->
      <div class="div-top">
        <nuxt-link
          :to="{ name: 'advertiser-dashboard-campaigns-new' }"
          class="the-btn hvr-radial-out"
          v-if="role == 'advertiser' "
        >Create New</nuxt-link>
        <div class="the-search">
          <form>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" />
              <div class="input-group-btn">
                <button class="btn btn-default" type="submit">
                  <img src="img/search.png" />
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- table -->
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col" class="col-xs-1 col-sm-2">Title</th>
              <th scope="col" class="col-xs-2 col-md-5">Type</th>
              <th scope="col" class="hidden-sm" v-if="user.role == 'advertiser' ">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(campaign,index) in campaigns.data" :key="campaign.id">
              <td class="col-xs-1 col-sm-3">
                <nuxt-link
                  class="link2"
                  :to="{ path: 'campaigns/' + campaign.id }"
                >{{campaign.title}}</nuxt-link>
              </td>
              <td class="col-sm-3">{{campaign.type}}</td>
              <td class="hidden-sm col-md-2" v-if="user.role == 'advertiser' ">
                <!-- Action Buttons -->
                <div class="text-center">
                  <!-- Delete -->
                  <button
                    class="fa fa-trash-o fa-lg btn btn-danger action-btn"
                    @click="deleteCampaign(campaign.id,index)"
                  ></button>
                  <!-- Edit -->
                  <nuxt-link
                    class="btn btn-info action-btn"
                    :to="{ name: 'advertiser-dashboard-campaigns-id-edit', params: { id:campaign.id } }"
                  >Edit</nuxt-link>
                  <!-- Statistics -->
                  <nuxt-link
                    class="btn btn-success action-btn"
                    :to="{ name: 'advertiser-dashboard-campaigns-id-statistics', params: { id:campaign.id } }"
                  >Statistics</nuxt-link>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- pagination -->
      <pagination :links="campaigns.links" @changePage="fetchData" />
      <!-- pagination -->
      <!-- end table -->
    </div>
  </div>
</template>

<script>
import Pagination from "@/components/dashboard/table/pagination";

export default {
  props: ["initialCampaigns"],
  data() {
    return {
      successMessage: "",
      campaigns: this.initialCampaigns
      // next_link: "",
      // prev_link: null
    };
  },
  components: {
    Pagination
  },
  methods: {
    fetchData(value) {
      this.campaigns = value;
    },
    deleteCampaign(campaignId, index) {
      this.$axios.$delete(`campaigns/${campaignId}`).then(res => {
        // print success message
        this.successMessage = res.data.message;
        // hide success message after timer
        setTimeout(() => {
          this.successMessage = "";
        }, 1200);
        console.log(index);
        // remove campagin from campaigns object
        this.campaigns.data.splice(index, 1);
      });
    }
    // next() {
    //   this.$axios
    //     .$get(`${this.campaigns.links.next_page_url}`)
    //     .then(res => {
    //       (this.campaigns = res.data),
    //         (this.next_link = this.campaigns.links.next_page_url);
    //       this.prev_link = this.campaigns.links.prev_page_url;
    //     })
    //     .catch(err => {
    //       $nuxt.error({ statusCode: err.status, message: err.message });
    //     });
    // },
    // prev() {
    //   this.$axios
    //     .$get(`${this.campaigns.links.prev_page_url}`)
    //     .then(res => {
    //       (this.campaigns = res.data),
    //         (this.next_link = this.campaigns.links.next_page_url);
    //       this.prev_link = this.campaigns.links.prev_page_url;
    //     })
    //     .catch(err => {
    //       $nuxt.error({ statusCode: err.status, message: err.message });
    //     });
    // }
  }
};
</script>
