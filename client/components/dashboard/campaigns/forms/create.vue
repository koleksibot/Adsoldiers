<template>
    <div class="row-2">
      <div class="fixed alert alert-danger" v-if="successMessage">{{successMessage}}</div>
      <div class="col-sm-12">
        <div class="form-group dash-group">
          <label>Title *</label>
          <input class="form-control dash-input" placeholder="Example Campaign" type="text" v-model="form.title" :class="{ 'is-invalid' : errors.title}">
             <p class="text-danger p-2" v-for="error in errors.title">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="form-group dash-group">
          <label>Description *</label>
          <input class="form-control dash-input" placeholder="Please Enter Ad's Content" type="text" v-model="form.description" :class="{ 'is-invalid' : errors.description}">
             <p class="text-danger p-2" v-for="error in errors.description">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="form-group dash-group">
          <label>Content *</label>
          <textarea class="form-control dash-input" placeholder="content" v-model="form.content"  :class="{ 'is-invalid' : errors.content}"></textarea>
          <p class="text-danger p-2" v-for="error in errors.content">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label> Targeted Audience * </label>
          <select class="form-control dash-input" v-model="form.industry" :class="{ 'is-invalid' : errors.industry}">
            <option value="Education">Education</option>
          </select>
          <p class="text-danger p-2" v-for="error in errors.industry">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label> Type * </label>
          <select class="form-control dash-input" v-model="form.type" :class="{ 'is-invalid' : errors.type}">
            <option value="awareness">Awareness</option>
            <option value="traffic">Traffic</option>
            <option value="app-installs">App installs</option>
            <option value="video-views">Video views</option>
            <option value="messages">Messages</option>
            <option value="lead-generation">Lead generation </option>
          </select>
          <p class="text-danger p-2" v-for="error in errors.type">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
            <label> Campaign Duration * </label>
            <template>
              <client-only>   
              <div class="">
                <date-picker v-model="date" class="form-control dash-input date" range :shortcuts="shortcuts" :placeholder="placeholder" lang="eng"  :class="{ 'is-invalid' : errors.start_date || errors.end_date}" />
                <p class="text-danger p-2" v-for="error in errors.end_date">{{error}}</p>
                <p class="text-danger p-2" v-for="error in errors.start_date">{{error}}</p>
              </div>
              </client-only>
            </template>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Budget *</label>
          <input class="form-control dash-input" placeholder="Please Insert the Campaign Budget" type="text" v-model="form.budget"  :class="{ 'is-invalid' : errors.budget}">
          <p class="text-danger p-2" v-for="error in errors.end_date">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label>Location *</label>
        <country-select class="form-control dash-input" v-model="form.location" :location="form.location" :class="{ 'is-invalid' : errors.location}" />
             <p class="text-danger p-2" v-for="error in errors.location">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 text-right">
        <button class="the-btn2 hvr-radial-out">Cancel</button>
        <button class="the-btn hvr-radial-out" @click="handleSubmition">Create Campaign</button>
      </div>
    </div>
</template>

<script>
    export default {
      data() {
        return {
          successMessage:'',
          placeholder: '',
          shortcuts:[],
          date: '',
          format: 'Y-m-d',
          form:{
            title: '',
            owner_id: '',
            description: '',
            content:'',
            industry: 'Education',
            type: 'awareness',
            start_date: '',
            end_date: '',
            budget: '',
            location: ''
          }
        }
      },
      watch: {
        date: function() {
          this.form.start_date = this.formatingDate(this.date[0]);
          this.form.end_date = this.formatingDate(this.date[1]);
        }
      },
      mounted () {
        this.form.owner_id = this.user.id,
        this.intialDate()
      },
      methods: {
        handleSubmition () {
          this.$axios.$post('campaigns/create', this.form)
                      .then(res => {
                            this.successMessage = res.data.message;
                            setTimeout(() => {this.$router.back()}, 1500)
                      }).catch(err => {
                        console.log(err)
                      })
        },
        formatingDate(date) {
            let result = date.getFullYear() + '-' + date.getMonth() + '-' + date.getDate();
            return String(result); 
        },
        intialDate() {
            let formatingDate = new Date()
            let formattedDate = this.formatingDate(formatingDate)                         
            this.placeholder = formattedDate + ' ~ ' + formattedDate   
        }
      },
    }
</script>