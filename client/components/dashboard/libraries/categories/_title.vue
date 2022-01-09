<template>
  <div>
    <!-- the gallery -->
    <div
      @click="index = thumbIndex"
      class="row"
    >
      <div 
        v-for="(image, thumbIndex) in library.media"
        :key="thumbIndex"
        class="col-xs-6 col-md-4 img-box">
        <img :src="imagePath(image)" class="thumbnail">
      </div>
    </div>
    <!-- description -->
    <p class="lead mt-30 white-box">{{library.description}}</p>
    <!-- utm button -->
    <button class="the-btn hvr-radial-out mb-20" @click.prevent="showUTM = !showUTM">Get The Referral Link</button>
    <!-- What's app button -->
    <a :href="'https://api.whatsapp.com/send?text=' + referralLink" class="the-btn hvr-radial-out mb-20" target="_blank">Share on WhatsApp</a>
    <!-- utm Token-->
    <div class="row">
        <div class="col-sm-11">
            <p v-if="showUTM" class="white-box h4">{{referralLink}}</p>
        </div>
    </div>
    <!-- pop up window -->
    <LightGallery
      :images="getMedia"
      :index="index"
      :disable-scroll="true"
      @close="index = null"
    />
  </div>
</template>

<script>
    import SingleLibrary from '@/components/dashboard/libraries/_title'

    export default{
        data() {
            return {
              index: null,
              showUTM: false,
            }
        },
        props:[
            'library'
        ],
        components:{
            SingleLibrary
        },
        computed:{
          getMedia() {
            if ( this.library.media_type == 'image' ){
              return this.library.media.map( (media) => this.imagePath(media))
            }
            return this.library.media.map( (media) => this.videoPath(media))
          },
          referralLink() {
            return   'http://www.vi.hit/tasks'
                   + this.$route.path.substring(this.$route.path.lastIndexOf('/'))
                   + '/' + this.user.utm 
          }
        },
    }
</script>

<style scooped>
  img{
    cursor:pointer;
  }
</style>