<template>
    <div class="row">
        <div class="col-xs-6 col-md-4 text-center" v-for="gallery in galleries.data" >
          <nuxt-link :to="libraryLink(gallery.id)" class="text-center">
               <!-- if media is images -->
               <img 
                :src="imagePath(gallery.media[0])" 
                class="thumbnail m-auto" 
                v-if="gallery.media_type == 'image'">
                <!-- if media is video -->
                <video
                :src="videoPath(gallery.media[0])"
                 v-if="gallery.media_type == 'video'"
                 class="thumbnail m-auto"></video>
               <p class="lead bold link2">{{gallery.title}}</p>
          </nuxt-link>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'galleries'
        ],
        mounted() {
            this.libraryLink()
        },
         methods: {
            libraryLink(id) {
                return {
                    path: `libraries/${id}`, 
                    params: { 
                        id: id
                    } 
                };
            },
        },
    }
</script>

<style scoped lang="scss">
    a{
        img, video{
            height: 200px;
        }
    }
</style>