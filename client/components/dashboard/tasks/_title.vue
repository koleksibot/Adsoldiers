<template>
    <div>
        <!-- if media type is image -->
        <template v-if="task.media && task.media_type == 'image' " v-for="media in task.media">
            <img :src="imagePath(media)">
        </template>
        <!-- if media type is video -->
        <template v-if="task.media_type == 'video' ">   
            <!-- if User have seen the tutorial show a message  -->
            <div class="row" v-if='user.tasks_lvl !== "1" '>
                <div class="col-sm-12 mb-30 mt-30">
                    <p class="white-box lead">You Have Already Seen The Tutorial</p>
                </div>
            </div>
            <!-- else show him the tutorial to increment his level by one -->
            <template v-else>
                <!-- if the video of tutorial isn't available get the alt image -->
                <template v-if="!(videoPath(task.media[0])).includes('mp4')">
                    <img :src="videoPath(task.media[0])">
                </template>
                <!-- video -->
                <video :src="videoPath(task.media[0])" @ended="taskFinished" autoplay="autoplay" v-else></video>
            </template>
        </template>
        <!-- Content -->
        <div class="row">
            <div class="col-sm-12 mb-30 mt-30">
                <p class="white-box lead">{{task.content}}</p>
            </div>
        </div>
        <!-- utm button -->
        <nuxt-link :to="{ path: '../categories' }" class="the-btn hvr-radial-out mb-20" v-if='user.tasks_lvl == 2 '>
            Go To Library
        </nuxt-link>
        <nuxt-link :to="{ path: '../ads' }" class="the-btn hvr-radial-out mb-20" v-if='user.tasks_lvl == 3 '>
            Go To Ads
        </nuxt-link>
     </div>
</template>

<script>
    export default {
        props:[
            'task'
        ],
        methods: {
            taskFinished() {
                this.$axios.post(`users/${this.user.id}/tutorial`);
                setTimeout( () => this.$router.push({name: 'soldier-dashboard-tasks'}) , 2500);
            },  
        }
    }
</script>