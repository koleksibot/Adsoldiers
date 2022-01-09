<template>
    <div class="row-2">
      <div class="fixed alert alert-danger" v-if="successMessage">{{successMessage}}</div>
      <!-- Campaign Types Cards -->
      <div class="col-md-4" v-for="(value, key) in campaignsTypes" :key="key">
        <button class="white-box text-center mb-30" @click="popup(value)">
          <h2 class="campaign-card" value="value">{{key}}</h2>
        </button>
      </div>
      <!-- The overlay layer -->
      <div 
        class="modal-backdrop fade in" 
        v-if="popupForm" 
        @click="popupForm = false">
      </div>
      <!-- form -->
      <form class="col-sm-6 col-sm-offset-3 create-campaign" v-if="popupForm">
        <!-- type input -->
        <div class="form-group dash-group">
          <label>Title *</label>
          <input 
            class="form-control dash-input" 
            placeholder="Example Campaign" 
            type="text" 
            v-model="form.title" 
            :class="{ 'is-invalid' : errors.title}">
          <p class="text-danger p-2" v-for="error in errors.title">{{error}}</p>
        </div>
        <!-- Hidden input for type -->
        <input type="hidden" v-model="form.type">
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
            successMessage:'',
            campaignsTypes:{
              'Awareness': 'awareness',
              'Traffic': 'traffic',
              'App Installs': 'app-installs',
              'Video Views': 'video-views',
              'Messages': 'messages',
              'Lead Generation': 'lead-generation'
            },
            form: {
              title: '',
              type: ''
            },
            popupForm: false
          }
        },
        methods: {
          handleSubmition () {
            this.$axios.$post('campaigns/create', this.form)
              .then(
                res => {
                  this.successMessage = res.data.message;
                  this.popupForm = false;

                  setTimeout(
                              () => {
                                      this.$router.push('../ads/new')
                                    },
                                      300
                            )
                }
              ).catch(
                err => {
                  console.log('no')
                  // console.log(error.response.data.errors, 'aa')
                }
              )
          },
          popup(value) {
            this.popupForm = !this.popupForm;
            this.form.type = value;
          }
        },
        middleware: [
          'advertiser',
          'auth'
        ],
        layout: 'dashboard',
        async asyncData({app}) {
            let response = await app.$axios.$get('analytics');
            return {
                analytics: response.data
            };
        }
    }
</script>

<style scooped>
  button {
    outline:0px !important;
    -webkit-appearance:none;
    box-shadow: none !important;
  }
  .create-campaign{
    position: absolute!important;
    top: 30vh;
    /*left: 50vh;*/
    z-index: 9999;
    padding: 25px;
    background-color: #fff;
    border-radius: 15px;
    overflow: hidden;
  }
</style>