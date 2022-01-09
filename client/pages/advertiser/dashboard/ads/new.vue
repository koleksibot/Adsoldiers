<template>
  <div>
    <div class="row">
      <div class="fixed alert alert-danger" v-if="successMessage">
        {{ successMessage }}
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Campaign *</label>
          <multiselect
            v-model="form.campaign_id"
            deselect-label="Can't remove this value"
            track-by="id"
            :custom-label="campaignCustomLabel"
            placeholder="Pick A Media Type"
            :options="campaigns"
            :allow-empty="false"
            :class="{ 'is-invalid': errors.campaign_id }"
          ></multiselect>
          <p class="text-danger p-2" v-for="error in errors.campaign_id">
            {{ error }}
          </p>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="form-group dash-group">
          <label>Title *</label>
          <input
            class="form-control dash-input"
            placeholder="Example Ad"
            type="text"
            v-model="form.title"
            :class="{ 'is-invalid': errors.title }"
          />
          <p class="text-danger p-2" v-for="error in errors.title">
            {{ error }}
          </p>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="form-group dash-group">
          <label>Broadcast Content *</label>
          <!-- Descrition text area -->
          <textarea
            class="form-control dash-input"
            placeholder="Please Enter Ad's Content"
            type="text"
            v-model="form.content"
            :class="{ 'is-invalid': errors.content }"
          ></textarea>
          <p class="text-danger p-2" v-for="error in errors.content">
            {{ error }}
          </p>
          <!-- emotions -->
          <div class="emotions">
            <client-only>
              <emoji-picker @emoji="insert" :search="search">
                <div
                  class="emoji-invoker"
                  slot="emoji-invoker"
                  slot-scope="{ events: { click: clickEvent } }"
                  @click.stop="clickEvent"
                >
                  <svg
                    height="24"
                    viewBox="0 0 24 24"
                    width="24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path
                      d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"
                    />
                  </svg>
                </div>
                <div
                  slot="emoji-picker"
                  slot-scope="{ emojis, insert, display }"
                >
                  <div class="emoji-picker">
                    <div class="emoji-picker__search">
                      <input type="text" v-model="search" v-focus />
                    </div>
                    <div>
                      <div
                        v-for="(emojiGroup, category) in emojis"
                        :key="category"
                      >
                        <h5>{{ category }}</h5>
                        <div class="emojis">
                          <span
                            v-for="(emoji, emojiName) in emojiGroup"
                            :key="emojiName"
                            @click="insert(emoji)"
                            :title="emojiName"
                            >{{ emoji }}</span
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </emoji-picker>
            </client-only>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Duration *</label>
          <client-only>
            <date-picker
              v-model="date"
              class="form-control dash-input date"
              range
              :shortcuts="shortcuts"
              :placeholder="placeholder"
              lang="eng"
              :class="{ 'is-invalid': errors.start_date || errors.end_date }"
            />
            <p class="text-danger p-2" v-for="error in errors.end_date">
              {{ error }}
            </p>
            <p class="text-danger p-2" v-for="error in errors.start_date">
              {{ error }}
            </p>
          </client-only>
        </div>
      </div>
      <!-- <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Media Type *</label>
          <multiselect
            v-model="form.media_type"
            :options="media_type"
            :preserve-search="true"
            placeholder="Pick A Media Type"
            label="name"
            track-by="name"
            :class="{ 'is-invalid' : errors.media_type}"
          ></multiselect>
          <p class="text-danger p-2" v-for="error in errors.media_type">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-offset-6 col-md-6 p-4" v-if=" form.media_type !== '' ">
        <div class="form-group dash-group">
          <label>Upload Your File</label>
          <div class="row">
            <div class="col-xs-6">
              <input type="file" @change.prevent="handleFileUpload" multiple />
            </div>
            <p
              class="col-xs-6 mt-10 hint"
              v-if=" (['slider', 'image']).includes(form.media_type) "
            >Image Ideal Dimension is more than 200 x 200 with extensions(jpg,jpeg,png)</p>
            <p
              class="col-xs-6 mt-10 hint"
              v-if=" form.media_type == 'video' "
            >Video size mustn't exceed 5 MB with extensions(MP4)</p>
          </div>
        </div>
      </div>-->
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Budget *</label>
          <input
            class="form-control dash-input"
            placeholder="Please Insert the Campaign Budget"
            type="number"
            min="1"
            v-model="form.budget"
            :class="{ 'is-invalid': errors.budget }"
          />
          <p class="text-danger p-2" v-for="error in errors.budget">
            {{ error }}
          </p>
        </div>
      </div>
      <!--         <div class="col-sm-12 col-md-6">
          <div class="form-group dash-group">
            <label>Budget After Taxes*</label>
            <input class="form-control dash-input" v-model="budget_after_tax" disabled>
          </div>
      </div>-->
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Gender *</label>
          <multiselect
            v-model="form.gender"
            :options="gender"
            :preserve-search="true"
            placeholder="Pick A gender"
            label="name"
            track-by="name"
            :class="{ 'is-invalid': errors.gender }"
          ></multiselect>
          <p class="text-danger p-2" v-for="error in errors.gender">
            {{ error }}
          </p>
        </div>
      </div>
      <!-- Demographics -->
      <div class="col-sm-12 mb-10">
        <h3>Demographics</h3>
        <p>
          Hold down the Ctrl (windows) / Command (Mac) button to select multiple
          options.
        </p>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Age *</label>
          <multiselect
            v-model="form.age"
            :options="analytics.age"
            :multiple="true"
            :close-on-select="false"
            :clear-on-select="false"
            :preserve-search="true"
            placeholder="Pick An Age"
            label="value"
            track-by="value"
            :class="{ 'is-invalid': errors.age }"
          >
            <template slot="selection" slot-scope="{ values, search, isOpen }">
              <span
                class="multiselect__single"
                v-if="values.length &amp;&amp; !isOpen"
                >{{ values.length }} options selected</span
              >
            </template>
          </multiselect>
          <p class="text-danger p-2" v-for="error in errors.age">{{ error }}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Targeted Audience *</label>
          <multiselect
            v-model="form.targeted_audience"
            :options="analytics.interest"
            :multiple="true"
            :close-on-select="false"
            :clear-on-select="false"
            :preserve-search="true"
            placeholder="Pick A Targeted Audience"
            label="value"
            track-by="value"
            :class="{ 'is-invalid': errors.targeted_audience }"
          >
            <template slot="selection" slot-scope="{ values, search, isOpen }">
              <span
                class="multiselect__single"
                v-if="values.length &amp;&amp; !isOpen"
                >{{ values.length }} options selected</span
              >
            </template>
          </multiselect>
          <p class="text-danger p-2" v-for="error in errors.targeted_audience">
            {{ error }}
          </p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Country *</label>
          <multiselect
            v-model="form.country"
            :options="countries"
            :multiple="true"
            :close-on-select="false"
            :clear-on-select="false"
            :preserve-search="true"
            placeholder="Pick A Country"
            label="value"
            track-by="id"
            :class="{ 'is-invalid': errors.country }"
            @input="fetchCities()"
          >
            <template slot="selection" slot-scope="{ values, search, isOpen }">
              <span
                class="multiselect__single"
                v-if="values.length &amp;&amp; !isOpen"
                >{{ values.length }} options selected</span
              >
            </template>
          </multiselect>
          <p class="text-danger p-2" v-for="error in errors.country">
            {{ error }}
          </p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6" v-if="cities.length != 0">
        <div class="form-group dash-group">
          <label>City *</label>
          <multiselect
            v-model="form.city"
            :options="cities"
            :multiple="true"
            :close-on-select="false"
            :clear-on-select="false"
            :preserve-search="true"
            placeholder="Pick A Country"
            label="value"
            track-by="id"
            :class="{ 'is-invalid': errors.city }"
          >
            <template slot="selection" slot-scope="{ values, search, isOpen }">
              <span
                class="multiselect__single"
                v-if="values.length &amp;&amp; !isOpen"
                >{{ values.length }} options selected</span
              >
            </template>
          </multiselect>
          <p class="text-danger p-2" v-for="error in errors.city">
            {{ error }}
          </p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Language *</label>
          <multiselect
            v-model="form.language"
            :options="languages"
            :multiple="true"
            :close-on-select="false"
            :clear-on-select="false"
            :preserve-search="true"
            placeholder="Pick A Language"
            label="value"
            track-by="id"
            :class="{ 'is-invalid': errors.language }"
          >
            <template slot="selection" slot-scope="{ values, search, isOpen }">
              <span
                class="multiselect__single"
                v-if="values.length &amp;&amp; !isOpen"
                >{{ values.length }} options selected</span
              >
            </template>
          </multiselect>
          <p class="text-danger p-2" v-for="error in errors.language">
            {{ error }}
          </p>
        </div>
      </div>
    </div>
    <div class="row mt-20">
      <!-- Demographics -->
      <div class="col-sm-12">
        <h3>Call Of Action</h3>
      </div>
      <div class="col-sm-6">
        <div class="form-group dash-group">
          <label class="col-sm-12 p-0">Text *</label>
          <input
            class="form-control dash-input"
            placeholder="Please Enter The Link"
            type="text"
            v-model="form.call_of_action_txt"
            :class="{ 'is-invalid': errors.call_of_action_txt }"
          />
          <p class="text-danger p-2" v-for="error in errors.call_of_action_txt">
            {{ error }}
          </p>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group dash-group">
          <label class="col-sm-12 p-0">Link*</label>
          <input
            class="form-control dash-input"
            placeholder="Please Enter The Link"
            type="text"
            v-model="form.call_of_action_url"
            :class="{ 'is-invalid': errors.call_of_action_url }"
          />
          <p class="text-danger p-2" v-for="error in errors.call_of_action_url">
            {{ error }}
          </p>
        </div>
      </div>
    </div>
    <!-- <img :src="form.media" alt /> -->
    <!-- <video :src="form.media" autoplay="autoplay"></video> -->
    <!-- mobile preview -->
    <mobile-preview @fileUploaded="handleFileUpload" />
    <!-- action buttons -->
    <action-buttons
      actionBtnText="Create Ad"
      v-on:handleSubmition="handleSubmition"
    />
  </div>
