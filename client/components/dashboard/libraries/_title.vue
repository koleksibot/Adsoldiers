<template>
    <div>
        <!-- title -->
        <div class="row">
            <h1 class="pl-4 bold">{{task.title}}</h1>
        </div>
        <!-- image -->
        <template v-if="task.media" v-for="media in task.media">
            <img :src="imagePath(media)">
        </template>
        <!-- Content -->
        <div class="row">
            <div class="col-sm-11">
                <p class="white-box lead mb-30">{{task.content}}</p>
            </div>
        </div>
        <!-- utm button -->
        <button class="the-btn hvr-radial-out mb-20" @click.prevent="showUTM = !showUTM">Get The Referral Link</button>
        <!-- utm -->
        <div class="row">
            <div class="col-sm-11">
                <p v-if="showUTM" class="white-box h4">http://www.vi.hit{{$route.fullPath}}</p>
            </div>
        </div>
     </div>
</template>

<script>
    export default {
        props:[
            'library'
        ],
        data() {
            return {
                showUTM: false
            }
        }
    }
</script>