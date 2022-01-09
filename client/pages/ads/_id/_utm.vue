<template>
    <div class="col-sm-12">
        <!-- button -->
        <a :href="ad.call_of_action" class="btn btn-danger col-sm-2 col-sm-offset-5">تعرف على المزيد</a> 
        <!-- screen slider -->
        <full-screen-slider :gallery="ad" />
    </div>
</template>

<script>
    import FullScreenSlider from '@/components/FullScreenSlider'

    export default{
        data() {
            return {
                ad: [],
                showUTM: false,
            }
        },
        components:{
            FullScreenSlider
        },
        async asyncData({app, params, error}) {
            try{
             let response = await app.$axios.$get(`ads/${params.id}`);             
                return {
                    ad: response.data
                }
            } catch(e) {
                error({statusCode: e.status, message: e.message});
            }
        },
        layout: 'task',
    }
</script>

<style lang="scss" scoped>
    .slider{
        margin: 0;  
    }
    img, video{
        height: 100vh;
        width: 100%;
    }
    .btn{
        position: absolute;
        z-index: 999999;
        bottom: 70px;
    }
    .carousel-inner > .item {
        -webkit-transition: 0.4s ease-in-out left;
        -moz-transition: 0.4s ease-in-out left;
        -o-transition: 0.4s ease-in-out left;
        transition: 0.4s ease-in-out left;
    }
    .carousel-inner{
        padding: 0 !important
    }
</style>