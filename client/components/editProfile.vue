<template>
  <div class="row">
    <div class="col-md-4 pull-left">
      <img class="img-thumbnail pic" :src=" '/_nuxt/assets/' + user.picture " alt="profile_picture" />
    </div>
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-6 col-sm-6 mt-20">
          <div class="form-group dash-group">
            <label class="pl-2">Username *</label>
            <input
              class="form-control dash-input"
              placeholder="Example Ad"
              type="text"
              v-model="form.username"
              :class="{ 'is-invalid' : errors.username}"
            />
            <p class="text-danger p-2" v-for="error in errors.username">{{error}}</p>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 mt-20">
          <div class="form-group dash-group">
            <label class="pl-2">Address *</label>
            <input
              class="form-control dash-input"
              placeholder="Example Ad"
              type="text"
              v-model="form.address"
              :class="{ 'is-invalid' : errors.address}"
            />
            <p class="text-danger p-2" v-for="error in errors.address">{{error}}</p>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 mt-20">
          <div class="form-group dash-group">
            <label class="pl-2">Phone no. *</label>
            <input
              class="form-control dash-input"
              placeholder="Example Ad"
              type="text"
              v-model="form.mobile"
              :class="{ 'is-invalid' : errors.mobile}"
            />
            <p class="text-danger p-2" v-for="error in errors.mobile">{{error}}</p>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 mt-20">
          <div class="form-group dash-group">
            <label class="pl-2">Current Password. *</label>
            <input
              type="Password"
              class="form-control dash-input"
              placeholder="Enter Password"
              v-model="form.current_password"
              :class="{ 'is-invalid' : errors.current_password}"
            />
            <p class="text-danger p-2" v-for="error in errors.current_password">{{error}}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-sm-6 mt-20">
          <div class="form-group dash-group">
            <label class="pl-2">Password *</label>
            <input
              type="Password"
              class="form-control dash-input"
              placeholder="Enter Password"
              v-model="form.password"
              :class="{ 'is-invalid' : errors.password}"
            />
            <p class="text-danger p-2" v-for="error in errors.password">{{error}}</p>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 mt-20">
          <div class="form-group dash-group">
            <label class="pl-2">Password Confirmation *</label>
            <input
              type="Password"
              class="form-control dash-input"
              placeholder="Enter Password"
              v-model="form.password_confirmation"
            />
          </div>
        </div>
      </div>
      <div class="row mt-20">
        <div class="form-group dash-group">
          <div class="col-sm-6">
            <label class="pl-2">Edit Profile Picture *</label>
            <input type="file" @change.prevent="handleFileUpload" multiple />
          </div>
          <p
            class="col-xs-6 mt-10 hint col-sm-6"
          >Image Ideal Dimension is more than 200 x 200 with extensions(jpg,jpeg,png)</p>
        </div>
      </div>
      <div class="col-sm-12 text-right mt-40">
        <button class="the-btn2 hvr-radial-out" @click="$router.back()">Cancel</button>
        <button class="the-btn hvr-radial-out" @click="handleSubmition">Update</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {}
    };
  },
  mounted() {
    //   clone user data into form
    this.form = { ...this.user };
    delete this.form.picture;
    this.formData = new FormData();
  },
  methods: {
    inputing(key) {
      this.form.key = event.target;
    },
    handleFileUpload() {
      Object.keys(event.target.files).map(key => {
        return this.formData.append("picture", event.target.files[key]);
      });
    },
    handleSubmition() {
      // let a = this.$route.path;
      // console.log(a.substring(0, a.lastIndexOf("/")));

      Object.keys(this.form).map(key => {
        this.formData.append(key, this.form[key]);
      });

      this.$axios
        .$post("auth/profile/update", this.formData, {
          header: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(res => {
          this.successMessage = res.message;
          setTimeout(() => {
            this.$router.back();
          }, 1000);
        });
    }
  }
};
</script>