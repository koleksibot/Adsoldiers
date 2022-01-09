<template>
    <div class="col-sm-12">
        <!-- screen slider -->
        <full-screen-slider :gallery="task" />
    </div>
</template>

<script>
    import FullScreenSlider from '@/components/FullScreenSlider'

    export default{
        data() {
            return {
                task: [],
                showUTM: false
            }
        },
        components:{
            FullScreenSlider
        },
        async asyncData({app, params, error}) {
           try{
             let response = await app.$axios.$get(`libraries/${params.id}`);
                return {
                    task: response.data
                }
            } catch(e) {
                error({statusCode: e.status, message: e.message});
            }
        },
        layout: 'task'
    }
</script>

<style scooped>
 .carousel-inner > .item {
        -webkit-transition: 0.3s ease-in-out left;
        -moz-transition: 0.3s ease-in-out left;
        -o-transition: 0.3s ease-in-out left;
        transition: 0.3s ease-in-out left;
    }
</style>