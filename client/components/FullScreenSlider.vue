<template>
  <div>
    <!-- Image slider -->
    <div
      id="myCarousel"
      class="carousel slide"
      data-ride="carousel"
      v-if=" gallery.media_type == 'image' "
    >
      <!-- Indicators -->
      <!--            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
      -->
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <div
          class="item"
          v-for="(media, index) in gallery.media"
          :key="index"
          :class="{ active: (index == 0)}"
        >
          <div class="row">
            <div class="col-sm-12">
              <!-- image -->
              <img :src="imagePath(media)" alt />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- video -->
    <template v-if=" gallery.media_type == 'video' ">
      <video :src="videoPath(gallery.media[0])" autoplay></video>
    </template>
  </div>
</template>

<script>
export default {
  props: ["gallery"],
  mounted() {
    this.storeAnalytics();
  },
  methods: {
    storeAnalytics() {
      this.$axios
        .$post("analytics", {
          user_utm: `${this.$route.params.utm}`,
          ad_id: `${this.$route.params.id}`
        })
        .catch(err => {
          console.log(err.response);
        });
    }
  }
};
</script>

<style scoped>
.task-frame {
  background: #000 !important;
}
img {
  min-height: 100vh;
}
</style>