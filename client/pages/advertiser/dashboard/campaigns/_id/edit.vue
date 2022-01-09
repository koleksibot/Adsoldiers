<template>
  <div class="row-2">
    <div class="fixed alert alert-danger" v-if="successMessage">{{successMessage}}</div>
    <!-- form -->
    <form class="col-sm-6 col-sm-offset-3 create-campaign">
      <!-- type input -->
      <div class="form-group dash-group">
        <label>Title *</label>
        <input
          class="form-control dash-input"
          placeholder="Example Campaign"
          type="text"
          v-model="campaign.title"
          :class="{ 'is-invalid' : errors.title}"
        />
        <p class="text-danger p-2" v-for="error in errors.title">{{error}}</p>
      </div>
      <!-- create button -->
      <div class="col-sm-12 text-right">
        <button class="the-btn" @click.prevent="handleSubmition">Create Campaign</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      campaign: "",
      successMessage: ""
    };
  },
  methods: {
    handleSubmition() {
      this.$axios
        .$post(`campaigns/${this.$route.params.id}`, {
          title: this.campaign.title
        })
        .then(res => {
          this.successMessage = res.data.message;
          this.popupForm = false;

          setTimeout(() => {
            this.$router.back();
          }, 300);
        })
        .catch(err => {
          console.log("no");
        });
    },
    popup(value) {
      this.popupForm = !this.popupForm;
      this.form.type = value;
    }
  },
  middleware: ["advertiser", "auth"],
  layout: "dashboard",
  async asyncData({ app, params }) {
    let response = await app.$axios.$get(`campaigns/${params.id}`);
    return {
      campaign: response.data
    };
  }
};
</script>

<style scooped>
button {
  outline: 0px !important;
  -webkit-appearance: none;
  box-shadow: none !important;
}
.create-campaign {
  position: absolute !important;
  top: 30vh;
  /*left: 50vh;*/
  z-index: 9999;
  padding: 25px;
  background-color: #fff;
  border-radius: 15px;
  overflow: hidden;
}
</style>
