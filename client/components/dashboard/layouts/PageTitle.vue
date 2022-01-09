<template>
  <div class="admin-page-title">
    <ul :class="breadcrumbClass">
      <li><a href="#">Home</a></li>
      <li class="active">Page Name</li>
    </ul>
    <h2>{{ pageName }}</h2>
  </div>
</template>

<script>
export default {
  data() {
    return {
      pageName: "",
      route: this.$route.path,
    };
  },
  watch: {
    $route() {
      this.getPageName();
    },
  },
  computed: {
    breadcrumbClass() {
      if (!this.$i18n) return;

      return this.$i18n.locale == "ar" ? "breadcrumb-ar" : "breadcrumb";
    },
  },
  mounted() {
    this.getPageName();
  },
  methods: {
    getPageName() {
      // get the url path
      this.pageName = this.$route.path;
      // get the last string in path (page name)
      this.pageName = this.pageName.substring(
        this.pageName.lastIndexOf("/") + 1
      );
      // if there is no page name i.e it's home page just return
      if (this.pageName == "") {
        return;
      }
      // replace each %20 with space ' '
      this.pageName = this.pageName.replace(/%20/g, " ");
      // capitalize the pagename
      this.pageName = this.pageName[0].toUpperCase() + this.pageName.slice(1);
    },
  },
};
</script>
