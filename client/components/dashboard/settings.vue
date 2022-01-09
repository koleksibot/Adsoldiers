<template>
  <div>
    <div class="row">
      <h2 class="pl-4">About</h2>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <textarea
            class="form-control dash-input"
            :class="{ 'is-invalid' : errors.about_us}"
            placeholder="Description"
            v-model="initialSettings.about_us"
          ></textarea>
          <p class="text-danger p-2" v-for="error in errors.about_us">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="about-img">
          <i
            class="fa fa-pencil-square-o edit"
            aria-hidden="true"
            title="Edit Picture"
            @click="aboutImg = !aboutImg"
          ></i>
          <img :src="'/_nuxt/assets/img/' + initialSettings.about_us_image" alt="about_us_image" />
        </div>
        <div class="col-sm-12" v-if="aboutImg">
          <div class="form-group dash-group">
            <label>Upload Photo</label>
            <input type="file" @change.prevent="handleImageUpload('about_us_image')" />
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <h2 class="pl-4">Mission</h2>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <textarea
            class="form-control dash-input"
            :class="{ 'is_invalid' : errors.mission }"
            placeholder="Description"
            v-model="initialSettings.mission"
          ></textarea>
          <p class="text-danger p-2" v-for="error in errors.mission">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="about-img">
          <i
            class="fa fa-pencil-square-o edit"
            aria-hidden="true"
            title="Edit Picture"
            @click="missionImg = !missionImg"
          ></i>
          <img :src="'/_nuxt/assets/img/' + initialSettings.mission_image" alt="mission_image" />
        </div>
        <div class="col-sm-12" v-if="missionImg">
          <div class="form-group dash-group">
            <label>Upload Photo</label>
            <input type="file" @change.prevent="handleImageUpload('mission_image')" />
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <h2 class="pl-4">Vision</h2>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <textarea
            class="form-control dash-input"
            :class="{ 'is-invalid' : errors.vision }"
            placeholder="Description"
            v-model="initialSettings.vision"
          ></textarea>
          <p class="text-danger p-2" v-for="error in errors.vision">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="about-img">
          <i
            class="fa fa-pencil-square-o edit"
            aria-hidden="true"
            title="Edit Picture"
            @click="visionImg = !visionImg"
          ></i>
          <img :src=" '/_nuxt/assets/img/' + initialSettings.vision_image" alt="vision_image" />
        </div>
        <div class="col-sm-12" v-if="visionImg">
          <div class="form-group dash-group">
            <label>Upload Photo</label>
            <input type="file" @change.prevent="handleImageUpload('vision_image')" />
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <h2 class="pl-4">Intro Video</h2>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <input
            class="form-control dash-input"
            placeholder="Example Task"
            type="text"
            v-model="initialSettings.intro_video"
            :class="{ 'is-invalid' : errors.intro_video}"
          />
          <p class="text-danger p-2" v-for="error in errors.intro_video">{{error}}</p>
        </div>
      </div>
    </div>
    <div class="row">
      <h2 class="pl-4">Contact Us Data</h2>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Email *</label>
          <input
            class="form-control dash-input"
            placeholder="Example Task"
            type="text"
            v-model="initialSettings.email"
            :class="{ 'is-invalid' : errors.email}"
          />
          <p class="text-danger p-2" v-for="error in errors.email">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Address *</label>
          <input
            class="form-control dash-input"
            placeholder="Example Task"
            type="text"
            v-model="initialSettings.address"
            :class="{ 'is-invalid' : errors.address}"
          />
          <p class="text-danger p-2" v-for="error in errors.address">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Mobile *</label>
          <input
            class="form-control dash-input"
            placeholder="Example Task"
            type="text"
            v-model="initialSettings.mobile"
            :class="{ 'is-invalid' : errors.mobile}"
          />
          <p class="text-danger p-2" v-for="error in errors.mobile">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Facebook Link *</label>
          <input
            class="form-control dash-input"
            placeholder="Example Task"
            type="text"
            v-model="initialSettings.facebook"
            :class="{ 'is-invalid' : errors.facebook}"
          />
          <p class="text-danger p-2" v-for="error in errors.facebook">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Instagram Link *</label>
          <input
            class="form-control dash-input"
            placeholder="Example Task"
            type="text"
            v-model="initialSettings.instagram"
            :class="{ 'is-invalid' : errors.instagram}"
          />
          <p class="text-danger p-2" v-for="error in errors.instagram">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Twitter Link *</label>
          <input
            class="form-control dash-input"
            placeholder="Example Task"
            type="text"
            v-model="initialSettings.twitter"
            :class="{ 'is-invalid' : errors.twitter}"
          />
          <p class="text-danger p-2" v-for="error in errors.twitter">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Location longitude *</label>
          <input
            class="form-control dash-input"
            placeholder="Example Task"
            type="text"
            v-model="initialSettings.lng"
            :class="{ 'is-invalid' : errors.lng}"
          />
          <p class="text-danger p-2" v-for="error in errors.lng">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Location latitude *</label>
          <input
            class="form-control dash-input"
            placeholder="Example Task"
            type="text"
            v-model="initialSettings.lat"
            :class="{ 'is-invalid' : errors.lat}"
          />
          <p class="text-danger p-2" v-for="error in errors.lat">{{error}}</p>
        </div>
      </div>
    </div>
    <div class="row">
      <h2 class="pl-4">Campaigns & Ads Constrains</h2>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Campaign Min Duration</label>
          <input
            class="form-control dash-input"
            placeholder="Example Task"
            type="text"
            v-model="initialSettings.campaign_min_Duration"
            :class="{ 'is-invalid' : errors.campaign_min_Duration}"
          />
          <p class="text-danger p-2" v-for="error in errors.campaign_min_Duration">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Campaign MinBudget</label>
          <input
            class="form-control dash-input"
            placeholder="Example Task"
            type="text"
            v-model="initialSettings.campaign_min_budget"
            :class="{ 'is-invalid' : errors.campaign_min_budget}"
          />
          <p class="text-danger p-2" v-for="error in errors.campaign_min_budget">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Ad Min Budget</label>
          <input
            class="form-control dash-input"
            placeholder="Example Task"
            type="text"
            v-model="initialSettings.ad_min_budget"
            :class="{ 'is-invalid' : errors.ad_min_budget}"
          />
          <p class="text-danger p-2" v-for="error in errors.ad_min_budget">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Task Min Click Price</label>
          <input
            class="form-control dash-input"
            placeholder="Example Task"
            type="text"
            v-model="initialSettings.task_min_click_price"
            :class="{ 'is-invalid' : errors.task_min_click_price}"
          />
          <p class="text-danger p-2" v-for="error in errors.task_min_click_price">{{error}}</p>
        </div>
      </div>
    </div>
    <div class="col-sm-12 text-right">
      <button class="the-btn2 hvr-radial-out" @click="$router.back()">Cancel</button>
      <button class="the-btn hvr-radial-out" @click.prevent="handleSubmition">Update Settings</button>
    </div>
  </div>
</template>
<script>
export default {
  props: ["settings"],
  data() {
    return {
      formData: "",
      initialSettings: this.settings,
      aboutImg: false,
      missionImg: false,
      visionImg: false
    };
  },
  mounted() {
    this.formData = new FormData();
  },
  methods: {
    handleImageUpload(image) {
      // append image in formData with key of the file input name
      this.formData.append(image, event.target.files[0]);
    },
    handleSubmition() {
      let exceptions = [
        "id",
        "about_us_image",
        "mission_image",
        "vision_image"
      ];
      // set initialSettings to formData except images
      Object.keys(this.initialSettings).forEach(key => {
        if (!exceptions.includes(key)) {
          this.formData.append(key, this.initialSettings[key]);
        }
      });

      this.$axios
        .post("settings", this.formData, {
          header: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(res => {
          this.successMessage = res.data.message;
          setTimeout(() => {
            this.$router.back();
          }, 1500);
        });
    }
  }
};
</script>
<style scooped>
.edit {
  right: 25px;
  position: absolute;
  top: 10px;
  color: #e50015;
  background-color: #fff;
  padding: 10px;
  border-radius: 3px;
  cursor: pointer;
}
</style>
