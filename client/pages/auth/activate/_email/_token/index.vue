<template>
    <div class="internal-page">
        <div class="container text-center">
            <div class="col-sm-12">
                <h1 class="lead success-message">{{message}}</h1>
            </div>   
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: ''
            }
        },
        created() {
            setTimeout( () => this.$router.replace({ name: 'index' }), 3000)
        },
        async asyncData({app, params, message, redirect, route, error}) {
            try {
                let response = await app.$axios.$get('auth/activate/' + params.email + '/' + params.token)
                return { 
                    message: response.data.message
                }
            } catch(e) {
                return error({statusCode:e.response.status, message: e.response.data.message})
            }
        }
    }
</script>