</template>

<script>
import MobilePreview from "@/components/dashboard/ads/mobilePreview";
import ActionButtons from "@/components/dashboard/action-buttons";
export default {
  data() {
    return {
      value: [],
      input: "",
      search: "",
      gender: [
        { name: "Male", value: "male" },
        { name: "Female", value: "female" },
        { name: "Both", value: "both" },
      ],
      // media_type: [
      //   { name: "Image", value: "image" },
      //   { name: "Slider", value: "slider" },
      //   { name: "Video", value: "video" }
      // ],
      successMessage: "",
      campaigns: "",
      analytics: "",
      placeholder: "",
      shortcuts: [],
      date: "",
      format: "Y-m-d",
      // budget_after_tax: '',
      settings: "",
      countries: [],
      cities: [],
      languages: [],
      form: {
        owner_id: "",
        title: "",
        content: "",
        country: [],
        city: [],
        language: [],
        start_date: "",
        end_date: "",
        // media: "aaa",
        media_type: "",
        budget: "",
        campaign_id: "",
        gender: "",
        age: [],
        targeted_audience: [],
        call_of_action_txt: "",
        call_of_action_url: "",
      },
    };
  },
  watch: {
    date: function () {
      this.form.start_date = this.formatingDate(this.date[0]);
      this.form.end_date = this.formatingDate(this.date[1]);
    },
    // 'form.budget': function() {
    //   let budget = parseInt(this.form.budget) + ((this.form.budget * this.settings.taxes) / 100);
    //   // if budget field is empty then epmty the budget after tax field also
    //   this.form.budget == '' ? this.budget_after_tax = '' : this.budget_after_tax = budget;
    //   // if budget_after_tax value data type is any type other than number
    //   isNaN(this.budget_after_tax) ? this.budget_after_tax = 'Please Insert a Valid Number In Budget Field' : '';
    // }
  },
  components: {
    MobilePreview,
    ActionButtons,
  },
  mounted() {
    this.form.owner_id = this.user.id;
    this.intialDate();
    this.formData = new FormData();
  },
  directives: {
    focus: {
      inserted(emojiPicker) {
        emojiPicker.focus();
      },
    },
  },
  methods: {
    campaignCustomLabel({ title, type }) {
      return `${title} — [${type}]`;
    },
    insert(emoji) {
      this.form.content += emoji;
    },
    handleFileUpload(value) {
      this.form.media_type = value.selectedMedia_type;
      Object.keys(value.media).map((key) => {
        return this.formData.append("media[]", value.media[key]);
      });
    },
    handleDropdown(key) {
      let $singleDropdown = ["gender", "media_type", "campaign_id"];
      if ($singleDropdown.includes(key)) {
        {
          this.singleSelect(key);
        }
        return;
      }
      /* Extract the value from the object */
      let selectedObject = [...this.form[key]]; // clone the value from the form into array
      Object.keys(selectedObject).map(function (key) {
        selectedObject[key] = selectedObject[key].value;
      });
      // format the value to send it to the endpoint
      this.formData.append(key, selectedObject);
    },
    singleSelect(key) {
      let value = this.form[key].value || this.form[key].id;
      this.formData.append(key, value);
    },
    handleSubmition() {
      let dropdowns = [
        "media_type",
        "gender",
        "age",
        "targeted_audience",
        "country",
        "city",
        "language",
        "campaign_id",
      ];
      Object.keys(this.form).map((key) => {
        if (dropdowns.includes(key)) {
          this.handleDropdown(key);
          return;
        }
        this.formData.append(key, this.form[key]);
      });
      this.$axios
        .$post("ads/create", this.formData, {
          header: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((res) => {
          this.successMessage = res.message;
          setTimeout(() => {
            this.$store.commit(
              "localStorage/SET_PAYMENT_AMOUNT",
              this.formData.get("budget")
            );
            this.$store.commit(
              "localStorage/SET_PAYMENT_ORDER_NUMBER",
              res.ad_id
            );
            this.$store.commit(
              "localStorage/SET_PAYMENT_CHECKOUT_ID",
              JSON.parse(res.checkout)
            );
            this.$router.push({
              path: `/advertiser/dashboard/ads/${res.ad_id}/pay`,
            });
          }, 1000);
        });
    },
    formatingDate(date) {
      let result =
        date.getFullYear() +
        "-" +
        ("0" + (date.getMonth() + 1)).slice(-2) +
        "-" +
        ("0" + (date.getDate() + 1)).slice(-2);
      return String(result);
    },
    intialDate() {
      let formatingDate = new Date();
      let formattedDate = this.formatingDate(formatingDate);
      this.placeholder = formattedDate + " ~ " + formattedDate;
    },
    fetchCities() {
      let selectedCountries = [];
      // itterate through selected countries to send reuest with their ids
      this.form.country.forEach(function (country, index) {
        selectedCountries.push(country.id);
      });
      // join the countries ids to form string to send in the url of request
      selectedCountries = selectedCountries.join();
      // axios get request and the fetched data stord in cities property
      this.$axios.$get("ads/cities/" + selectedCountries).then((res) => {
        this.cities = res.data;
      });
    },
  },
  async asyncData({ app }) {
    let request = [
      app.$axios.$get("campaigns"),
      app.$axios.$get("analytics"),
      app.$axios.$get("ads/countries"),
      app.$axios.$get("ads/language"),
    ];
    let response = await Promise.all(request);
    return {
      campaigns: response[0].data.data,
      analytics: response[1].data,
      countries: response[2].data,
      languages: response[3].data,
    };
  },
  middleware: ["advertiser", "auth"],
  layout: "dashboard",
};
</script>
