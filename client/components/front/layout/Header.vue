<template>
  <div class="header">
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button
            type="button"
            class="navbar-toggle"
            data-toggle="collapse"
            data-target="#myNavbar"
          >
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <nuxt-link :to="{name: 'index'}" class="navbar-brand" title="Soldiers logo">
            <img src="~/assets/img/logo.png" alt="logo" class="logo" />
          </nuxt-link>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <!-- if not authenticated -->
          <div v-if="!authenticated">
            <ul class="nav navbar-nav navbar-right navbar-right2">
              <li>
                <nuxt-link
                  :to="{name: 'auth-register', params: { page: 'advertiser'}}"
                >Publishers signup</nuxt-link>
              </li>
              <li>
                <nuxt-link :to="{name: 'auth-login'}">Login</nuxt-link>
              </li>
            </ul>
          </div>
          <!-- if authenticated -->
          <div v-if="authenticated">
            <ul class="nav navbar-nav navbar-right navbar-right2">
              <li>
                <a @click.prevent="logout">Logout</a>
              </li>
              <li>
                <nuxt-link
                  :to="{ name: 'admin-dashboard' }"
                  v-if="role == 'admin'"
                >{{user.username}}</nuxt-link>
                <nuxt-link
                  :to="{ name: 'advertiser-dashboard' }"
                  v-if="role == 'advertiser'"
                >{{user.username}}</nuxt-link>
                <nuxt-link
                  :to="{ name: 'soldier-dashboard' }"
                  v-if="role == 'soldier'"
                >{{user.username}}</nuxt-link>
              </li>
            </ul>
          </div>
          <ul class="nav navbar-nav navbar-right navigation">
            <li>
              <nuxt-link :to="{name: 'index'}">HOME</nuxt-link>
            </li>
            <li>
              <a href="#">ADVERTISERS</a>
            </li>
            <!-- <li><a href="#">PUBLISHERS</a></li> -->
            <li>
              <a href="#">Benefits</a>
            </li>
            <li>
              <nuxt-link :to="{path: '/about'}">ABOUT US</nuxt-link>
            </li>
            <li>
              <nuxt-link :to="{path: '/terms'}">Terms & Conditions</nuxt-link>
            </li>
            <li>
              <nuxt-link :to="{path: '/Privacy'}">Privacy Policy</nuxt-link>
            </li>
            <li>
              <nuxt-link :to="{path: '/contact'}">ContactUs</nuxt-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  methods: {
    logout() {
      this.$auth.logout();
    }
  }
};
</script>

<style scoped>
a:hover {
  cursor: pointer;
}
</style>
