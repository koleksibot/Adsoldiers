    <template>
    <div>
        <!-- start About page -->
        <div class="internal-page about">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title title2">
                            <h2>About Us</h2>
                            <p>More details about our company</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <h4 class="text3 color1 mb-20">Overview About Us</h4>
                        <p class="text2 mb-20">{{about.about_us}}</p>
                        <h4 class="text1 text3"><img src="@/assets/img/vision.png">Vision</h4>
                        <p class="text2 mb-20">{{about.vision}}</p>
                        <h4 class="text1 text3"><img src="@/assets/img/mission.png">Mission</h4>
                        <p class="text2 mb-20">{{about.mission}}</p>
                    </div>
                    <div class="col-md-6 col-sm-12 p-0">
                        <div class="col-sm-12">
                            <div class="about-img">
                            <img :src=" '_nuxt/assets/img/' + about.about_us_image" alt="about_us_image">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="about-img">
                                <img :src="'_nuxt/assets/img/' + about.vision_image" alt="vision_image">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="about-img">
                                <img :src=" '_nuxt/assets/img/' + about.mission_image" alt="mission_image">
                            </div>
                        </div>
                    </div>    
                    <!-- start video -->
                    <div class="">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <video-card thumbnail="_nuxt/assets/img/video3.png" :videoUrl="'https://www.youtube.com/embed/yRAzlw4JM8o'"></video-card>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end video -->
                </div>
            </div>
        </div>
        <!-- end About page -->
        
        <!-- Start Clients -->
        <clients></clients>
        <!-- End Clients -->

    </div>
</template>

<style>
    .about .video-img .shadow img {
        margin-top: 10%;
    }
</style>

<script>
    // Import video card and clients from home components
    import Clients   from '@/components/front/home/Clients'
    import VideoCard from '@/components/front/home/VideoCard'

    export default {
        data () {
            return {
                about : []
            }
        },
        components : {
            Clients,
            VideoCard
        },
        mounted() {
            // scroll to the top of the page
            window.scrollTo(0, 0)
        },
        async asyncData({$axios}) {
            let response = await $axios.get('settings')
            return{
                about: response.data.data
            }
        }
    }
</script>