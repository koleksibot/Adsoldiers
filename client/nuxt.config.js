import webpack from "webpack";

export default {
  mode: "universal",
  server: {
    port: 12345,
    host: "0.0.0.0", // default: localhost
  },
  /*
   ** Headers of the page
   */
  head: {
    title: process.env.npm_package_name || "",
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      {
        hid: "description",
        name: "description",
        content: process.env.npm_package_description || "",
      },
    ],
    link: [{ rel: "icon", type: "image/x-icon", href: "/favicon.ico" }],
    script: [
      { src: "https://js.stripe.com/v3/" },
      { src: "https://code.jquery.com/jquery-3.4.1.slim.min.js" },
    ],
  },
  __dangerouslyDisableSanitizers: ["script"],
  /*
   ** Customize the progress-bar color
   */
  loading: { color: "#fff" },
  /*
   ** Global CSS
   */
  css: [
    "~/node_modules/bootstrap/dist/css/bootstrap.min.css",
    "@/assets/scss/app.scss",
  ],
  /*
   ** Plugins to load before mounting the App
   */
  plugins: [
    { src: "~/plugins/vue2-google-maps.js" },
    { src: "~/plugins/datepicker", ssr: false },
    "~/plugins/mixins/user.js",
    "~/plugins/mixins/validation.js",
    "~/plugins/mixins/media-path.js",
    "~/plugins/axios.js",
    "~/plugins/bootstrap.js",
    "~/plugins/vue-cryptojs.js",
    { src: "~/plugins/multiselect.js", ssr: false },
    { src: "~/plugins/vue-light-gallery.js", ssr: false },
    { src: "~/plugins/vue-tables-2.js", ssr: false },
    { src: "~/plugins/emoji-picker.js", ssr: false },
    { src: "~/plugins/vue-apexcharts.js", ssr: false },
  ],
  /*
   ** Nuxt.js dev-modules
   */
  buildModules: [],
  /*
   ** Nuxt.js modules
   */
  modules: [
    "@nuxtjs/axios",
    "@nuxtjs/auth",
    "@nuxtjs/font-awesome",
    "nuxt-vue-multiselect",
    "nuxt-vuex-localstorage",
  ],
  /**
   * Axios Configuration
   */
  axios: {
    baseURL: "http://127.0.0.1:8000/api/",
    //  "http://api.adsoldier.api-ksa.com/api/",
    redirectError: {
      401: "/auth/login",
      500: "/",
      404: "flase",
    },
  },
  router: {
    middleware: ["clearValidationErrors"],
  },
  /**
   * Auth Configuration
   */
  auth: {
    redirect: {
      login: "/auth/login",
      callback: "/auth/login",
      home: false,
    },
    strategies: {
      local: {
        endpoints: {
          login: {
            url: "/auth/login",
            method: "post",
            propertyName: "meta.token",
          },
          user: {
            url: "auth/user",
            method: "get",
            propertyName: "data",
          },
          logout: {
            url: "/logout",
            method: "post",
          },
        },
      },
    },
  },
  /*
   ** Build configuration
   */
  build: {
    /*
     ** You can extend webpack config here
     */
    extend(config, ctx) {},
    plugins: [
      new webpack.ProvidePlugin({
        $: "jquery",
        jQuery: "jquery",
        "window.jQuery": "jquery",
        mode: "client",
      }),
    ],
    /**
     * [vendor description]
     * @type {Array}
     */
    // vendor: ["jquery","vue2-google-maps", "bootstrap", "vue-tables-2"],
  },
  /**
   * Envrionment standerds
   * @type {Object}
   */
  env: {
    STRIPE_PUBLIC_KEY: "pk_test_j9EAkUHG7ATYDJd1aHwTqKMi00zxtYRmOd",
    IMAGES_STORING_PATH: "public/images",
    // VIDEOS_STORING_PATH:'public/videos'
  },
};
