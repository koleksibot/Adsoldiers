<template>
    <ad-id :ad="ad"/>
</template>

<script>
    import AdId from '@/components/dashboard/ads/id'

    export default{
        data() {
            return {
                ad: ''
            }
        },
        components:{
            AdId
        },
        layout: 'dashboard',
        middleware: 'auth',
        async asyncData({app, params, error}) {
            try {
                let response = await app.$axios.$get(`ads/${params.id}`);
                return {
                    ad: response.data
                }
             } catch(e) {
                 error({statusCode:e.status, message:e.message})
             }
        }
    }
</script>