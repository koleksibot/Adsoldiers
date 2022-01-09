<template>
    <div class="row">
        <div class="fixed alert alert-danger" v-if="successMessage">{{successMessage}}</div>
        <div class="col-sm-12">
            <div class="form-group dash-group">
              <label>Username *</label>
              <input class="form-control dash-input" placeholder="Example: John Doe" type="text" v-model="form.username" :class="{ 'is-invalid' : errors.username}">
              <p class="text-danger p-2" v-for="error in errors.username">{{error}}</p>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group dash-group">
              <label>Email *</label>
              <input class="form-control dash-input" placeholder="Example: advertiser@adsoldier.com" type="email" v-model="form.email" :class="{ 'is-invalid' : errors.email}">
              <p class="text-danger p-2" v-for="error in errors.email">{{error}}</p>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group dash-group">
                <label>Password *</label>
                <input type="Password" class="form-control the-input" placeholder="Enter Password"v-model="form.password" :class="{ 'is-invalid' : errors.password}">
                <p class="text-danger p-2" v-for="error in errors.password">{{error}}</p>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group dash-group">
                <label>Confirm Password *</label>
                <input type="Password" class="form-control the-input" placeholder="Confirm Password" v-model="form.password_confirmation">                
            </div>
        </div>
      <div class="col-sm-12 col-md-6">
        <div class="form-group dash-group">
          <label> Type * </label>
          <select class="form-control dash-input" v-model="form.slug" :class="{ 'is-invalid' : errors.slug}">
            <option value="Advertiser">Advertiser</option>
            <option value="Soldier">Soldier</option>
          </select>
            <p class="text-danger p-2" v-for="error in errors.slug">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 col-md-6" v-if=" form.slug == 'Advertiser' ">
        <div class="form-group dash-group">
          <label>Company *</label>
          <input class="form-control dash-input" placeholder="Please Enter the " type="text" v-model="form.company" :class="{ 'is-invalid' : errors.company}">
          <p class="text-danger p-2" v-for="error in errors.company">{{error}}</p>
        </div>
      </div>
      <div class="col-sm-12 text-right">
        <button class="the-btn2 hvr-radial-out" @click="$router.back()">Cancel</button>
        <button class="the-btn hvr-radial-out" @click="handleSubmition">Create User</button>
      </div>
    </div>
</template>

<script>

    export default {
      data() {
          return {
            form:{
              username: '',
              email: '',
              password: '',
              password_confirmation: '',
              slug: 'Soldier',
            },
            successMessage: ''
          }
      },
      methods: {
        handleSubmition () {
          this.$axios.$post('auth/users/create', this.form)
                     .then(res =>{
                            this.successMessage = res.data.message
                            setTiemout( () => {this.$router.back()}, 1500);
                      }).catch(err => {
                        console.log(err)
                      })
        },
      },
      middleware: [
        'auth', 
        'admin'
    ],
      layout: 'dashboard',
    }
</script>