<template>
    <div>
        <!-- Start video card -->
        <div class="video-img" @click="showModal">
            <img :src="thumbnail">
            <div class="shadow">
                <img src="~/assets/img/video-icon.png">
            </div>
        </div>
        <!-- End Video Card -->
        <!-- start video Modal -->
        <div class="modal fade " :class="{ 'in show' : modal}" id="video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-right: 16px;" @click="hideModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        Modal Content
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade in" v-if="modal"></div>
        <!-- end video Modal -->
    </div>
</template>

<script>
    export default {
        data() {
            return {
                modal: false
            }
        },
        props: [
            'thumbnail',
            'videoUrl'
        ],
        methods: {
            showModal() {
                this.modal = true
                $('#video .modal-body').html('<iframe width="100%" height="400px" src="' + this.videoUrl + '" frameborder="0" allowfullscreen></iframe>');
            },
            hideModal() {
                this.modal = false
                document.getElementById('video').style.display = '';
                $('#video .modal-body').html('Modal Content');
            }
        }
    }
</script>