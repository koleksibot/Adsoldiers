<template>
  <div>
    <div>
      <section style="width: 100%;">
        <ul class="sidebar-menu">
          <li class="sidebar-header">
            <nuxt-link :to="{ name: 'index' }">
              <img src="@/assets/img/logo.png" />
            </nuxt-link>
          </li>
          <li>
            <nuxt-link :to="{ name: 'admin-dashboard' }">
              <img src="@/assets/img/img1-a.png" class="icon-a" />
              <img src="@/assets/img/img1-b.png" class="icon-b" />
              <span>Dashboard</span>
            </nuxt-link>
          </li>
          <li @click="adSubTabs = !adSubTabs">
            <a>
              <img src="@/assets/img/img2-a.png" class="icon-a" />
              <img src="@/assets/img/img2-b.png" class="icon-b" />
              Ads
            </a>
            <ul class="sidebar-menu sub-tab" v-if="adSubTabs">
              <li>
                <nuxt-link :to="{ name: 'admin-dashboard-ads' }">
                  <img src="@/assets/img/img2-a.png" class="icon-a" />
                  <img src="@/assets/img/img2-b.png" class="icon-b" />
                  <span>All Ads</span>
                </nuxt-link>
              </li>
              <li>
                <nuxt-link :to="{ name: 'admin-dashboard-ads-review' }">
                  <img src="@/assets/img/img2-a.png" class="icon-a" />
                  <img src="@/assets/img/img2-b.png" class="icon-b" />
                  <span>Review Ads</span>
                </nuxt-link>
              </li>
            </ul>
          </li>
          <li>
            <nuxt-link :to="{ name: 'admin-dashboard-campaigns' }">
              <img src="@/assets/img/img2-a.png" class="icon-a" />
              <img src="@/assets/img/img2-b.png" class="icon-b" />
              <span>Campaigns</span>
            </nuxt-link>
          </li>
          <li>
            <nuxt-link :to="{ name: 'admin-dashboard-users' }">
              <img src="@/assets/img/img2-a.png" class="icon-a" />
              <img src="@/assets/img/img2-b.png" class="icon-b" />
              <span>Users</span>
            </nuxt-link>
          </li>
          <li>
            <nuxt-link :to="{ name: 'admin-dashboard-categories' }">
              <img src="@/assets/img/img2-a.png" class="icon-a" />
              <img src="@/assets/img/img2-b.png" class="icon-b" />
              <span>Library</span>
            </nuxt-link>
          </li>
          <li>
            <nuxt-link :to="{ name: 'admin-dashboard-tasks' }">
              <img src="@/assets/img/img2-a.png" class="icon-a" />
              <img src="@/assets/img/img2-b.png" class="icon-b" />
              <span>Tasks</span>
            </nuxt-link>
          </li>
          <li>
            <nuxt-link :to="{ name: 'admin-dashboard-settings' }">
              <img src="@/assets/img/img-a.png" class="icon-a" />
              <img src="@/assets/img/img-b.png" class="icon-b" />
              <span>Settings</span>
            </nuxt-link>
          </li>
          <li>
            <nuxt-link :to="{ name: 'admin-dashboard-wallet-soldier' }">
              <img src="@/assets/img/img2-a.png" class="icon-a" />
              <img src="@/assets/img/img2-b.png" class="icon-b" />
              <span>Wallet</span>
            </nuxt-link>
          </li>
          <li>
            <a @click.prevent="$auth.logout()">
              <img src="@/assets/img/img2-a.png" class="icon-a" />
              <img src="@/assets/img/img2-b.png" class="icon-b" />
              <span>Logout</span>
            </a>
          </li>
        </ul>
      </section>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      path: "",
      adSubTabs: false,
    };
  },
  methods: {
    checkForAdSubTab() {
      this.$route.path.indexOf("ads") != -1
        ? (this.adSubTabs = true)
        : (this.adSubTabs = false);
    },
  },
  mounted() {
    this.checkForAdSubTab();
  },
  watch: {
    $route() {
      this.checkForAdSubTab();
    },
  },
};
</script>
