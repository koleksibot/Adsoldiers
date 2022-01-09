<template>
    <div class="internal-page">
        <div class="text-center error-page">
            <h1 v-if="error.statusCode == 404">
                {{error.statusCode}}
            </h1>
            <p class="lead">{{error.message}}</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'error'
        ],
        mounted() {
            // if it's internal server error then displa 404 page
            if(this.error.statusCode == 500){
                $nuxt.error({
                    statusCode: 404,
                    message: 'Not found'
                })
            }
        }
    }
</script>