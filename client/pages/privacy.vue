<template>
    <div>
        <!-- start Privacy Policy page -->
        <div class="internal-page">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title title2">
                            <h2>Privacy Policy</h2>
                            <p>{{privacy}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Privacy Policy page -->
    </div>
</template>

<script>
    export default {
        data () {
            return {
                privacy: ''
            }
        },
        mounted() {
            // scroll to the top of the page
            window.scrollTo(0, 0)
            // get the page data 
            // axios.get('api/privacy-policy').then(response => {
            //     // set the response to privacy array 
            //     this.privacy = response.data.data.privacy
            // })
        },
        async asyncData({$axios}) {
            let response = await $axios.$get('settings')
            return {
                privacy: response.data.privacy
            }
        }
    }
</script>